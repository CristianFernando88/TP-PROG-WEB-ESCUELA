<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;
use PDO;
use PDOException;

class AuthController extends Controller
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        global $pdo; 
        if (!$pdo instanceof PDO) {
            die('Error crítico: La conexión a la base de datos no está disponible.');
        }
        $this->usuarioModel = new Usuario($pdo);
    }

    public function showLogin(): void
    {
        $errorLogin = $_SESSION['errorLogin'] ?? '';
        unset($_SESSION['errorLogin']);
        $email = $_SESSION['old_email'] ?? '';
        unset($_SESSION['old_email']);
        $registroExitoso = isset($_GET['registro']) && $_GET['registro'] === 'exitoso';

        $this->view('auth/login', [
            'titulo_pagina' => 'Acceso Institucional - Colegio Horizonte',
            'errorLogin' => $errorLogin,
            'email' => $email,
            'registroExitoso' => $registroExitoso,
            'base_path' => BASE_PATH 
        ]);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $_SESSION['old_email'] = $email;

        if (empty($email) || empty($password)) {
            $_SESSION['errorLogin'] = 'Por favor, ingresa tu correo y contraseña.';
            $this->redirect('login.php');
            return;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION['errorLogin'] = 'Ingresá un correo electrónico válido.';
            $this->redirect('login.php');
            return;
        }

        try {
            $usuario = $this->usuarioModel->buscarPorEmail($email);

            if ($usuario && $this->usuarioModel->passwordEsValida($usuario, $password)) {
                if ((bool) ($usuario['activo'] ?? 1)) {
                    session_regenerate_id(true); 
                    $_SESSION['usuario_id'] = (int) $usuario['id_usuario'];
                    $_SESSION['usuario_nombre'] = htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['rol'] = htmlspecialchars($usuario['nombre_rol'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['email'] = htmlspecialchars($usuario['email'] ?? $email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    unset($_SESSION['old_email']); 
                    
                    $this->redirect('dashboard.php'); 
                    return;
                } else {
                    $_SESSION['errorLogin'] = 'Tu cuenta está inactiva. Por favor, contacta a soporte.';
                    $this->redirect('login.php');
                    return;
                }
            } else {
                $_SESSION['errorLogin'] = 'Credenciales incorrectas.';
                $this->redirect('login.php');
                return;
            }
        } catch (PDOException $e) {
            error_log("Error de autenticación (BD): " . $e->getMessage());
            $_SESSION['errorLogin'] = 'Ocurrió un error inesperado. Inténtalo de nuevo.';
            $this->redirect('login.php');
            return;
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        $_SESSION = []; 
        $this->redirect('login.php');
    }

    public function showRegister(): void
    {
        $errorRegistro = $_SESSION['errorRegistro'] ?? '';
        unset($_SESSION['errorRegistro']);
        $nombre = $_SESSION['old_nombre'] ?? '';
        unset($_SESSION['old_nombre']);
        $apellido = $_SESSION['old_apellido'] ?? '';
        unset($_SESSION['old_apellido']);
        $email = $_SESSION['old_email'] ?? '';
        unset($_SESSION['old_email']);

        $this->view('auth/register', [
            'titulo_pagina' => 'Registro de Usuario - Colegio Horizonte',
            'errorRegistro' => $errorRegistro,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'base_path' => BASE_PATH 
        ]);
    }

    public function register(): void
    {
        $nombre = trim(htmlspecialchars($_POST['nombre'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        $apellido = trim(htmlspecialchars($_POST['apellido'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        $email = trim(htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
        $password = $_POST['password'] ?? '';
        $confirmar_password = $_POST['confirmar_password'] ?? '';

        $_SESSION['old_nombre'] = $nombre;
        $_SESSION['old_apellido'] = $apellido;
        $_SESSION['old_email'] = $email;

        if (empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($confirmar_password)) {
            $_SESSION['errorRegistro'] = 'Todos los campos son obligatorios.';
            $this->redirect('registro.php');
            return;
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION['errorRegistro'] = 'Por favor, ingresa un correo válido.';
            $this->redirect('registro.php');
            return;
        } elseif ($password !== $confirmar_password) {
            $_SESSION['errorRegistro'] = 'Las contraseñas no coinciden.';
            $this->redirect('registro.php');
            return;
        } elseif (strlen($password) < 6) {
            $_SESSION['errorRegistro'] = 'La contraseña debe tener al menos 6 caracteres.';
            $this->redirect('registro.php');
            return;
        }

        try {
            if ($this->usuarioModel->emailExiste($email)) {
                $_SESSION['errorRegistro'] = 'Este correo ya está registrado. Intenta iniciar sesión.';
                $this->redirect('registro.php');
                return;
            } else {
                $this->usuarioModel->crear($nombre, $apellido, $email, $password);

                unset($_SESSION['old_nombre'], $_SESSION['old_apellido'], $_SESSION['old_email']);
                $this->redirect('login.php?registro=exitoso');
                return;
            }
        } catch (PDOException $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            $_SESSION['errorRegistro'] = 'Ocurrió un error inesperado al registrar.';
            $this->redirect('registro.php');
            return;
        }
    }
}

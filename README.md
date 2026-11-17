# Trabajo Práctico: Diseño y Desarrollo Web Escolar

## Datos del alumno

- **Alumno:** Cristian Fernando Barrios
- **Carrera:** Tecnicatura Superior en Desarrollo de Software
- **Materia:** Programación Web
- **Profesor:** Lic. Gabriel Artaza
- **Tema:** Colegio Horizonte

---

## Estructura del monorepo

- `landing-escuela/`: sitio estático institucional correspondiente a los Trabajos Prácticos N.º 2 y N.º 3.
- `web-app-escuela/`: aplicación PHP del Trabajo Práctico N.º 4, con modularización SSI, renderizado SSR, roles, sesiones y variables de entorno.
- `assets/`: carpeta de la raíz destinada a las capturas y evidencias visuales de los trabajos prácticos.
- `index.html`: página de entrada de la raíz que redirige a la portada del sitio estático.

---

## Trabajo Práctico N.º 1: Análisis y Wireframes

El primer trabajo consistió en documentar la elección del tema, los intereses institucionales, los sitios de referencia, el wireframe y el mapa del sitio.

  - [Ver documento completo del TP1 en Google Docs](https://docs.google.com/document/d/1velZkvVOvjWmc1mu0CTUjcVx32MY78nxgrrS2tAsLbg/edit?usp=sharing)

### Wireframe base

![Wireframe base](https://github.com/user-attachments/assets/d7931870-18a9-4206-8729-ee6c4b8b382c)

---

## Trabajos Prácticos N.º 2 y N.º 3: Diseño UI/UX y Maquetación Estática

El Trabajo Práctico N.º 2 definió la interfaz visual y el Trabajo Práctico N.º 3 llevó la propuesta a una maquetación estática dentro de `landing-escuela/`.

- [Ver diseño completo del sitio en Figma](https://www.figma.com/make/8HDHTztRUUtWocPcrxmL1h/Educational-School-Website-Design?t=oX5nv12SgkgjRwFn-1)

<details>
<summary>Capturas de las secciones institucionales y educativas</summary>

### Inicio

![Inicio](landing-escuela/img/hero-estudiantes.svg)

### Autoridades

![Autoridades](landing-escuela/img/autoridad-1.svg)

### Quiénes somos

![Quiénes somos](landing-escuela/img/historia-colegio.svg)

### Misión, visión y valores

![Misión, visión y valores](landing-escuela/img/historia-colegio.svg)

### Documentos institucionales

![Documentos institucionales](landing-escuela/img/historia-colegio.svg)

### Nivel inicial

![Nivel inicial](landing-escuela/img/nivel-inicial.svg)

### Nivel primario

![Nivel primario](landing-escuela/img/nivel-primario.svg)

### Nivel secundario

![Nivel secundario](landing-escuela/img/nivel-secundario.svg)

### Pastoral y comunidad

![Pastoral y comunidad](landing-escuela/img/noticia-5.svg)

### Novedades y noticias

![Novedades y noticias](landing-escuela/img/noticia-1.svg)

### Admisión e inscripciones

![Admisión e inscripciones](landing-escuela/img/historia-colegio.svg)

### Contacto y ubicación

![Contacto y ubicación](landing-escuela/img/historia-colegio.svg)

</details>

---

## Trabajo Práctico N.º 4: Migración a PHP, Modularización SSI y SSR

El cuarto trabajo práctico migra el diseño institucional a una aplicación PHP dinámica. La implementación se encuentra en `web-app-escuela/` e incorpora navegación responsive, autenticación simulada, sesiones, permisos por rol y vistas específicas según el perfil activo.

- [Ver prototipo de Figma de la Web App](https://www.figma.com/make/2ig7GnsxnjOj469BCJFGmH/Gesti%C3%B3n-Escolar-Colegio-Horizonte?code-node-id=0-6&p=f&t=rzOjt53aobRP2h6F-0&fullscreen=1)

### Tecnologías utilizadas

- HTML5
- CSS3
- Bootstrap 5
- Bootstrap Icons
- JavaScript
- PHP 8.x
- XAMPP y Apache
- Variables de entorno mediante `.env`

### Arquitectura modular

- `index.php` funciona como enrutador principal. Verifica la sesión y dirige al dashboard o al login.
- `login.php` contiene el formulario de acceso simulado y permite probar los roles disponibles.
- `logout.php` limpia la sesión y elimina su cookie antes de redirigir al login.
- `dashboard.php`, `alumnos.php`, `niveles.php`, `materias.php` y `hijos.php` son vistas protegidas por el guard de autenticación.
- `includes/header.php`, `includes/footer.php` e `includes/nav.php` forman el sistema de SSI compartido.
- `includes/auth.php` y `config/roles.php` definen la identidad, los permisos y los datos demostrativos de cada perfil.
- `config/env.php` centraliza la lectura de variables institucionales.
- El sistema muestra una barra lateral clásica en escritorio y un menú off-canvas en dispositivos móviles.
- Los títulos de cada vista se definen antes de incluir el header, permitiendo renderizado SSR con metadatos personalizados.

### Roles implementados

- **Admin:** acceso general a la gestión institucional.
- **Directivo:** consulta global de alumnos, niveles y materias.
- **Preceptor:** acceso a alumnos y niveles/cursos asignados.
- **Profesor:** visualiza en `materias.php` únicamente sus cátedras individuales.
- **Tutor:** accede a **Mis Hijos** (`hijos.php`) para consultar cursos, asistencias y promedios demostrativos.

Las cátedras se representan como registros individuales de materia y curso, por ejemplo: Matemática - 1.º A o Matemática - 2.º A.

### Ejecución local con XAMPP

1. Ubicar el repositorio dentro de `C:\xampp\htdocs\TP-PROG-WEB-ESCUELA`.
2. Iniciar Apache desde el Panel de Control de XAMPP.
3. Copiar la plantilla de variables de entorno desde PowerShell:

```powershell
Copy-Item web-app-escuela\.env.example web-app-escuela\.env
```

4. Abrir la aplicación desde:

```text
http://localhost/TP-PROG-WEB-ESCUELA/web-app-escuela/
```

El archivo `web-app-escuela/.env` está excluido de Git mediante `.gitignore`. No se deben cargar credenciales reales ni datos personales en la aplicación de demostración.

### Evidencias visuales del TP4

#### Servidor local corriendo

![Servidor local corriendo](assets/servidor_local.png)

#### Estructura modular SSI

![Estructura modular SSI](assets/estructura_modular.png)

#### Navegación dinámica y títulos SSR

**Inicio**

![Navegación Inicio](assets/nav-home.png)

**Cursos y niveles**

![Navegación Cursos y niveles](assets/nav-cursos-niveles.png)

**Alumnos y matrícula**

![Navegación Alumnos y matrícula](assets/nav-alumnos-matricula.png)

#### Variables de entorno

![Ejemplo de archivo .env](assets/env-example.png)

---

## Datos finales

- **Alumno:** Cristian Fernando Barrios
- **Carrera:** Tecnicatura Superior en Desarrollo de Software
- **Materia:** Programación Web
- **Profesor:** Lic. Gabriel Artaza
- **Tema:** Colegio Horizonte

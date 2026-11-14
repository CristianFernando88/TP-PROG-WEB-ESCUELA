
# Trabajo Práctico: Diseño UI/UX - Sitio Web Escolar

## Estructura del monorepo

- `landing-escuela/`: sitio estático del TP N.º 3, con sus páginas, estilos, scripts, imágenes y documentos.
- `web-app-escuela/`: estructura inicial de la aplicación dinámica en PHP del TP N.º 4; configuración y plantillas compartidas están en `config/` e `includes/`.

El `index.html` de la raíz redirige a la portada del sitio estático para facilitar la publicación en GitHub Pages.

## Aplicación PHP (TP4)

👉 [Ver modelado figma orientativa de la app Proyecto en Figma](https://www.figma.com/make/2ig7GnsxnjOj469BCJFGmH/Gesti%C3%B3n-Escolar-Colegio-Horizonte?code-node-id=0-6&p=f&t=rzOjt53aobRP2h6F-0&fullscreen=1)


La aplicación se encuentra en `web-app-escuela/` y organiza el flujo en:

- `index.php`: enrutador sin salida HTML; deriva al dashboard si hay un rol válido en sesión o al login en caso contrario. Al ser un controlador de redirección, no incluye header ni footer.
- `login.php`: formulario institucional y acceso simulado para pruebas. Acepta un correo válido, una contraseña no vacía y un rol seleccionado; no autentica contra una base de datos.
- `dashboard.php`, `alumnos.php`, `niveles.php` y `materias.php`: vistas protegidas que definen su `$titulo_pagina` y cargan la configuración, el header y el footer compartidos.
- `includes/header.php` y `includes/footer.php`: plantillas comunes de página. `includes/nav.php` presenta los accesos permitidos para el rol activo.
- `includes/auth.php` y `config/roles.php`: validación de sesión, permisos por página y perfiles/datos de demostración para Admin, Directivo, Preceptor, Profesor y Tutor.
- `config/env.php`: carga variables del entorno del proceso o, en su defecto, de `web-app-escuela/.env`; valida el correo institucional de soporte.

Los perfiles, registros de alumnos y valores del dashboard son datos de demostración; no cargues datos personales reales en estas vistas. El selector de rol y el acceso simulado no constituyen autenticación ni autorización para un entorno de producción.

### Ejecutar localmente con XAMPP

1. Colocá el repositorio dentro de `C:\xampp\htdocs\TP-PROG-WEB-ESCUELA` y asegurate de que Apache esté iniciado desde el panel de XAMPP.
2. Opcionalmente, desde la raíz del repositorio, creá la configuración local copiando la plantilla: `Copy-Item web-app-escuela\.env.example web-app-escuela\.env`.
3. Abrí `http://localhost/TP-PROG-WEB-ESCUELA/web-app-escuela/`. La raíz del repositorio sirve el sitio estático; la aplicación TP4 se inicia desde su propio directorio.

`web-app-escuela/.env` está excluido de Git. Usá ese archivo solo para configuración local y no agregues credenciales ni secretos al repositorio.

**Alumno:** Cristian Fernando Barrios

**Materia:** Programación Web

**Profesor:** Gabriel Artaza

**Tema:** Sitio Web Institucional para Colegio Secundario / Primario  

---

## 📄 1. Documentación del Trabajo Práctico (TP Anterior)
Podés acceder a la documentación completa (Puntos 1 al 5: Intereses, Elección del tema, Sitios de referencia, Wireframes a mano y Mapa del sitio) en el siguiente enlace:

👉 [Ver Documento Completo en Google Docs](https://docs.google.com/document/d/1velZkvVOvjWmc1mu0CTUjcVx32MY78nxgrrS2tAsLbg/edit?usp=sharing)

---

## 🎨 2. Proyecto Interactivo en Figma
El diseño de la interfaz y las 12 secciones/páginas en alta fidelidad se encuentran disponibles en Figma:

👉 [Ver Proyecto en Figma](https://www.figma.com/make/8HDHTztRUUtWocPcrxmL1h/Educational-School-Website-Design?t=oX5nv12SgkgjRwFn-1)

---

## 🖼️ 3. Capturas de las Secciones / Páginas

### Wireframe Base (Baja Fidelidad)
-<img width="1348" height="669" alt="image" src="https://github.com/user-attachments/assets/d7931870-18a9-4206-8729-ee6c4b8b382c" />
### Mockups de Alta Fidelidad (Verde Pastel)
1. **Home / Inicio** (Barra lateral flotante, presentación y noticias)
   <img width="1336" height="626" alt="image" src="https://github.com/user-attachments/assets/4e5433a4-d8a2-4df3-972b-43dff1fdda61" />
2. **Institucional - Autoridades** (Grilla de directivos y frase institucional)
   <img width="1342" height="626" alt="image" src="https://github.com/user-attachments/assets/82b2a996-490e-47ea-84f6-f4955a4c1387" />
3. **Institucional - Quiénes Somos 1** (Historia y fotografía principal)
   <img width="1330" height="623" alt="image" src="https://github.com/user-attachments/assets/c3c9dad6-c950-4f78-96fc-89d8d7124aab" />
4. **Institucional - Quiénes Somos 2** (Misión, Visión y Valores)
   <img width="1333" height="628" alt="image" src="https://github.com/user-attachments/assets/e582567b-70a5-4c30-8e1d-841f57efa9f7" />
5. **Institucional - Documentos** (Ideario, Reglamento y Convivencia)
   <img width="1343" height="624" alt="image" src="https://github.com/user-attachments/assets/7113fc88-0428-4dbd-924c-7fdf5a0d5f53" />
6. **Propuesta Educativa - Nivel Inicial**
   <img width="1338" height="634" alt="image" src="https://github.com/user-attachments/assets/b6f8a2bb-2c2f-4989-967a-6bb14545c45f" />
7. **Propuesta Educativa - Nivel Primario**
   <img width="1325" height="624" alt="image" src="https://github.com/user-attachments/assets/b3d1972b-916d-4f24-95ba-5923b384f102" />
8. **Propuesta Educativa - Nivel Secundario**
    <img width="1329" height="627" alt="image" src="https://github.com/user-attachments/assets/8c9d67c5-3b05-4586-8822-e245d5874bc5" />
9. **Pastoral y Comunidad**
    <img width="1345" height="633" alt="image" src="https://github.com/user-attachments/assets/4c5b7f0a-6deb-494c-a0ef-a94da36cb944" />
10. **Novedades y Noticias**
    <img width="1345" height="634" alt="image" src="https://github.com/user-attachments/assets/6725c965-d305-48ba-9073-3d74924dad9a" />
11. **Admisión e Inscripciones**
    <img width="1333" height="636" alt="image" src="https://github.com/user-attachments/assets/60f3472f-3441-4219-ba0c-ba85b4d9cb34" />
22. **Contacto y Ubicación**
    <img width="1338" height="634" alt="image" src="https://github.com/user-attachments/assets/fe8ee5ef-10ad-4dca-bd1d-75d68a15382c" />

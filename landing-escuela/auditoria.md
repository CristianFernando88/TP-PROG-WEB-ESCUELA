# Auditoría técnica — TP N.º 3

**Fecha:** 13 de noviembre de 2026
**Rama revisada:** `feature/maquetacion`

## Estructura y alcance

El sitio contiene 13 páginas HTML independientes: inicio, autoridades, quiénes somos, misión y valores, documentos, nivel inicial, nivel primario, nivel secundario, pastoral, detalle de proyectos pastorales, noticias, admisión y contacto. Cada vista conserva un `<aside>` para la navegación, un `<main>` para el contenido y metadatos de título y descripción. Las tarjetas editoriales y las autoridades usan `<article>` cuando el contenido es autónomo.

Bootstrap 5.3.3 aporta la grilla, los estilos y los componentes interactivos; `css/style.css` conserva los estilos propios. La navegación del aside es consistente entre páginas y marca la vista actual con `aria-current="page"`.

## Correcciones aplicadas

- El aside se adapta a móvil sin posición sticky ni altura mínima de pantalla; el comportamiento sticky se activa desde 768 px.
- Se corrigieron los destinos locales y se agregaron enlaces reales para redes sociales, llamados a la acción, niveles educativos y contacto. El menú lateral enlaza directamente a `nivel-inicial.html`, `nivel-primario.html` y `nivel-secundario.html`.
- Se incorporaron páginas propias para Nivel Primario y Nivel Secundario, con contenido, ilustraciones SVG accesibles y formulario de contacto/admisión.
- Las pestañas de admisión usan los componentes `pill` de Bootstrap 5 (`data-bs-toggle` y `data-bs-target`) para alternar los contenidos de los tres niveles. Al cambiar de pestaña, Bootstrap actualiza `aria-selected` y las clases `active`/`show`.
- Los cuatro paneles del acordeón de Pastoral incluyen acceso a su sección correspondiente en `pastoral-detalle.html`, donde se amplía cada proyecto.
- Se añadieron imágenes vectoriales locales de muestra con texto alternativo existente en las vistas.
- Los formularios tienen nombres de campo y validación del navegador. La respuesta se identifica expresamente como simulada; no existe envío a un servidor.
- Las descargas de documentos son PDF de muestra y no deben considerarse documentación institucional oficial.
- Los filtros de noticias actualizan las tarjetas visibles y comunican su estado mediante `aria-pressed`.

## Verificación funcional

- Las 13 páginas pasaron el escaneo de enlaces, fragmentos locales y objetivos de componentes: cero destinos inexistentes; no quedan enlaces `href="#"`.
- En navegador, las pestañas de Nivel Inicial, Primario y Secundario se alternaron correctamente; se comprobó `aria-selected`, una sola pestaña/panel activo y las clases `active`/`show`.
- Se comprobó que los cuatro paneles de Pastoral se expanden y muestran el enlace al ancla de detalle correspondiente.
- Las páginas de Nivel Primario y Secundario muestran su nivel como actual en el aside y cargan sus ilustraciones locales con texto alternativo.
- A 390 px el aside queda en flujo normal; a 1280 px el aside usa `sticky`.
- Se verificaron el menú colapsable, el acordeón de Pastoral, los filtros y detalles de noticias.
- Los dos formularios validaron los campos obligatorios y mostraron la confirmación simulada.
- Los tres enlaces PDF respondieron con HTTP 200 y `application/pdf`.
- `node --check js/main.js` finalizó sin errores.

## Lighthouse

Lighthouse 13.6.0 se ejecutó sobre `index.html` servido localmente. Son resultados de la portada, no de cada subpágina:

| Preset | Performance | Accessibility | Best Practices | SEO |
| --- | ---: | ---: | ---: | ---: |
| Móvil | 96 | 100 | 100 | 100 |
| Escritorio | 98 | 100 | 100 | 100 |

LCP medido: 2,3 s en móvil y 0,9 s en escritorio; TBT: 0 ms; CLS: 0. No se registraron errores de consola tras agregar el favicon. Lighthouse advirtió que la CPU del dispositivo de prueba móvil era más lenta de lo esperado; además, los recursos CSS de Bootstrap/Icons externos son solicitudes de bloqueo de renderizado. Conviene volver a medir en el entorno de despliegue y revisar las 13 páginas allí.

## Flujo de Git

El trabajo se realiza en `feature/maquetacion`. Revisar los cambios y las verificaciones en esa rama; luego abrir una solicitud de integración hacia `main`. Integrar en `main` únicamente después de aprobar la revisión y validar el resultado. Esta documentación no presupone que se haya creado una solicitud, un commit o una integración.

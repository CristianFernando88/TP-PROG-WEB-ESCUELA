/**
 * TP9 - Búsqueda asíncrona de alumnos (Fetch API + DOM, Vanilla JS).
 *
 * Escucha el input de búsqueda, aplica un debounce de 300 ms para no
 * saturar el servidor y reemplaza el contenido del <tbody> sin recargar
 * la página.
 */
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('inputBusqueda');
    const form = document.getElementById('formBusqueda');
    const tbody = document.getElementById('tablaAlumnosBody');

    if (!input || !tbody) {
        return; // La página no tiene la tabla (nada que buscar)
    }

    const RETRASO_MS = 300;
    let timer = null;
    let ultimoPedido = 0; // Descarta respuestas viejas que lleguen tarde

    /**
     * Escapa caracteres especiales para armar HTML seguro
     * (evita inyección de HTML/JS desde los datos de la BD).
     */
    const escapar = (valor) => String(valor ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    /** Fila de mensaje (sin resultados / error). */
    const filaMensaje = (texto) => `
        <tr>
            <td colspan="4" class="text-center text-muted py-4">${escapar(texto)}</td>
        </tr>`;

    /** Fila de alumno con el mismo diseño que renderiza el PHP. */
    const filaAlumno = (alumno) => {
        const id = Number.parseInt(alumno.id_alumno, 10) || 0;
        const nombre = String(alumno.nombre ?? '');
        const apellido = String(alumno.apellido ?? '');
        const curso = String(alumno.curso ?? '').trim() || 'Sin curso asignado';
        const estado = String(alumno.estado ?? '');
        const activo = estado === 'activo';

        const iniciales = escapar((nombre.charAt(0) + apellido.charAt(0)).toUpperCase());

        return `
        <tr>
            <td>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">
                        ${iniciales}
                    </div>
                    <span class="fw-bold text-dark">${escapar(`${nombre} ${apellido}`.trim())}</span>
                </div>
            </td>
            <td>${escapar(curso)}</td>
            <td>
                <span class="badge ${activo ? 'bg-success' : 'bg-secondary'}">${escapar(estado.charAt(0).toUpperCase() + estado.slice(1))}</span>
            </td>
            <td class="text-end text-nowrap">
                <a href="editar.php?id=${id}" class="btn btn-sm btn-warning" aria-label="Editar alumno" title="Editar">
                    <i class="bi bi-pencil" aria-hidden="true"></i>
                </a>
                <a href="eliminar.php?id=${id}" class="btn btn-sm btn-danger" aria-label="Eliminar alumno" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar a este alumno?')">
                    <i class="bi bi-trash" aria-hidden="true"></i>
                </a>
            </td>
        </tr>`;
    };

    /** Realiza la petición y repinta el tbody. */
    const buscar = async (termino) => {
        const pedido = ++ultimoPedido;

        try {
            const respuesta = await fetch(`../api/buscar_alumnos.php?q=${encodeURIComponent(termino)}`, {
                headers: { Accept: 'application/json' },
            });

            // Si mientras tanto se lanzó otra búsqueda, esta respuesta ya no interesa
            if (pedido !== ultimoPedido) {
                return;
            }

            const datos = await respuesta.json().catch(() => null);

            if (!respuesta.ok || !datos || datos.status !== 'success') {
                const mensaje = datos && datos.message
                    ? datos.message
                    : 'No se pudo completar la búsqueda.';
                tbody.innerHTML = filaMensaje(mensaje);
                return;
            }

            const alumnos = Array.isArray(datos.data) ? datos.data : [];

            if (alumnos.length === 0) {
                tbody.innerHTML = filaMensaje('No se encontraron alumnos');
                return;
            }

            tbody.innerHTML = alumnos.map(filaAlumno).join('');
        } catch (error) {
            if (pedido !== ultimoPedido) {
                return;
            }
            console.error('Error al buscar alumnos:', error);
            tbody.innerHTML = filaMensaje('Error de conexión al buscar alumnos.');
        }
    };

    /** Debounce: reinicia el temporizador en cada tecla. */
    const programarBusqueda = () => {
        clearTimeout(timer);
        timer = setTimeout(() => buscar(input.value.trim()), RETRASO_MS);
    };

    input.addEventListener('input', programarBusqueda);

    // Si el usuario presiona Enter o hace clic en "Buscar", se saltea el debounce
    if (form) {
        form.addEventListener('submit', (evento) => {
            evento.preventDefault();
            clearTimeout(timer);
            buscar(input.value.trim());
        });
    }
});

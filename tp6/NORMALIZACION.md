# TP6 - Normalización de la base de datos

## Objetivo

Este documento describe la normalización del modelo mínimo viable para Colegio Horizonte. El esquema conserva las relaciones necesarias para usuarios y roles, cursos y niveles, alumnos, tutorías, asignaciones docentes y consultas de contacto.

## 1. Tabla sin normalizar

Una primera versión podría guardar todos los datos en una única tabla:

| id_alumno | nombre_alumno | curso | nivel | materias | nombre_tutor |
|---:|---|---|---|---|---|
| 1 | Emma Costa | 3.º A | Primario | Matemática, Lengua | Lucía Costa |
| 2 | Tomás Costa | 1.º B | Secundario | Matemática, Historia | Lucía Costa |

Esta estructura repite información del curso, nivel y tutor. Además, `materias` contiene varios valores en una celda y `nombre_tutor` no identifica una relación reutilizable con una persona.

## 2. Primera Forma Normal (1FN)

La 1FN requiere que cada celda tenga un valor atómico y que no haya grupos repetitivos. Por eso, la lista `"Matemática, Lengua"` no debe almacenarse como un único campo ni repetirse en columnas como `materia_1`, `materia_2`, etc.

Cada materia y cada vínculo entre personas se representan mediante registros relacionados. Los datos del alumno, el curso y la materia quedan identificables por sus claves.

## 3. Segunda Forma Normal (2FN)

La 2FN elimina dependencias parciales de una clave compuesta. Los datos propios de un alumno —nombre, apellido y curso actual— pertenecen a `alumnos`; los datos propios de una materia pertenecen a `materias`.

La relación de un tutor con un alumno se separa a `tutor_alumno`. La asignación de una materia a un curso y un profesor se separa a `profesor_materia_curso`. Así, los atributos de personas, materias y cursos no dependen solo de una parte de la relación.

## 4. Tercera Forma Normal (3FN)

La 3FN elimina dependencias transitivas: los datos de un nivel no se repiten en cada curso, y la descripción de un rol no se repite en cada usuario.

- `cursos` guarda una FK a `niveles`; el nombre del nivel se consulta desde esa tabla.
- `usuarios` guarda una FK a `roles`; el nombre del rol se consulta desde esa tabla.
- Las materias se definen una vez en `materias` y se asocian a curso y profesor mediante `profesor_materia_curso`.

## 5. Listado final: nueve tablas

Todas las tablas usan una PK `INT AUTO_INCREMENT`. Las tablas de relación emplean una PK propia y una restricción `UNIQUE` sobre el par o la combinación relacionada para impedir duplicados.

1. **`roles`**
   - PK: `id_rol`
   - Datos: `nombre`, `descripcion`
   - Catálogo de roles, por ejemplo Admin, Directivo, Preceptor, Profesor y Tutor.

2. **`niveles`**
   - PK: `id_nivel`
   - Datos: `nombre`, `descripcion`
   - Catálogo de niveles Inicial, Primario y Secundario.

3. **`cursos`**
   - PK: `id_curso`
   - FK: `id_nivel` → `niveles.id_nivel`
   - Datos: `ciclo_lectivo`, `grado_sala`, `division`, `turno`, `capacidad`
   - Un curso pertenece a un nivel; un nivel puede tener varios cursos.

4. **`usuarios`**
   - PK: `id_usuario`
   - FK: `id_rol` → `roles.id_rol`
   - Datos: `nombre`, `apellido`, `email`, `password_hash`, `activo`, `created_at`, `updated_at`
   - El email es único para identificar la cuenta. Las contraseñas se guardan como hash, nunca en texto plano.

5. **`alumnos`**
   - PK: `id_alumno`
   - FK: `id_curso` → `cursos.id_curso`
   - Datos: `nombre`, `apellido`, `estado`, `created_at`, `updated_at`
   - En este mínimo viable el alumno tiene un curso actual. El historial de matrículas queda fuera del alcance.

6. **`materias`**
   - PK: `id_materia`
   - Datos: `nombre`, `descripcion`
   - Catálogo de materias, independiente de sus asignaciones.

7. **`tutor_alumno`**
   - PK: `id_tutor_alumno`
   - FK: `id_tutor` → `usuarios.id_usuario`; `id_alumno` → `alumnos.id_alumno`
   - Datos: `parentesco`, `es_contacto_principal`
   - `UNIQUE (id_tutor, id_alumno)` evita repetir la misma vinculación. La relación Tutor–Alumno es N:M: un tutor puede estar vinculado a varios alumnos y un alumno puede tener varios tutores.
   - La aplicación debe verificar que el usuario relacionado tenga rol Tutor.

8. **`profesor_materia_curso`**
   - PK: `id_asignacion`
   - FK: `id_profesor` → `usuarios.id_usuario`; `id_materia` → `materias.id_materia`; `id_curso` → `cursos.id_curso`
   - Datos: `carga_horaria_semanal`, `es_titular`
   - `UNIQUE (id_profesor, id_materia, id_curso)` evita duplicar una asignación idéntica. La aplicación debe verificar que el usuario tenga rol Profesor.

9. **`consultas_contacto`**
   - PK: `id_consulta`
   - FK opcional: `id_usuario` → `usuarios.id_usuario`
   - Datos: `nombre`, `email`, `asunto`, `mensaje`, `estado`, `created_at`, `updated_at`
   - `id_usuario` puede ser nulo porque el formulario de contacto es público.

### Alcance del mínimo viable

El esquema no incluye tablas adicionales para asistencia, calificaciones, aulas, historial de matrículas o asignación múltiple de roles. Por eso, los porcentajes, promedios y métricas de las vistas actuales no se persisten todavía: podrían incorporarse en una etapa posterior con entidades específicas.

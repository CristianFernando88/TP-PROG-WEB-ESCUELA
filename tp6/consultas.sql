USE colegio_horizonte;

-- CREATE: crear roles de demostración.
INSERT INTO roles (id_rol, nombre, descripcion) VALUES
    (1, 'Admin', 'Administración general'),
    (2, 'Profesor', 'Personal docente'),
    (3, 'Tutor', 'Responsable de estudiantes');

-- CREATE: crear niveles y cursos de demostración.
INSERT INTO niveles (id_nivel, nombre, descripcion) VALUES
    (1, 'Primario', 'Nivel de educación primaria'),
    (2, 'Secundario', 'Nivel de educación secundaria');

INSERT INTO cursos (id_curso, id_nivel, ciclo_lectivo, grado_sala, division, turno, capacidad) VALUES
    (1, 2, 2026, '1.º', 'A', 'manana', 30),
    (2, 1, 2026, '6.º', 'A', 'tarde', 30);

-- CREATE: crear la materia Matemática.
INSERT INTO materias (id_materia, nombre, descripcion) VALUES
    (1, 'Matemática', 'Cátedra de demostración');

-- CREATE: crear las cuentas de prueba.
-- Los password_hash son hashes bcrypt reales de la contraseña 'password123' (verificables con password_verify).
INSERT INTO usuarios (id_usuario, id_rol, nombre, apellido, email, password_hash, activo) VALUES
    (1, 1, 'Sofía', 'Méndez', 'sofia.mendez@colegiohorizonte.edu.ar', '$2y$10$3KyLw2cchs2in61IyQ.vx.mamn7nXgr3RB4Yss4Kcb8nxmeJjl6dm', 1),
    (2, 2, 'Federico', 'Gómez', 'federico.gomez@colegiohorizonte.edu.ar', '$2y$10$NYCXwX2kx4wQn04uoUl24e5sLxIlsQn2zTjeoBbQG7NfId7SBweIK', 1),
    (3, 3, 'Lucía', 'Costa', 'lucia.costa@colegiohorizonte.edu.ar', '$2y$10$vQsEMXNIDIukt.qi4FGJOeoGJraO5Obyb7AJqPrsvDenYaJPhinqy', 1);

-- CREATE: inscribir dos alumnos en 1.º A de Secundario.
INSERT INTO alumnos (id_alumno, id_curso, nombre, apellido, estado) VALUES
    (1, 1, 'Emma', 'Costa', 'activo'),
    (2, 1, 'Tomás', 'Costa', 'activo');

-- CREATE: vincular al usuario Tutor con Emma y Tomás.
INSERT INTO tutor_alumno (id_tutor_alumno, id_tutor, id_alumno, parentesco, es_contacto_principal) VALUES
    (1, 3, 1, 'Madre', 1),
    (2, 3, 2, 'Madre', 1);

-- CREATE: asignar Matemática de 1.º A al usuario Profesor.
INSERT INTO profesor_materia_curso (
    id_asignacion,
    id_profesor,
    id_materia,
    id_curso,
    carga_horaria_semanal,
    es_titular
) VALUES
    (1, 2, 1, 1, 6, 1);

-- CREATE: guardar una consulta de contacto de prueba.
INSERT INTO consultas_contacto (
    id_consulta,
    id_usuario,
    nombre,
    email,
    asunto,
    mensaje,
    estado
) VALUES
    (1, 3, 'Lucía Costa', 'lucia.costa@colegiohorizonte.edu.ar', 'Consulta general', 'Consulta de prueba del TP6.', 'pendiente');

-- READ 1: listar los usuarios con rol Tutor, ordenados por apellido.
SELECT id_usuario, nombre, apellido, email
FROM usuarios
WHERE id_rol = 3
ORDER BY apellido, nombre;

-- READ 2: mostrar cada tutor, sus alumnos y el parentesco.
SELECT
    u.nombre AS nombre_tutor,
    u.apellido AS apellido_tutor,
    a.nombre AS nombre_alumno,
    a.apellido AS apellido_alumno,
    ta.parentesco
FROM usuarios AS u
INNER JOIN tutor_alumno AS ta
    ON ta.id_tutor = u.id_usuario
INNER JOIN alumnos AS a
    ON a.id_alumno = ta.id_alumno
ORDER BY u.apellido, a.apellido, a.nombre;

-- UPDATE: actualizar el email del usuario Admin con ID 1.
UPDATE usuarios
SET email = 'sofia.mendez.actualizado@colegiohorizonte.edu.ar'
WHERE id_usuario = 1;

-- DELETE: eliminar la consulta de contacto de prueba con ID 1.
DELETE FROM consultas_contacto
WHERE id_consulta = 1;

CREATE DATABASE IF NOT EXISTS colegio_horizonte
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE colegio_horizonte;

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(150) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE niveles (
    id_nivel INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(150) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_nivel INT NOT NULL,
    ciclo_lectivo YEAR NOT NULL,
    grado_sala VARCHAR(30) NOT NULL,
    division VARCHAR(10) NOT NULL DEFAULT '',
    turno VARCHAR(20) NOT NULL,
    capacidad SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    CONSTRAINT fk_cursos_niveles
        FOREIGN KEY (id_nivel) REFERENCES niveles (id_nivel)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT uq_curso_nivel_ciclo_grado_division_turno
        UNIQUE (id_nivel, ciclo_lectivo, grado_sala, division, turno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_usuarios_email UNIQUE (email),
    CONSTRAINT fk_usuarios_roles
        FOREIGN KEY (id_rol) REFERENCES roles (id_rol)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE INDEX idx_usuarios_email ON usuarios(email);

CREATE TABLE alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    id_curso INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    estado VARCHAR(30) NOT NULL DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_alumnos_cursos
        FOREIGN KEY (id_curso) REFERENCES cursos (id_curso)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE INDEX idx_alumnos_apellido ON alumnos(apellido);

CREATE TABLE materias (
    id_materia INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE tutor_alumno (
    id_tutor_alumno INT AUTO_INCREMENT PRIMARY KEY,
    id_tutor INT NOT NULL,
    id_alumno INT NOT NULL,
    parentesco VARCHAR(50) NULL,
    es_contacto_principal TINYINT(1) NOT NULL DEFAULT 0,
    CONSTRAINT uq_tutor_alumno UNIQUE (id_tutor, id_alumno),
    CONSTRAINT fk_tutor_alumno_usuarios
        FOREIGN KEY (id_tutor) REFERENCES usuarios (id_usuario)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_tutor_alumno_alumnos
        FOREIGN KEY (id_alumno) REFERENCES alumnos (id_alumno)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE profesor_materia_curso (
    id_asignacion INT AUTO_INCREMENT PRIMARY KEY,
    id_profesor INT NOT NULL,
    id_materia INT NOT NULL,
    id_curso INT NOT NULL,
    carga_horaria_semanal TINYINT UNSIGNED NOT NULL,
    es_titular TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT uq_profesor_materia_curso
        UNIQUE (id_profesor, id_materia, id_curso),
    CONSTRAINT fk_profesor_materia_curso_usuarios
        FOREIGN KEY (id_profesor) REFERENCES usuarios (id_usuario)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_profesor_materia_curso_materias
        FOREIGN KEY (id_materia) REFERENCES materias (id_materia)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_profesor_materia_curso_cursos
        FOREIGN KEY (id_curso) REFERENCES cursos (id_curso)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE consultas_contacto (
    id_consulta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    nombre VARCHAR(150) NOT NULL,
    email VARCHAR(254) NOT NULL,
    asunto VARCHAR(50) NOT NULL,
    mensaje TEXT NOT NULL,
    estado VARCHAR(30) NOT NULL DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_consultas_contacto_usuarios
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

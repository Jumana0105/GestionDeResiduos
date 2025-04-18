CREATE DATABASE IF NOT EXISTS gestion_bd;
USE gestion_bd;

-- Tabla de talleres
CREATE TABLE talleres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT,
    fecha DATE
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    direccion TEXT,
    numero_casa VARCHAR(20),
    comunidad VARCHAR(100) NOT NULL,
    foto_perfil VARCHAR(255),
    puntos INT DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    telefono VARCHAR(50)
);

-- Tabla de inscripciones
CREATE TABLE inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_taller INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (id_taller) REFERENCES talleres(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Índices personalizados para inscripciones
CREATE INDEX idx_inscripciones_usuario ON inscripciones(id_usuario);
CREATE INDEX idx_inscripciones_taller ON inscripciones(id_taller);

-- Tabla de recolecciones
CREATE TABLE recolecciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo_residuo VARCHAR(100),
    estado VARCHAR(50) DEFAULT 'pendiente',
    fecha_solicitada DATE,
    fecha_confirmada DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Índice personalizado para recolecciones
CREATE INDEX idx_recolecciones_usuario ON recolecciones(id_usuario);

-- Tabla de reportes
CREATE TABLE reportes (
    id_usuario INT NOT NULL,
    descripcion TEXT NOT NULL,
    ubicacion VARCHAR(200),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Índice personalizado para reportes
CREATE INDEX idx_reportes_usuario ON reportes(id_usuario);

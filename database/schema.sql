-- Restaurante Vegano - Esquema de Base de Datos

CREATE DATABASE IF NOT EXISTS restaurante CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE restaurante;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'mesero', 'administrador') DEFAULT 'cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    orden INT DEFAULT 0
);

CREATE TABLE platos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

CREATE TABLE cajas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_apertura DATETIME NOT NULL,
    monto_inicial DECIMAL(10,2) DEFAULT 0,
    monto_cierre DECIMAL(10,2) DEFAULT 0,
    total_ventas DECIMAL(10,2) DEFAULT 0,
    estado ENUM('abierta', 'cerrada') DEFAULT 'abierta',
    fecha_cierre DATETIME NULL
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    caja_id INT,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'en_preparacion', 'listo', 'cerrado') DEFAULT 'pendiente',
    fecha_hora DATETIME NOT NULL,
    fecha_cierre DATETIME NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (caja_id) REFERENCES cajas(id)
);

CREATE TABLE detalle_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    plato_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (plato_id) REFERENCES platos(id)
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    personas INT NOT NULL,
    estado ENUM('confirmada', 'cancelada') DEFAULT 'confirmada',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Datos iniciales
INSERT INTO categorias (nombre, descripcion, orden) VALUES
('Entradas', 'Deliciosas entradas veganas', 1),
('Principales', 'Platos principales', 2),
('Postres', 'Dulces opciones', 3),
('Bebidas', 'Bebidas frescas', 4);
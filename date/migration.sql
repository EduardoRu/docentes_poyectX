CREATE DATABASE docentes;

use docentes;

CREATE TABLE usuario (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido_paterno VARCHAR(60) NOT NULL,
  apellido_materno VARCHAR(60) NOT NULL,
  email VARCHAR(80) NOT NULL,
  password LONGTEXT NOT NULL,
  rol VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carrera (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre_carrera VARCHAR(100) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create TABLE candidatos_docentes (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL,
  apellido_paterno VARCHAR(60) NOT NULL,
  apellido_materno VARCHAR(60) NOT NULL,
  correo_electronico VARCHAR(60) NOT NULL,
  domicilio VARCHAR(100) NOT NULL,
  telefono BIGINT NOT NULL,
  municipio VARCHAR(100) NOT NULL,
  escolaridad VARCHAR(100) NOT NULL,
  status VARCHAR(60) NOT NULL DEFAULT 'pendiente',
  id_Carrera INT(11) UNSIGNED NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_Carrera) REFERENCES carrera(id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
# mariel123
INSERT INTO `usuario` (`nombre`, `apellido_paterno`, `apellido_materno`, `email`, `password`, `rol` ,`created_at`, `updated_at`) VALUES ('Mariel S.', 'Saucedo', 'Hernández', 'mariel@gmail.com', '$2y$10$2Ah1NLTKDfewDL36VaG.BeJ1OVgq/Ez1ncaSSDCTUaTX3tOO52zZ.', 'admin',current_timestamp(), current_timestamp());
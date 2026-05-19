CREATE DATABASE IF NOT EXISTS sistemaliga_tpe CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sistemaliga_tpe;

DROP TABLE IF EXISTS jugadores;
DROP TABLE IF EXISTS equipos;
DROP TABLE IF EXISTS ligas;

CREATE TABLE ligas (
  id_liga INT NOT NULL AUTO_INCREMENT,
  nombre_liga VARCHAR(110) NOT NULL,
  ciudad_sede VARCHAR(100) NOT NULL DEFAULT '',
  cant_equipos INT NOT NULL DEFAULT 0,
  temporada INT NOT NULL DEFAULT 2026,
  PRIMARY KEY (id_liga),
  UNIQUE KEY uk_ligas_nombre (nombre_liga)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE equipos (
  id_equipo INT NOT NULL AUTO_INCREMENT,
  nombre_equipo VARCHAR(110) NOT NULL,
  nombre_liga VARCHAR(110) NOT NULL,
  escudo TEXT NULL,
  ciudad_equipo VARCHAR(100) NOT NULL DEFAULT '',
  dt VARCHAR(100) NOT NULL DEFAULT '',
  presidente VARCHAR(100) NOT NULL DEFAULT '',
  nombre_estadio VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (id_equipo),
  KEY idx_equipo_liga (nombre_liga),
  CONSTRAINT fk_equipo_liga FOREIGN KEY (nombre_liga) REFERENCES ligas(nombre_liga) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE jugadores (
  id_jugador INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  edad INT NOT NULL,
  id_equipo INT NOT NULL,
  id_liga INT NOT NULL,
  dorsal INT NULL,
  posicion VARCHAR(60) NOT NULL,
  estado VARCHAR(60) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (id_jugador),
  KEY idx_jugador_equipo (id_equipo),
  KEY idx_jugador_liga (id_liga),
  CONSTRAINT fk_jugador_equipo FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_jugador_liga FOREIGN KEY (id_liga) REFERENCES ligas(id_liga) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO ligas (id_liga, nombre_liga, ciudad_sede, cant_equipos, temporada) VALUES
(1, 'liga de tandil', 'Tandil', 2, 2026);

INSERT INTO equipos (id_equipo, nombre_equipo, nombre_liga, escudo, ciudad_equipo, dt, presidente, nombre_estadio) VALUES
(1, 'Club y Biblioteca Ramón Santamarina', 'liga de tandil', '', 'Tandil', '', '', 'Estadio Municipal Gral San Martín'),
(2, 'Deportivo Pirovano', 'liga de tandil', '', 'Pirovano', '', '', '');

INSERT INTO jugadores (nombre, apellido, edad, id_equipo, id_liga, dorsal, posicion, estado) VALUES
('Francisco', 'Cervone', 30, 2, 1, 17, 'Arquero', 'Activo');

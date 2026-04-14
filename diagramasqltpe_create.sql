-- Created by Redgate Data Modeler (https://datamodeler.redgate-platform.com)
-- Last modification date: 2026-04-14 22:47:25.484

-- tables
-- Table: equipos
CREATE TABLE equipos (
    id_equipo int(11)  NOT NULL,
    nombre int(11)  NOT NULL,
    escudo text  NOT NULL,
    ciudad_equipo varchar(100)  NOT NULL,
    presidente varchar(100)  NOT NULL,
    nombre_estadio varchar(100)  NOT NULL,
    id_liga int  NOT NULL,
    UNIQUE INDEX id_liga (id_equipo),
    CONSTRAINT id_equipo PRIMARY KEY (id_equipo)
) ENGINE InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Table: jugadores
CREATE TABLE jugadores (
    id_jugador int(11)  NOT NULL,
    id_liga int(11)  NOT NULL,
    nombre int(11)  NOT NULL,
    apellido int(11)  NOT NULL,
    edad int(11)  NOT NULL,
    posicion int(11)  NOT NULL,
    id_equipo int(11)  NOT NULL,
    UNIQUE INDEX id_equipo (id_equipo),
    CONSTRAINT id_jugador PRIMARY KEY (id_jugador)
) ENGINE InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Table: liga
CREATE TABLE liga (
    id_liga int  NOT NULL,
    nombre varchar(20)  NOT NULL,
    ciudad_sede varchar(40)  NOT NULL,
    cant_equipos int(11)  NOT NULL,
    temporada int(11)  NOT NULL,
    CONSTRAINT liga_pk PRIMARY KEY (id_liga)
) ENGINE InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- foreign keys
-- Reference: equipos_liga (table: equipos)
ALTER TABLE equipos ADD CONSTRAINT equipos_liga FOREIGN KEY equipos_liga (id_liga)
    REFERENCES liga (id_liga);

-- Reference: jugadores_equipos (table: jugadores)
ALTER TABLE jugadores ADD CONSTRAINT jugadores_equipos FOREIGN KEY jugadores_equipos (id_equipo)
    REFERENCES equipos (id_equipo);

-- End of file.


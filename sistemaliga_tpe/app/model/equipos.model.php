<?php

class EquiposModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8',
            'root',
            ''
        );
    }

    public function getAll() {
        $query = $this->db->prepare(
            'SELECT e.*, l.id_liga, l.nombre_liga
             FROM equipos e
             LEFT JOIN ligas l ON TRIM(e.nombre_liga) = TRIM(l.nombre_liga)'
        );
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByLiga($id_liga) {
        $query = $this->db->prepare(
            'SELECT e.*, l.id_liga, l.nombre_liga
             FROM equipos e
             LEFT JOIN ligas l ON TRIM(e.nombre_liga) = TRIM(l.nombre_liga)
             WHERE l.id_liga = ?'
        );
        $query->execute([$id_liga]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $query = $this->db->prepare(
            'SELECT * FROM equipos WHERE id_equipo = ?'
        );
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

   public function insert($nombre_equipo, $nombre_liga,  $escudo,  $ciudad_equipo,$dt, $presidente, $nombre_estadio) {
    $query = $this->db->prepare(
        'INSERT INTO equipos(nombre_equipo, nombre_liga,  escudo,  ciudad_equipo ,dt, presidente, nombre_estadio)
         VALUES(?, ?, ?, ?, ?, ?, ?)'
    );

    $query->execute([  $nombre_equipo, $nombre_liga, $escudo,  $ciudad_equipo ,$dt,  $presidente,$nombre_estadio]);

    return $this->db->lastInsertId();
}

    public function update($id, $nombre, $id_liga,$escudo, $ciudad, $dt, $presidente, $estadio) {
        $query = $this->db->prepare(
            'UPDATE equipos
             SET nombre_equipo = ?, nombre_liga = ?,escudo=?, ciudad_equipo = ?, dt = ?, presidente = ?, nombre_estadio = ?
             WHERE id_equipo = ?'
        );
        $query->execute([$nombre, $id_liga, $escudo, $ciudad, $dt, $presidente, $estadio, $id]);
    }

    public function delete($id_equipo) {
        $query = $this->db->prepare(
            'DELETE FROM equipos WHERE id_equipo = ?'
        );
        $query->execute([$id_equipo]);
    }
}
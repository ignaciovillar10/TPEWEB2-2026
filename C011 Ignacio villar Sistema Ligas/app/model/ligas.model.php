<?php

class LigasModel {
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
            'SELECT l.*, COUNT(e.id_equipo) AS cant_equipos
             FROM ligas l
             LEFT JOIN equipos e ON TRIM(e.nombre_liga) = TRIM(l.nombre_liga)
             GROUP BY l.id_liga, l.nombre_liga, l.ciudad_sede, l.temporada'
        );
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM ligas WHERE id_liga = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($nombre_liga, $ciudad_sede = '', $cant_equipos = 0, $temporada = null) {
        $temporada = $temporada ?? date('Y');
        $query = $this->db->prepare(
            'INSERT INTO ligas(nombre_liga, ciudad_sede, cant_equipos, temporada) VALUES(?, ?, ?, ?)'
        );
        $query->execute([$nombre_liga, $ciudad_sede, $cant_equipos, $temporada]);

        return $this->db->lastInsertId();
    }

public function update($id, $nombre_liga, $ciudad_sede, $temporada) {
    $query = $this->db->prepare(
        'UPDATE ligas 
         SET nombre_liga = ?, ciudad_sede = ?, temporada = ?
         WHERE id_liga = ?'
    );

    $query->execute([
        $nombre_liga,
        $ciudad_sede,
        $temporada,
        $id
    ]);
}

    public function delete($id) {
        $query = $this->db->prepare(
            'DELETE FROM ligas WHERE id_liga = ?'
        );
        $query->execute([$id]);
    }
}

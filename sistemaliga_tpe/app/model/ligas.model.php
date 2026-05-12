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
        $query = $this->db->prepare('SELECT * FROM ligas');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM ligas WHERE id_liga = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($nombre_liga) {
        $query = $this->db->prepare(
            'INSERT INTO ligas(nombre_liga) VALUES(?)'
        );
        $query->execute([$nombre_liga]);

        return $this->db->lastInsertId();
    }

public function update($id, $nombre_liga, $ciudad_sede, $cant_equipos, $temporada) {
    $query = $this->db->prepare(
        'UPDATE ligas 
         SET nombre_liga = ?, ciudad_sede = ?, cant_equipos = ?, temporada = ?
         WHERE id_liga = ?'
    );

    $query->execute([
        $nombre_liga,
        $ciudad_sede,
        $cant_equipos,
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
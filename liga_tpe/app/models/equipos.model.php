<?php

class EquiposModel {
   private $db;

   public function __construct() {
      // 1. abre conexión con DB
      $this->db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');
   }

   public function getAll() {
      // 2. prepara y ejecuta la consulta con el nombre de la liga
      $query = $this->db->prepare(
         'SELECT e.*, l.nombre_liga AS nombre_liga
            FROM equipos e
            LEFT JOIN ligas l ON e.id_liga = l.id_liga'
      );
      $query->execute();

      // 3. obtiene los resultados
      $equipos = $query->fetchAll(PDO::FETCH_OBJ);

      return $equipos;
   }

   public function getEquiposByLiga($id_liga) {
      $query = $this->db->prepare(
         'SELECT e.*, l.nombre_liga AS nombre_liga
            FROM equipos e
            LEFT JOIN ligas l ON e.id_liga = l.id_liga
           WHERE e.id_liga = ?'
      );
      $query->execute([$id_liga]);

      return $query->fetchAll(PDO::FETCH_OBJ);
   }

   public function getEquipoById($id_equipo) {
      $query = $this->db->prepare('SELECT * FROM equipos WHERE id_equipo = ?');
      $query->execute([$id_equipo]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function insert($nombre_equipo, $id_liga, $dt, $presidente, $nombre_estadio) {
      $query = $this->db->prepare('INSERT INTO equipos(nombre_equipo,id_liga,dt,presidente,nombre_estadio) VALUES(?,?,?,?,?)');
      $query->execute([$nombre_equipo, $id_liga, $dt, $presidente, $nombre_estadio]);

      return $this->db->lastInsertId();
   }

   public function update($id_equipo, $nombre_equipo, $id_liga, $dt, $presidente, $nombre_estadio) {
      $query = $this->db->prepare('UPDATE equipos SET nombre_equipo = ?, id_liga = ?, dt = ?, presidente = ?, nombre_estadio = ? WHERE id_equipo = ?');
      $query->execute([$nombre_equipo, $id_liga, $dt, $presidente, $nombre_estadio, $id_equipo]);
   }

   public function delete($id_equipo) {
      $query = $this->db->prepare('DELETE FROM equipos WHERE id_equipo = ?');
      $query->execute([$id_equipo]);
   }


}

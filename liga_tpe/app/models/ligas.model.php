<?php

class LigasModel {
   private $db;

   public function __construct() {
      // 1. abre conexión con DB
      $this->db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');
   }

   public function getAll() {
      // 2. prepara y ejecuta la consulta
      $query = $this->db->prepare('SELECT * FROM ligas');
      $query->execute();

      // 3. obtiene los resultados
      $ligas = $query->fetchAll(PDO::FETCH_OBJ);

      // var_dump($query->errorInfo());

      return $ligas;
   }

   public function getLigaById($id_liga) {
      $query = $this->db->prepare('SELECT * FROM ligas WHERE id_liga = ?');
      $query->execute([$id_liga]);

      return $query->fetch(PDO::FETCH_OBJ);
   }

   public function insert($nombre_liga) {
       $query = $this->db->prepare('INSERT INTO ligas (nombre) VALUES(?)');
       $query->execute([$nombre_liga]);

       return $this->db->lastInsertId();
   }

   public function update($id_liga, $nombre_liga) {
       $query = $this->db->prepare('UPDATE ligas SET nombre = ? WHERE id_liga = ?');
       $query->execute([$nombre_liga, $id_liga]);
   }

   public function delete($id_liga) {
      $query = $this->db->prepare('DELETE FROM ligas WHERE id_liga = ?');
      $query->execute([$id_liga]);
   }
}

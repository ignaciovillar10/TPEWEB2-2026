<?php

class JugadoresModel {
   private $db;

   public function __construct() {
      // 1. abre conexión con DB
      $this->db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');
   }

   public function getAll() {
      // 2. prepara y ejecuta la consulta
      $query = $this->db->prepare('SELECT * FROM jugadores');
      $query->execute();

      // 3. obtiene los resultados
      $jugadores = $query->fetchAll(PDO::FETCH_OBJ);

      // var_dump($query->errorInfo());

      return $jugadores;
   }

   public function getJugadoresByEquipo($id_equipo) {
      $query = $this->db->prepare('SELECT * FROM jugadores WHERE id_equipo = ?');
      $query->execute([$id_equipo]);

      return $query->fetchAll(PDO::FETCH_OBJ);
   }

   public function getJugadorById($id_jugador) {
       $query = $this->db->prepare('SELECT * FROM jugadores WHERE id_jugador = ?');
       $query->execute([$id_jugador]);

       return $query->fetch(PDO::FETCH_OBJ);
   }

   public function insert($id_equipo, $nombre, $apellido, $Edad, $Dorsal, $posicion, $estado) {
       $query = $this->db->prepare('INSERT INTO jugadores (id_equipo, nombre, apellido, Edad, Dorsal, posicion, estado) VALUES(?, ?, ?, ?, ?, ?, ?)');
       $query->execute([$id_equipo, $nombre, $apellido, $Edad, $Dorsal, $posicion, $estado]);

       return $this->db->lastInsertId();
   }

   public function update($id_jugador, $id_equipo, $nombre, $apellido, $Edad, $Dorsal, $posicion, $estado) {
       $query = $this->db->prepare('UPDATE jugadores SET id_equipo = ?, nombre = ?, apellido = ?, Edad = ?, Dorsal = ?, posicion = ?, estado = ? WHERE id_jugador = ?');
       $query->execute([$id_equipo, $nombre, $apellido, $Edad, $Dorsal, $posicion, $estado, $id_jugador]);
   }

   public function delete($id_jugador) {
      $query = $this->db->prepare('DELETE FROM jugadores WHERE id_jugador = ?');
      $query->execute([$id_jugador]);
   }


}

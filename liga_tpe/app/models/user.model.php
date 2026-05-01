<?php

class UserModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');
    }

    /**
     * Retorna un usuario según el username pasado.
     */
    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute(array($username));

        return $query->fetch(PDO::FETCH_OBJ);
    }

}
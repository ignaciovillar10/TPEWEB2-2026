<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8',
            'root',
            ''
        );
    }

  public function getByUsername($username) {
    $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
    $query->execute([$username]);

    return $query->fetch(PDO::FETCH_OBJ);
}

public function usernameExists($username) {
    $query = $this->db->prepare('SELECT COUNT(*) FROM usuarios WHERE username = ?');
    $query->execute([$username]);

    return $query->fetchColumn() > 0;
}

public function insertUser($username, $password, $rol = 'admin') {
    $query = $this->db->prepare(
        'INSERT INTO usuarios(username, password, rol) VALUES (?, ?, ?)'
    );
    $query->execute([$username, $password, $rol]);

    return $this->db->lastInsertId();
}
}
<?php

require_once __DIR__ . '/../model/user.model.php';

class LoginController {
    private $model;
    private $res;

    public function __construct($res) {
        $this->model = new UserModel();
        $this->res = $res;
    }

    public function showLogin() {
        require_once __DIR__ . '/../view/templates/login.phtml';
    }

public function verifyUser() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $this->model->getByUsername($username);

    if ($user && password_verify($password, $user->{'password'})) {
        $_SESSION['ID_USER'] = $user->id_usuario;
        $_SESSION['USERNAME'] = $user->{'username'};
        $_SESSION['ROL'] = $user->rol;

        header('Location: ' . route_url('ligas'));
        die();
    }

    $error = 'Usuario o contraseña incorrectos';
    require_once __DIR__ . '/../view/templates/login.phtml';
}

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header('Location: ' . route_url('ligas'));
        die();
    }
    public function showRegister() {
    require_once __DIR__ . '/../view/templates/register.phtml';
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
public function saveUser() {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Completá usuario y contraseña';
        require_once __DIR__ . '/../view/templates/register.phtml';
        return;
    }

    if ($this->model->usernameExists($username)) {
        $error = 'Ese usuario ya existe';
        require_once __DIR__ . '/../view/templates/register.phtml';
        return;
    }

    // 🔥 HASH CORRECTO
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $this->model->insertUser($username, $hash, 'admin');

    header('Location: ' . route_url('login'));
    die();
}
}

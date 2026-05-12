<?php
require_once __DIR__ . '/../model/ligas.model.php';
require_once __DIR__ . '/../view/ligas.view.php';

class LigasController {
    private LigasModel $model;
    private LigasView $view;


    public function __construct() {
        $db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');

        $this->model = new LigasModel($db); // ✅ FIX
        $this->view = new LigasView();
    }
public function insert($nombre_liga, $ciudad_sede, $cant_equipos, $temporada) {
    $query = $this->db->prepare(
        'INSERT INTO ligas(nombre_liga, ciudad_sede, cant_equipos, temporada)
         VALUES(?, ?, ?, ?)'
    );

    $query->execute([
        $nombre_liga,
        $ciudad_sede,
        $cant_equipos,
        $temporada
    ]);

    return $this->db->lastInsertId();
}

    public function showAll($ligaToEdit = null): void {
        $ligas = $this->model->getAll();
        $this->view->renderligas($ligas, $ligaToEdit);
    }

    public function add(): void {
        $nombre_liga = trim($_POST['nombre_liga'] ?? '');
        $ciudad_sede = trim($_POST['ciudad_sede'] ?? '');
        $cant_equipos = (int)($_POST['cant_equipos'] ?? 0);
        $temporada = (int)($_POST['temporada'] ?? date('Y'));
        if ($nombre_liga !== '') {
            $this->model->insert($nombre_liga, $ciudad_sede, $cant_equipos, $temporada);
        }
        header('Location: ' . BASE_URL . 'ligas');
    }

    public function edit($id_liga): void {
        if (!$id_liga) { header('Location: ' . BASE_URL . 'ligas'); return; }
        $this->showAll($this->model->getById($id_liga));
    }

public function update(): void {
    $id_liga = $_POST['id_liga'] ?? null;
    $nombre_liga = trim($_POST['nombre_liga'] ?? '');
    $ciudad_sede = trim($_POST['ciudad_sede'] ?? '');
    $cant_equipos = (int)($_POST['cant_equipos'] ?? 0);
    $temporada = (int)($_POST['temporada'] ?? date('Y'));

    if ($id_liga && $nombre_liga !== '') {
        $this->model->update($id_liga, $nombre_liga, $ciudad_sede, $cant_equipos, $temporada);
    }

    header('Location: ' . BASE_URL . 'ligas');
    die();
}

    public function delete($id_liga): void {
        if ($id_liga) {
            $this->model->delete($id_liga);
        }
        header('Location: ' . BASE_URL . 'ligas');
    }
}

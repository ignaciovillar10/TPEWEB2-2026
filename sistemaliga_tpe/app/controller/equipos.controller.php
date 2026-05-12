<?php

require_once __DIR__ . '/../model/equipos.model.php';
require_once __DIR__ . '/../model/ligas.model.php';
require_once __DIR__ . '/../view/equipos.view.php';

class EquiposController {
    private $model;
    private $ligasModel;
    private $view;
    private $res;

    public function __construct($res) {
        $this->model = new EquiposModel();
        $this->ligasModel = new LigasModel();
        $this->view = new EquiposView();
        $this->res = $res;
    }

    public function showAll() {
        $equipos = $this->model->getAll();
        $ligas = $this->ligasModel->getAll();

      $nombre_liga = 'todas las ligas';
$this->view->renderEquipos($equipos, $ligas, null, $nombre_liga, $this->res);
    }
public function showByLiga($id_liga) {
    $equipos = $this->model->getByLiga($id_liga);
    $ligas = $this->ligasModel->getAll();
    $liga = $this->ligasModel->getById($id_liga);

    $nombre_liga = $liga ? $liga->nombre_liga : 'Liga no encontrada';

    $this->view->renderEquipos($equipos, $ligas, $id_liga, $nombre_liga, null);
}
   public function add() {
    $nombre_equipo = $_POST['nombre_equipo'] ?? '';
    $nombre_liga = $_POST['nombre_liga'] ?? '';
    $dt = $_POST['dt'] ?? '';
    $presidente = $_POST['presidente'] ?? '';
    $nombre_estadio = $_POST['nombre_estadio'] ?? '';

    if (empty($nombre_equipo) || empty($nombre_liga)) {
        header('Location: ' . BASE_URL . 'equipos');
        die();
    }

    $this->model->insert($nombre_equipo, $nombre_liga, $dt, $presidente, $nombre_estadio);

    header('Location: ' . BASE_URL . 'equipos');
    die();
}
    public function edit($id) {
        if (!$id) {
            header('Location: ' . BASE_URL . 'equipos');
            die();
        }

        $equipos = $this->model->getAll();
        $ligas = $this->ligasModel->getAll();
        $equipoToEdit = $this->model->getById($id);

        $this->view->renderEquipos($equipos, $ligas, $equipoToEdit, $this->res);
    }

    public function update() {
        $id = $_POST['id_equipo'] ?? null;
        $nombre = $_POST['nombre'] ?? '';
        $id_liga = $_POST['id_liga'] ?? null;
        $dt = $_POST['dt'] ?? '';
        $presidente = $_POST['presidente'] ?? '';
        $estadio = $_POST['estadio'] ?? '';

        if (!$id || empty($nombre) || !$id_liga) {
            header('Location: ' . BASE_URL . 'equipos');
            die();
        }

        $this->model->update($id, $nombre, $id_liga, $dt, $presidente, $estadio);
        header('Location: ' . BASE_URL . 'equipos');
        die();
    }

    public function delete($id) {
        if ($id) {
            $this->model->delete($id);
        }

        header('Location: ' . BASE_URL . 'equipos');
        die();
    }
}
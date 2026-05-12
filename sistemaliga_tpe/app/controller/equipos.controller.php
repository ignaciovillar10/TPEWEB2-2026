<?php

require_once __DIR__ . '/../model/equipos.model.php';
require_once __DIR__ . '/../model/ligas.model.php';
require_once __DIR__ . '/../view/equipos.view.php';
require_once __DIR__ . '/../view/ligas.view.php';

class EquiposController {
    private $model;
    private $ligasModel;
    private $view;
    private $res;
    private $viewligas;

    public function __construct($res) {
        $this->model = new EquiposModel();
        $this->ligasModel = new LigasModel();
        $this->view = new EquiposView();
        $this->res = $res;
        $this->viewligas = new LigasView();
    }

    public function showAll() {
        $equipos = $this->model->getAll();
        $ligas = $this->ligasModel->getAll();

      $nombre_liga = 'todas las ligas';
$this->view->renderEquipos($equipos, $nombre_liga, null,null, $ligas);
    }
public function showByLiga($id_liga) {
    $equipos = $this->model->getByLiga($id_liga);
    $ligas = $this->ligasModel->getAll();
    $liga = $this->ligasModel->getById($id_liga);


    $nombre_liga = $liga->nombre_liga;
    $this->view->renderEquipos($equipos, $nombre_liga, null,$id_liga, $ligas); 

}
     public function add() {
    $nombre_equipo = $_POST['nombre_equipo'] ?? '';
    $nombre_liga = $_POST['id_liga'] ?? '';
    $escudo = $_POST['escudo'] ?? '';
    $ciudad = $_POST['ciudad_equipo'] ?? '';
    $dt = $_POST['dt'] ?? '';
    $presidente = $_POST['presidente'] ?? '';
    $nombre_estadio = $_POST['nombre_estadio'] ?? '';

    if (empty($nombre_equipo) || empty($nombre_liga)) {
        header('Location: ' . BASE_URL . 'equipos');
        die();

    }
    $this->model->insert($nombre_equipo, $nombre_liga,  $escudo,  $ciudad,$dt, $presidente, $nombre_estadio);

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

        $this->view->renderEquipos($equipos, null, $equipoToEdit, null, $ligas);
    }

    public function update() {
        $id = $_POST['id_equipo'] ?? null;
        $nombre_equipo= $_POST['nombre_equipo'] ?? '';
        $id_liga = $_POST['id_liga'] ?? null;        
        $escudo = $_POST['escudo'] ?? '';
        $ciudad = $_POST['ciudad_equipo'] ?? '';
        $dt = $_POST['dt'] ?? '';
        $presidente = $_POST['presidente'] ?? '';
        $estadio = $_POST['nombre_estadio'] ?? '';

        if (!$id || empty($nombre_equipo) || !$id_liga) {
            header('Location: ' . BASE_URL . 'equipos');
            die();
        }

        $this->model->update($id, $nombre_equipo, $id_liga,$escudo, $ciudad, $dt, $presidente, $estadio);
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
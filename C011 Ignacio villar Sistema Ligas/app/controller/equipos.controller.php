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

        $this->view->renderEquipos($equipos, $nombre_liga, null, null, $ligas);
    }

    public function showByLiga($id_liga) {
        $equipos = $this->model->getByLiga($id_liga);
        $ligas = $this->ligasModel->getAll();
        $liga = $this->ligasModel->getById($id_liga);

        if (!$liga) {
            header('Location: ' . route_url('equipos'));
            die();
        }

        $this->view->renderEquipos($equipos, $liga->nombre_liga, null, $id_liga, $ligas);
    }

    public function add() {
        $nombre_equipo = $_POST['nombre_equipo'] ?? '';
        $id_liga = $_POST['id_liga'] ?? null;
        $ciudad = $_POST['ciudad_equipo'] ?? '';
        $nombre_estadio = $_POST['nombre_estadio'] ?? '';
        $liga = $id_liga ? $this->ligasModel->getById($id_liga) : null;

        if (empty($nombre_equipo) || !$liga) {
            header('Location: ' . route_url('equipos'));
            die();
        }

        $this->model->insert($nombre_equipo, $liga->nombre_liga, $ciudad, $nombre_estadio);

        header('Location: ' . route_url('equipos/' . $id_liga));
        die();
    }

    public function edit($id) {
        if (!$id) {
            header('Location: ' . route_url('equipos'));
            die();
        }

        $equipos = $this->model->getAll();
        $ligas = $this->ligasModel->getAll();
        $equipoToEdit = $this->model->getById($id);

        $this->view->renderEquipos($equipos, null, $equipoToEdit, null, $ligas);
    }

    public function update() {
        $id = $_POST['id_equipo'] ?? null;
        $nombre_equipo = $_POST['nombre_equipo'] ?? '';
        $id_liga = $_POST['id_liga'] ?? null;
        $ciudad = $_POST['ciudad_equipo'] ?? '';
        $estadio = $_POST['nombre_estadio'] ?? '';
        $liga = $id_liga ? $this->ligasModel->getById($id_liga) : null;

        if (!$id || empty($nombre_equipo) || !$liga) {
            header('Location: ' . route_url('equipos'));
            die();
        }

        $this->model->update($id, $nombre_equipo, $liga->nombre_liga, $ciudad, $estadio);

        header('Location: ' . route_url('equipos/' . $id_liga));
        die();
    }

    public function delete($id) {
        $equipo = $id ? $this->model->getById($id) : null;

        if ($id) {
            $this->model->delete($id);
        }

        if ($equipo && !empty($equipo->id_liga)) {
            header('Location: ' . route_url('equipos/' . $equipo->id_liga));
            die();
        }

        header('Location: ' . route_url('equipos'));
        die();
    }
}

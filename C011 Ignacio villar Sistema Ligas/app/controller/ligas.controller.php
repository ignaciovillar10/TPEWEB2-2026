<?php
require_once __DIR__ . '/../model/ligas.model.php';
require_once __DIR__ . '/../view/ligas.view.php';

class LigasController {
    private LigasModel $model;
    private LigasView $view;

    public function __construct($res = null) {
        $this->model = new LigasModel();
        $this->view = new LigasView();
    }

    public function insert($nombre_liga, $ciudad_sede, $temporada) {
        return $this->model->insert($nombre_liga, $ciudad_sede, 0, $temporada);
    }

    public function showAll($ligaToEdit = null): void {
        $ligas = $this->model->getAll();
        $this->view->renderligas($ligas, $ligaToEdit);
    }

    public function add(): void {
        $nombre_liga = trim($_POST['nombre_liga'] ?? '');
        $ciudad_sede = trim($_POST['ciudad_sede'] ?? '');
        $temporada = (int)($_POST['temporada'] ?? date('Y'));

        if ($nombre_liga !== '') {
            $this->model->insert($nombre_liga, $ciudad_sede, 0, $temporada);
        }

        header('Location: ' . route_url('ligas'));
        die();
    }

    public function edit($id_liga): void {
        if (!$id_liga) {
            header('Location: ' . route_url('ligas'));
            die();
        }

        $this->showAll($this->model->getById($id_liga));
    }

    public function update(): void {
        $id_liga = $_POST['id_liga'] ?? null;
        $nombre_liga = trim($_POST['nombre_liga'] ?? '');
        $ciudad_sede = trim($_POST['ciudad_sede'] ?? '');
        $temporada = (int)($_POST['temporada'] ?? date('Y'));

        if ($id_liga && $nombre_liga !== '') {
            $this->model->update($id_liga, $nombre_liga, $ciudad_sede, $temporada);
        }

        header('Location: ' . route_url('ligas'));
        die();
    }

    public function delete($id_liga): void {
        if ($id_liga) {
            $this->model->delete($id_liga);
        }

        header('Location: ' . route_url('ligas'));
        die();
    }
}

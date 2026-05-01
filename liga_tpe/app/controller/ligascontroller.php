<?php
require_once __DIR__ . '/../models/ligas.model.php';
require_once __DIR__ . '/../views/templates/ligas/ligas.view.php';
require_once __DIR__ . '/../views/error.view.php';
        
class LigasController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new LigasModel();
        $this->view = new LigasView();
        $this->errorView = new ErrorView();
    }

    public function showAll() {
        $ligas = $this->model->getAll();
        $this->view->renderLigas($ligas);
    }

    public function show($id_liga, $nombre_liga) {
        $liga = $this->model->getLigaById($id_liga);
        if (!$liga) {
            return $this->errorView->renderError("No se encontró la liga con ID $nombre_liga.");
        }

        $this->view->renderLigas([$liga]);
    }

    public function add() {
     if (isset($_POST['nombre']) && !empty($_POST['nombre']) &&
            isset($_POST['ciudad_sede']) && !empty($_POST['ciudad_sede']) &&
            isset($_POST['cant_equipos']) && !empty($_POST['cant_equipos']) &&
            isset($_POST['temporada']) && !empty($_POST['temporada']) ) {
        }

        header("Location: " . BASE_URL);
    }

    public function edit($id_liga, $nombre_liga, $ciudad_sede, $cant_equipos, $temporada) {
        $ligas = $this->model->getAll();
        $ligaToEdit = $this->model->getLigaById($id_liga);

        if (!$ligaToEdit) {
            return $this->errorView->renderError("No se encontró la liga con ID $id_liga.");
        }

        $this->view->renderLigas($ligas, $ligaToEdit);
    }
    public function update() {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) &&
            isset($_POST['ciudad_sede']) && !empty($_POST['ciudad_sede']) &&
            isset($_POST['cant_equipos']) && !empty($_POST['cant_equipos']) &&
            isset($_POST['temporada']) && !empty($_POST['temporada']) ) {
        }

        header("Location: " . BASE_URL);
    }

    public function delete($id_liga) {
        $this->model->delete($id_liga);
        header("Location: " . BASE_URL);
    }
}

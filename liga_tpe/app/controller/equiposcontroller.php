<?php
require_once __DIR__ . '/../models/equipos.model.php';
require_once __DIR__ . '/../models/ligas.model.php';
require_once __DIR__ . '/../views/templates/equipos/equipos.view.php';
require_once __DIR__ . '/../views/error.view.php';

class EquiposController {
    private $model;
    private $ligaModel;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new EquiposModel();
        $this->ligaModel = new LigasModel();
        $this->view = new EquiposView();
        $this->errorView = new ErrorView();
    }

    public function showAll() {
        $equipos = $this->model->getAll();
        $ligas = $this->ligaModel->getAll();
        $this->view->renderEquipos($equipos, null, null, $ligas);
    }

    public function show($id_liga) {
        $liga = $this->ligaModel->getLigaById($id_liga);
        $ligaNombre = $liga ? $liga->nombre_liga : 'Liga desconocida';

        $equipos = $this->model->getEquiposByLiga($id_liga);
        $ligas = $this->ligaModel->getAll();
        $this->view->renderEquipos($equipos, $ligaNombre, $id_liga, $ligas);
    }

    public function add() {
        if (isset($_POST['nombre_equipo']) && !empty(trim($_POST['nombre_equipo'])) &&
            isset($_POST['id_liga']) && !empty($_POST['id_liga']) &&
            isset($_POST['dt']) && !empty(trim($_POST['dt'])) &&
            isset($_POST['presidente']) && !empty(trim($_POST['presidente'])) &&
            isset($_POST['nombre_estadio']) && !empty(trim($_POST['nombre_estadio']))) {

            $this->model->insert(
                trim($_POST['nombre_equipo']),
                $_POST['id_liga'],
                trim($_POST['dt']),
                trim($_POST['presidente']),
                trim($_POST['nombre_estadio'])
            );
        }

        $redirectLiga = $_POST['id_liga'] ?? '';
        if (!empty($redirectLiga)) {
            header("Location: " . BASE_URL . '?action=equipos/' . $redirectLiga);
        } else {
            header("Location: " . BASE_URL . '?action=equipos');
        }
    }

    public function edit($id_equipo) {
        $equipoToEdit = $this->model->getEquipoById($id_equipo);
        if (!$equipoToEdit) {
            return $this->errorView->renderError("No se encontró el equipo con ID $id_equipo.");
        }

        $liga = $this->ligaModel->getLigaById($equipoToEdit->id_liga);
        $ligaNombre = $liga ? $liga->nombre_liga : 'Liga desconocida';
        $equipos = $this->model->getEquiposByLiga($equipoToEdit->id_liga);
        $ligas = $this->ligaModel->getAll();

        $this->view->renderEquipos($equipos, $ligaNombre, $equipoToEdit->id_liga, $ligas, $equipoToEdit);
    }

    public function update() {
        if (isset($_POST['id_equipo']) && !empty($_POST['id_equipo']) &&
            isset($_POST['nombre_equipo']) && !empty(trim($_POST['nombre_equipo'])) &&
            isset($_POST['id_liga']) && !empty($_POST['id_liga']) &&
            isset($_POST['dt']) && !empty(trim($_POST['dt'])) &&
            isset($_POST['presidente']) && !empty(trim($_POST['presidente'])) &&
            isset($_POST['nombre_estadio']) && !empty(trim($_POST['nombre_estadio']))) {

            $this->model->update(
                $_POST['id_equipo'],
                trim($_POST['nombre_equipo']),
                $_POST['id_liga'],
                trim($_POST['dt']),
                trim($_POST['presidente']),
                trim($_POST['nombre_estadio'])
            );
        }

        $redirectLiga = $_POST['id_liga'] ?? '';
        if (!empty($redirectLiga)) {
            header("Location: " . BASE_URL . '?action=equipos/' . $redirectLiga);
        } else {
            header("Location: " . BASE_URL . '?action=equipos');
        }
    }

    public function delete($id_equipo) {
        $id_liga = $_GET['id_liga'] ?? null;
        $this->model->delete($id_equipo);
        if (!empty($id_liga)) {
            header("Location: " . BASE_URL . '?action=equipos/' . $id_liga);
        } else {
            header("Location: " . BASE_URL . '?action=equipos');
        }
    }
}

?>

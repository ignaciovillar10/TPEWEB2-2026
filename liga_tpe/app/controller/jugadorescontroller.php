<?php
require_once __DIR__ . '/../models/jugadores.model.php';
require_once __DIR__ . '/../models/equipos.model.php';
require_once __DIR__ . '/../views/templates/jugadores/jugadores.view.php';
require_once __DIR__ . '/../views/error.view.php';

class JugadoresController {
    private $model;
    private $equiposModel;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new JugadoresModel();
        $this->equiposModel = new EquiposModel();
        $this->view = new JugadoresView();
        $this->errorView = new ErrorView();
    }

    public function showAll() {
        $jugadores = $this->model->getAll();
        $this->view->renderJugadores($jugadores);
    }

    public function show($id_equipo) {
        $equipo = $this->equiposModel->getEquipoById($id_equipo);
        $equipoNombre = $equipo ? $equipo->nombre_equipo : 'Equipo desconocido';

        $jugadores = $this->model->getJugadoresByEquipo($id_equipo);
        $this->view->renderJugadores($jugadores, $equipoNombre, $id_equipo);
    }

    public function add() {
        if (isset($_POST['id_equipo']) && !empty($_POST['id_equipo']) &&
            isset($_POST['nombre_jugador']) && !empty(trim($_POST['nombre_jugador'])) &&
            isset($_POST['apellido']) && !empty(trim($_POST['apellido'])) &&
            isset($_POST['Edad']) && !empty($_POST['Edad']) &&
            isset($_POST['Dorsal']) && !empty($_POST['Dorsal']) &&
            isset($_POST['posicion']) && !empty(trim($_POST['posicion'])) &&
            isset($_POST['estado']) && !empty(trim($_POST['estado']))) {

            $this->model->insert(
                $_POST['id_equipo'],
                trim($_POST['nombre_jugador']),
                trim($_POST['apellido']),
                $_POST['Edad'],
                $_POST['Dorsal'],
                trim($_POST['posicion']),
                trim($_POST['estado'])
            );
        }

        $redirectEquipo = $_POST['id_equipo'] ?? '';
        header("Location: " . BASE_URL . '?action=jugadores/' . $redirectEquipo);
    }

    public function edit($id_jugador) {
        $jugadorToEdit = $this->model->getJugadorById($id_jugador);
        if (!$jugadorToEdit) {
            return $this->errorView->renderError("No se encontró el jugador con ID $id_jugador.");
        }

        $equipo = $this->equiposModel->getEquipoById($jugadorToEdit->id_equipo);
        $equipoNombre = $equipo ? $equipo->nombre_equipo : 'Equipo desconocido';
        $jugadores = $this->model->getJugadoresByEquipo($jugadorToEdit->id_equipo);

        $this->view->renderJugadores($jugadores, $equipoNombre, $jugadorToEdit->id_equipo, $jugadorToEdit);
    }

    public function update() {
        if (isset($_POST['id_jugador']) && !empty($_POST['id_jugador']) &&
            isset($_POST['id_equipo']) && !empty($_POST['id_equipo']) &&
            isset($_POST['nombre_jugador']) && !empty(trim($_POST['nombre_jugador'])) &&
            isset($_POST['apellido']) && !empty(trim($_POST['apellido'])) &&
            isset($_POST['Edad']) && !empty($_POST['Edad']) &&
            isset($_POST['Dorsal']) && !empty($_POST['Dorsal']) &&
            isset($_POST['posicion']) && !empty(trim($_POST['posicion'])) &&
            isset($_POST['estado']) && !empty(trim($_POST['estado']))) {

            $this->model->update(
                $_POST['id_jugador'],
                $_POST['id_equipo'],
                trim($_POST['nombre_jugador']),
                trim($_POST['apellido']),
                $_POST['Edad'],
                $_POST['Dorsal'],
                trim($_POST['posicion']),
                trim($_POST['estado'])
            );
        }

        $redirectEquipo = $_POST['id_equipo'] ?? '';
        header("Location: " . BASE_URL . '?action=jugadores/' . $redirectEquipo);
    }

    public function delete($id_jugador) {
        $id_equipo = $_GET['id_equipo'] ?? null;
        $this->model->delete($id_jugador);
        if (!empty($id_equipo)) {
            header("Location: " . BASE_URL . '?action=jugadores/' . $id_equipo);
        } else {
            header("Location: " . BASE_URL . '?action=jugadores');
        }
    }
}

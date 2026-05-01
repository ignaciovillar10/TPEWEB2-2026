<?php
require_once __DIR__ . '/app/controller/equiposcontroller.php';
require_once __DIR__ . '/app/controller/ligascontroller.php';
require_once __DIR__ . '/app/controller/jugadorescontroller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'ligas'; // Acción por defecto
$econtroller = new EquiposController();// Instancia del controlador de equipos
$lcontroller = new LigasController();// Instancia del controlador de ligas
$jcontroller = new JugadoresController();// Instancia del controlador de jugadores

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'equipos':
        if (!empty($params[1])) {
            $econtroller->show($params[1]);
        } else {
            $econtroller->showAll();
        }
        break;

    case 'agregarequipo':
        $econtroller->add();
        break;

    case 'eliminarequipo':
        if (!empty($params[1])) {
            $econtroller->delete($params[1]);
        }
        break;

    case 'editarequipo':
        if (!empty($params[1])) {
            $econtroller->edit($params[1]);
        }
        break;

    case 'actualizarequipo':
        $econtroller->update();
        break;

    case 'ligas':
        $lcontroller->showAll();
        break;

    case 'agregarliga':
        $lcontroller->add();
        break;

    case 'eliminarliga':
        if (!empty($params[1])) {
            $lcontroller->delete($params[1]);
        }
        break;

    case 'editarliga':
        if (!empty($params[1])) {
            $lcontroller->edit($params[1]);
        }
        break;

    case 'actualizarliga':
        $lcontroller->update();
        break;

    case 'jugadores':
        if (!empty($params[1])) {
            $jcontroller->show($params[1]);
        } else {
            $jcontroller->showAll();
        }
        break;

    case 'agregarjugador':
        $jcontroller->add();
        break;

    case 'eliminarjugador':
        if (!empty($params[1])) {
            $jcontroller->delete($params[1]);
        }
        break;

    case 'editarjugador':
        if (!empty($params[1])) {
            $jcontroller->edit($params[1]);
        }
        break;

    case 'actualizarjugador':
        $jcontroller->update();
        break;

    default:
        $lcontroller->showAll();
        break;
}

<?php
//nacho---> nacho123
require_once __DIR__ . '/app/middleware/auth.middleware.php';
require_once __DIR__ . '/app/controller/equipos.controller.php';
require_once __DIR__ . '/app/controller/ligas.controller.php';
require_once __DIR__ . '/app/controller/login.controller.php';

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
define('BASE_URL', $basePath . '/');

$action = $_GET['action'] ?? 'ligas';
$params = explode('/', trim($action, '/'));

$res = new stdClass();
sessionAuthMiddleware($res);

$privateRoutes = [
    'agregarliga',
    'editarliga',
    'actualizarliga',
    'eliminarliga',

    'agregarequipo',
    'editarequipo',
    'actualizarequipo',
    'eliminarequipo',
];

if (in_array($params[0], $privateRoutes)) {
    verifyAuthMiddleware($res);
}

$equiposController = new EquiposController($res);
$ligasController = new LigasController($res);
$loginController = new LoginController($res);

switch ($params[0]) {
    case 'ligas':
        $ligasController->showAll();
        break;

    case 'agregarliga':
        $ligasController->add();
        break;

    case 'editarliga':
        $ligasController->edit($params[1] ?? null);
        break;

    case 'actualizarliga':
        $ligasController->update();
        break;

    case 'eliminarliga':
        $ligasController->delete($params[1] ?? null);
        break;

    case 'equipos':
        empty($params[1])
            ? $equiposController->showAll()
            : $equiposController->showByLiga($params[1]);
        break;

    case 'agregarequipo':
        $equiposController->add();
        break;

    case 'editarequipo':
        $equiposController->edit($params[1] ?? null);
        break;

    case 'actualizarequipo':
        $equiposController->update();
        break;

    case 'eliminarequipo':
        $equiposController->delete($params[1] ?? null);
        break;
    case 'login':
        $loginController->showLogin();
        break;

    case 'verify':
        $loginController->verifyUser();
        break;

    case 'logout':
        $loginController->logout();
        break;

    default:
        $ligasController->showAll();
        break;
        case 'register':
    $loginController->showRegister();
    break;

case 'saveUser':
    $loginController->saveUser();
    break;
}
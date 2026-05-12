<?php

function sessionAuthMiddleware($res)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['ID_USER'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->username = $_SESSION['USERNAME'];
        $res->user->rol = $_SESSION['ROL'];
    }
}

function verifyAuthMiddleware($res)
{
    if (!isset($res->user)) {
        header('Location: ' . BASE_URL . 'login');
        die();
    }
}
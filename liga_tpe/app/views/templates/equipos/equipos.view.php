<?php

class EquiposView {
    public function renderEquipos($equipos, $ligaNombre = null, $idLiga = null, $ligas = [], $equipoToEdit = null) {
        $count = count($equipos);
        $ligaNombre = $ligaNombre ?? 'todas las ligas';

        require_once __DIR__ . '/equipos.view.php';
    }
}
?>

<?php
class EquiposView {
    public function renderequipos($equipos,$ligas, $idLiga = null,$ligaNombre = 'todas las ligas', $equipoToEdit = null): void {
        $count = count($equipos);
        require __DIR__ . '/templates/equipos.phtml';
    }
}

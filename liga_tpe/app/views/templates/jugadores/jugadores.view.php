<?php

class JugadoresView {
    public function renderJugadores($jugadores, $EquipoNombre = null, $idEquipo = null, $jugadorToEdit = null) {
        $count = count($jugadores);
        $EquipoNombre = $EquipoNombre ?? 'todos los equipos';

        require_once __DIR__ . '/templates/jugadores.phtml';
    }
}
?>

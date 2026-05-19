<?php
class EquiposView {
    public function renderequipos($equipos, $nombre_liga = null, $equipoToEdit = null, $id_liga = null, $ligas = []): void {
   
        require __DIR__ . '/templates/equipos.phtml';
    }
}

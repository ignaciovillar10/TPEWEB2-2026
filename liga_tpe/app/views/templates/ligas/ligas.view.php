<?php

class LigasView {
    public function renderLigas($ligas, $ligaToEdit = null) {
        $count = count($ligas);

        require_once __DIR__ . '/ligas.phtml';
    }
}
?>

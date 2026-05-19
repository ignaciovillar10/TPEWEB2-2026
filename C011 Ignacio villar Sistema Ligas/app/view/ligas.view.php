<?php
class LigasView {
    public function renderligas($ligas, $ligaToEdit = null): void {
        $count = count($ligas);
        require __DIR__ . '/templates/ligas.phtml';
    }
}

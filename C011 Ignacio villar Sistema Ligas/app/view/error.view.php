<?php
class ErrorView {
    public function renderError($err = null): void {
        require __DIR__ . '/templates/error.phtml';
    }
}

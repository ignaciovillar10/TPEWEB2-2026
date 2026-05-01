<?php

class ErrorView {
    public function renderError($err = null) {
        require_once __DIR__ . '/templates/error.phtml';
    }

}
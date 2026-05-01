<?php
$db = new PDO('mysql:host=localhost;dbname=sistemaliga_tpe;charset=utf8', 'root', '');
foreach (['equipos', 'ligas'] as $t) {
    $q = $db->query('DESCRIBE ' . $t);
    echo 'TABLE ' . $t . ':\n';
    print_r($q->fetchAll(PDO::FETCH_COLUMN));
}

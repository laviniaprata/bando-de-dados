<?php
// index.php — Porta de entrada única (Front Controller)
// Todo acesso ao site começa aqui.

require_once 'router.php';

$router = new Router();
$router->despachar();

<?php

session_start();

require_once('../vendor/autoload.php');

//carregamento das classes
require_once('../config/config.php');

$nucleo = new Rotas();
$nucleo->executar();
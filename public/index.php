<?php

session_start();

//carregamento das classes
require_once('../config/config.php');

$nucleo = new Rotas();
$nucleo->executar();
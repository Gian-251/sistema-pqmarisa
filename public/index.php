<?php

//carregamento das classes
require_once('../config/config.php');

$nucleo = new Rotas();
$nucleo->executar();
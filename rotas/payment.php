<?php
require_once '../app/controllers/PaymentController.php';
$paymentController = new PaymentController();
$paymentController->processarPagamento();
?>
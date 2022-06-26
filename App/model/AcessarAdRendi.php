<?php
session_start();
include_once '../controller/Carrinho.php';
include_once '../controller/vendas.php';
include_once 'Connection.php';
$cart = new Carrinho;
$sales = new Vendas;
$conn = new Connection;


if(isset($_GET['report_log'])){

  require_once "../controller/Relatorio_log.php";
  $report_est = new Relatorio_log;

}





 ?>

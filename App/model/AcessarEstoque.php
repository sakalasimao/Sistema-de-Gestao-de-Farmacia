<?php
session_start();
include_once '../controller/Carrinho.php';
include_once '../controller/vendas.php';
include_once 'Connection.php';
$cart = new Carrinho;
$sales = new Vendas;
$conn = new Connection;


if(isset($_GET['report_stock_01'])){

  require_once "../controller/Relatorio_estoque.php";
  $report_est = new Relatorio_estoque();

}

if(isset($_GET['report_stock_02'])){

  require_once "../controller/Relatorio_estoque_1m.php";
  $report_est_1m = new Relatorio_estoque_1m;

}

if(isset($_GET['report_stock_03'])){

  require_once "../controller/Relatorio_estoque_ja.php";
  $report_est_ja = new Relatorio_estoque_ja;

}



 ?>

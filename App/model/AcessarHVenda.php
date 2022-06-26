<?php

session_start();
include_once '../controller/Carrinho.php';
include_once '../controller/vendas.php';
include_once 'Connection.php';
$cart = new Carrinho;
$sales = new Vendas;
$conn = new Connection;


if(isset($_GET['report_hv'])){

  require_once "../controller/Relatorio_Hvendas.php";
  $report_hv = new Relatorio_Hvendas;

}

if(isset($_GET['report_hv_pesq'])){

  require_once "../controller/Relatorio_Hvendas_pesq.php";
  $report_hv = new Relatorio_Hvendas_pesq;

}

if(isset($_GET['report_hv_pesqData']) and !empty($_SESSION['data1_hvenda']) and !empty($_SESSION['data2_hvenda'])){

  require_once "../controller/Relatorio_Hvendas_pesqData.php";
  $report_hv = new Relatorio_Hvendas_pesqData;

}else{
  header('Location: ../view/GerVendas.php');
}


 ?>

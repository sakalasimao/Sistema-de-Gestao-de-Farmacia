<?php
session_start();
include_once '../controller/fabricante.php';
$fab = new Fabricante();


 var_dump($_POST) ;

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $fab->excluirFabricante($id_produto);
   header('Location: ../view/GerFabRead.php');

}

if (isset($_POST['nome_fab'])) {

  $nome = addslashes($_POST['nome_fab']);
  $pais = addslashes($_POST['pais_fab']);


  if (!empty($nome) && !empty($pais)) {

    // CADASTRAR
  if (!$fab->cadastrarFabricante($nome, $pais)) {
    // já cadastrado

  }else {
    $_SESSION['sucesso_cadastro'] = "";
    header("Location: ../view/GerFabRead.php");
  }
}else {
  echo 'Preencha todos os campos';
}

}

if(isset($_GET['report_fab'])){
  require_once '../controller/Relatorio_fab.php';
  $report_prod = new Relatorio_fab;
}

if(isset($_GET['report_fab_pesq'])){
  require_once '../controller/Relatorio_fab_pesq.php';
  $report_prod = new Relatorio_fab_pesq;
}



















 ?>

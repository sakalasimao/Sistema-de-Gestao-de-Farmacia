<?php
session_start();
include_once '../controller/categoria.php';
$catg = new Categoria;


if (isset($_GET['id'])) {

  $id = addslashes($_GET['id']);
  $catg->excluirCategoria($id);
   header('Location: ../view/GerCatgRead.php');
}

if (isset($_POST['nome_catg'])) {

  $nome = addslashes($_POST['nome_catg']);;

  if (!empty($nome)) {

    // CADASTRAR
  if (!$catg->cadastrarCatg($nome)) {
   // echo 'ja';

  }else {
    echo 'sucesso!';
    $_SESSION['sucesso_cadastro'] = "";
    header("Location: ../view/GerCatgRead.php");
  }
}else {
  echo 'preecha os campos';
}

}

if(isset($_GET['report_catg'])){
  require_once '../controller/Relatorio_catg.php';
  $report_catg = new Relatorio_catg;

}

if(isset($_GET['report_catg_pesq'])){
  require_once '../controller/Relatorio_catg_pesq.php';
  $report_catg_pesq = new Relatorio_catg_pesq;

}




















 ?>

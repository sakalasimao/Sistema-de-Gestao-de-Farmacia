<?php
session_start();
include_once '../controller/funcionario.php';
$func = new Funcionario;


// echo $_POST;

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $func->excluirFuncionario($id_produto);
   header('Location: ../view/GerFuncRead.php');

}

if (isset($_POST['btn_cadastrar'])) {
  $nome = addslashes($_POST['nome_func']);
  $telefone = addslashes($_POST['tel_func']);
  $email = addslashes($_POST['email_func']);
  $endereco = addslashes($_POST['end_func']);
  $cargo = addslashes($_POST['cargo_func']);

  if (!empty($nome) && !empty($telefone) && !empty($email)  && !empty($endereco) && !empty($cargo)) {

    // CADASTRAR
  if (!$func->cadastrarFuncionario($nome,$telefone, $email, $endereco, $cargo)) {
    // já cadastrado

  }else {
    $_SESSION['sucesso_cadastro'] = "";
    header("Location: ../view/GerFuncRead.php");
  }
}else {
  // Preencha todos os campos
}

}

if(isset($_GET['report_func'])){
  require_once '../controller/Relatorio_func.php';
  $report_func = new Relatorio_func;
}


if(isset($_GET['reportFunc_pesq'])){
  require_once '../controller/Relatorio_func_pesq.php';
  $report_func_pesq = new Relatorio_func_pesq;
}else{
  header('Location: ../view/GerFuncRead.php');
}


















 ?>

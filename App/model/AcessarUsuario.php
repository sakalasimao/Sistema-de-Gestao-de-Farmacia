<?php
session_start();
include_once '../controller/usuario.php';
include_once 'Connection.php';

$user = new usuario;
$conn = new Connection;
// echo $_POST;

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $user->excluirUsuario($id_produto);
   header('Location: ../view/AdminUser.php');

}

if (isset($_POST['btn_cadastrar_user'])) {

  var_dump($_POST);

  $nome = addslashes($_POST['nome_user']);
  $senha = addslashes($_POST['senha_user']);
  $email = addslashes($_POST['email_user']);
  $acesso = addslashes($_POST['acesso_user']);

  if (!empty($nome) && !empty($senha) && !empty($email)  && !empty($acesso)) {

    // CADASTRAR
  if (!$user->cadastrarUsuario($nome,$senha,$email,$acesso)) {
    // já cadastrado
    $_SESSION['mesmo_registro'] = "";
    header("Location: ../view/AdminUserInsert0.php");

  }else {
    $_SESSION['sucesso_cadastro'] = "";
   header("Location: ../view/AdminUser.php");
  }
}else {
 echo 'CAMPOS';
}

}


if (isset($_GET['report_user'])) {

  require_once '../controller/Relatorio_user.php';
  $rUser = new Relatorio_user;

}

if (isset($_GET['report_user_pesq']) && !empty($_SESSION['pesq_report_pesq']) ) {
  
  require_once '../controller/Relatorio_user_pesq.php';
  $PUser = new Relatorio_user_pesq;

}else{
  $_SESSION['vazio_pesq'] = "";
  header("Location: ../view/AdminUser.php");

}


 ?>

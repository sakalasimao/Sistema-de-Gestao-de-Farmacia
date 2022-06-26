<?php

require_once 'Connection.php';
$conn = new Connection;


if (isset($_POST['pesquisa-btn'])) {

  $pesq_input = addslashes($_POST['pesquisa-input']);
  $quant = addslashes($_POST['quant']);

if (!empty($pesq_input)) {



  $cmd = $conn->pdo->prepare("SELECT codrefproduto,nome_prod,quantidade,preco,data_fab,data_exp,nome_catg from produtos inner join categorias on produtos.produto_categoria = categorias.id_catg where codrefproduto = :id");
  $cmd->bindValue(":id",$pesq_input);
  $cmd->execute();

  if ($cmd->rowCount() > 0) {
    $res = $cmd->fetch();
    session_start();
    $_SESSION['codigo'] = $res['codrefproduto'];
    $_SESSION['nome_prod'] = $res['nome_prod'];
    $_SESSION['quantidade'] = $res['quantidade'];
    $_SESSION['preco'] = $res['preco'];
    $_SESSION['nome_catg'] = $res['nome_catg'];
    unset($_SESSION['vazio']);
    header('Location:../view/FarmVenda.php');
  }else {
    session_start();
    $_SESSION['msg_notFound'] = "";
    unset($_SESSION['nome_prod']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['preco']);
    unset($_SESSION['nome_catg']);
      header('Location: ../view/FarmVenda.php');
  }


}else {
  session_start();
  $_SESSION['msg_notCode'] = "";
  unset($_SESSION['nome_prod']);
  unset($_SESSION['quantidade']);
  unset($_SESSION['preco']);
  unset($_SESSION['nome_catg']);
  header('Location: ../view/FarmVenda.php');
}


}










 ?>

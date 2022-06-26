<?php

session_start();
require_once 'Connection.php';
include_once '../controller/Carrinho.php';
$conn = new Connection;
$cart = new Carrinho;


  $pesq_input = $_POST['pesquisa-input'];




  $cmd = $conn->pdo->prepare("SELECT codigo, descricao, nome_catg, valor, entrada, saida, quant ,data,data_fab,data_exp from estoque inner join categorias on estoque.categoria = categorias.id_catg where codigo = :id");
  $cmd->bindValue(":id",$pesq_input);
  $cmd->execute();

  if ($cmd->rowCount() > 0) {
    $res = $cmd->fetch();

    // $res['quantidade'];
    // header('Location:../view/FarmVenda.php');
    $quant = addslashes($_POST['quant']);

if (!$res['quant'] == 0) {

if ($quant > $res['quant']) {
  session_start();
  $_SESSION['msg_bigStock'] = "";
  header('Location: ../view/FarmVenda.php');
}else {
  $codigo = $res['codigo'];
  $nome_prod =   $res['descricao'];
  $categ = $res['nome_catg'];
  $preco =  $res['valor'];


  $subtotal  = (int)$preco* (int)$quant;

  if ($quant > 0) {

    if (!$cart->adicionarCarrinho($codigo, $nome_prod, $preco, $quant, $subtotal))
    {

      $cart->UpdateCarrinho($codigo,$quant,$subtotal);
      header('Location: ../view/FarmVenda.php');
    }else{
      echo "	<script>
       window.location.href='../view/FarmVenda.php';
     </script>";
    }

  }else {
     $_SESSION['msg_notQuant'] = ""; // INFORME A QUANTIDADE DO PRODUTO
       header('Location: ../view/FarmVenda.php');
   }
}


}else {
  session_start();
  $_SESSION['msg_endStock'] = "";
  header('Location: ../view/FarmVenda.php');
}




//------------------------------


  }else {
    session_start();
    $_SESSION['msg_notFound'] = ""; // PRODUTO NÃO ENCONTRADO
    unset($_SESSION['nome_prod']);
    unset($_SESSION['quantidade']);
    unset($_SESSION['preco']);
    unset($_SESSION['nome_catg']);
      header('Location: ../view/FarmVenda.php');
  }


}else {
  session_start();
  $_SESSION['msg_notCode'] = ""; // INFORME O CÓDIGO DO PRODUTO
  unset($_SESSION['nome_prod']);
  unset($_SESSION['quantidade']);
  unset($_SESSION['preco']);
  unset($_SESSION['nome_catg']);
  header('Location: ../view/FarmVenda.php');
}













 ?>

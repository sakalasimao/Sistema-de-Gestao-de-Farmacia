<?php

session_start();
include_once '../controller/Carrinho.php';

include_once '../controller/vendas.php';
include_once 'Connection.php';
$cart = new Carrinho;
$sales = new Vendas;
$conn = new Connection;


if (isset($_POST['final'])) {

  var_dump($_POST);


  $data = $cart->buscarDados();
 
//session_start();

  if (!empty($_POST['total']) &&  !empty($_POST['tipoPag']) && !empty($_POST['valor_cli'])) {
    $dataV = date("Y-m-d");
    $conn->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $desc = 0;

    if(empty($_POST['cliente'])){
      $_POST['cliente'] = "Consumidor Final";
    }

    if(empty($_POST['desconto'])){
      $_POST['desconto'] = 0;
    }

    if($_POST['valor_cli'] < $_POST['total']){
      $_SESSION['valor_menor'] = "";
      header('Location: ../view/FarmVenda.php');
      exit();

    }

    if($sales->cadastrarVenda( $_POST['total'], $_POST['desconto'], $_POST['cliente'],
     $_POST['valor_cli'], $_POST['troco'], $dataV, $_SESSION['id_usuario_farm'], $_POST['tipoPag'])){
      echo "sucesso venda (CADASTRO)";
      $cart->finalizarVenda($data);
    }else{
      echo "Erro Venda (CADASTRO)";
    }
    


    // FATURA
    require_once '../controller/FaturaVenda.php';
   $fatura = new FaturaVenda;

    /*INSERT no Log de Venda com Sucesso!*/
    $desc = "Efetuou uma Venda";
    $tipo = "Informação"; 
    /**  
     *  Informação 
     * Aviso
     * Erro
    */
    $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
    $cmd->bindValue(":t",$tipo);
    $cmd->bindValue(":ds",$desc);
    $cmd->bindValue(":dn",$dataV);
    $cmd->bindValue(":fk", $_SESSION['id_usuario_farm']);
    $cmd->execute();

  
    $_SESSION['delete_cart'] = "";

  $_SESSION['msg_succSales'] = "";
  header('Location: ../view/FarmVenda.php');

  }else {
   
    $_SESSION['msg_emptySale'] = "";
    header('Location: ../view/FarmVenda.php');
  }

}



 ?>

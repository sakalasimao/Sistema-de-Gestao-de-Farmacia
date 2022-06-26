<?php
session_start();
include_once '../model/Connection.php';
include_once '../controller/produtos.php';
$conn = new Connection;
$prod = new Produtos;

// echo $_POST;

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $prod->excluirProduto($id_produto);
   header('Location: ../view/GerProdRead.php');

}

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $func->excluirFuncionario($id_produto);
   header('Location: ../view/GerProdRead.php');

}

if (isset($_POST['btn_prod'])) {

 // var_dump($_POST);
  
  $barcode = addslashes($_POST['code_prod']);
  $nome = addslashes($_POST['nome_prod']);
  $preco = addslashes($_POST['preco_prod']);
  $qtd = addslashes($_POST['qtd_prod']);
  $qtdc = addslashes($_POST['qtdc_prod']);
  $catg = addslashes($_POST['catg_prod']);
  $fab = addslashes($_POST['fab_prod']);
  $de = addslashes($_POST['dataexp']);
  $data = date("y-m-d");

  if (!empty($nome) && !empty($qtd) && !empty($preco)  && !empty($qtdc) && !empty($catg) ) {

   
  if (!$prod->cadastrarProduto($barcode,$nome, $catg, $preco, $qtd, $qtdc, $data,$de,$fab)) {
    echo "JAA";

  }else {

    $prod = $conn->pdo->prepare("SELECT * FROM produtos order by id_produto desc");
    $prod->execute();
    $prod_fetch = $prod->fetch();

   $estoque = $conn->pdo->prepare("INSERT INTO estoque (estrada, fk_produto_estoque) VALUES (:e, :id_prod)");
   $estoque->bindValue(":e", $qtd);
   $estoque->bindValue(":id_prod", $prod_fetch['id_produto']);
   $estoque->execute();


    $_SESSION['sucesso_cadastro'] = "";
    echo 'sucesso';
    header("Location: ../view/GerProdRead.php");
  }
}else {
  $_SESSION['empry_prod'] = "";
  header("Location: ../view/GerProdInsert.php");
  //echo "Preencha todos os campos";
}

}

if(isset($_GET['report_prod'])){
  require_once '../controller/Relatorio_prod.php';
  $report_prod = new Relatorio_prod;
}

if(isset($_GET['report_itens'])){
  require_once '../controller/Relatorio_itens.php';
  $report_itens = new Relatorio_itens;
}

if(isset($_GET['report_itens_02'])){
  require_once '../controller/Relatorio_itens_02.php';
  $report_itens = new Relatorio_itens_02;
}



if(isset($_GET['report_prod_pesq'])){
  require_once '../controller/Relatorio_prod_pesq.php';
  $report_prod_pesq = new Relatorio_prod_pesq;
}

















 ?>

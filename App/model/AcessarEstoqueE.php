<?php
session_start();
include_once '../controller/estoqueE.php';
include_once '../model/Connection.php';
$conn = new Connection;
$estoq_e = new EstoqueE;


// cadastrarProduto($codigo, $descricao, $pro_categoria, $valor, $entrada, $data, $data_fab, $data_exp)

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $estoq_e->excluirProduto($id_produto);
   header('Location: ../view/GerEstoqueEntra.php');

}

if (isset($_POST['btn_cadastrar_prod'])) {

  $id = addslashes($_POST['id_p']);
  $nome = addslashes($_POST['nome_p']);
  $quantd = addslashes($_POST['quant_p']);
  $preco = addslashes($_POST['prec_p']);
  $cat = addslashes($_POST['pc_p']);
  $qtd_c = addslashes($_POST['qtd_c']);
  $de = addslashes($_POST['de_p']);
  $data = date('Y-m-d');



if (!empty($id) &&!empty($nome) && !empty($quantd) && !empty($preco)  && !empty($cat) && !empty($qtd_c) && !empty($de)) {

  if (!$estoq_e->cadastrarProduto($id, $nome, $cat, $preco, $quantd,$qtd_c, $data, $de)) {
    //  echo "Cadastrado";

  }else {
    $_SESSION['sucesso_cadastro'] = "";
  header("Location: ../view/GerEstoque.php");
  }

}else {
  echo "Preencha todos os campos";
}

}

if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $estoq_e->excluirProduto($id_produto);
   header('Location: ../view/GerEstoque.php');

}



if(isset($_GET['report_estoq'])){

  require_once "../controller/Relatorio_estoque.php";
  $report_estoq = new Relatorio_estoque;


}


 ?>

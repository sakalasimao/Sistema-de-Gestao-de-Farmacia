<?php
require_once '../model/Connection.php';
/**
 *  Classe para fazer o CRUD 
 */
class Produtos extends Connection
{


  public function buscarDadosProduto($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function atualizarDados($id, $barcode, $nome, $catg, $preco, $qtd, $qtdc, $data,$data_exp, $fab){

        $cmd = $this->pdo->prepare("UPDATE produtos SET barcode = :code, 
        nomeProduto = :n, fk_categoria_produto = :catg, precoProduto = :p, qtdProduto = :qtd, qtdCompraProduto = :qtdc,
         dataExpProduto = :df, fk_fabricante_produto = :fab, criandoProduto = :cd WHERE id_produto = :id");
        $cmd->bindValue(":code",$barcode);
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":catg",$catg);
        $cmd->bindValue(":p",$preco);
        $cmd->bindValue(":qtd",$qtd);
        $cmd->bindValue(":qtdc",$qtdc);
        $cmd->bindValue(":df",$data_exp);
        $cmd->bindValue(":fab",$fab);
        $cmd->bindValue(":cd",$data);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
  }

  public function excluirProduto($id){

    $cmd = $this->pdo->prepare("DELETE FROM produtos WHERE id_produto = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function cadastrarProduto($barcode,$nome, $catg, $preco, $qtd, $qtdc, $data, $data_exp,$fab){

    $cmd = $this->pdo->prepare("SELECT * from produtos WHERE nomeProduto = :n"); // VRIFICAR CADASTRO
    $cmd->bindValue(":n",$nome);
    $cmd->execute();

  //  $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if ($cmd->rowCount() > 0) // JÁ EXISTE
    {
      echo 'ja existe';
      return false;

    }else //  NÃO FOI ENCONTRADO
    {
      $cmd = $this->pdo->prepare("INSERT INTO produtos (barcode,nomeProduto,fk_categoria_produto,
      precoProduto,qtdProduto,qtdCompraProduto,criandoProduto,dataExpProduto, fk_fabricante_produto) 
      VALUES (:barcode, :nomeProduto, :fk_categoria_produto, :precoProduto, :qtdProduto, :qtdCompra, :criandoProduto, :dataExpProduto, :fk_fabricante_produto)");
      $cmd->bindValue(":barcode",$barcode);
      $cmd->bindValue(":nomeProduto",$nome);
      $cmd->bindValue(":fk_categoria_produto",$catg);
      $cmd->bindValue(":precoProduto",$preco);
      $cmd->bindValue(":qtdProduto",$qtd);
      $cmd->bindValue(":qtdCompra",$qtdc);
      $cmd->bindValue(":criandoProduto",$data);
      $cmd->bindValue(":dataExpProduto",$data_exp);
      $cmd->bindValue(":fk_fabricante_produto",$fab);
      $cmd->execute();

      return true;
    }
  }



}
















 ?>

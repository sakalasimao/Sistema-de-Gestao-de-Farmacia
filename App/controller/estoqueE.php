<?php
require_once '../model/Connection.php';
require_once '../controller/carrinho.php';
$cart = new Carrinho;

/**
 *
 */
class EstoqueE extends Connection
{


  public function cadastrarProduto($codigo, $descricao, $categoria, $valor, $entrada, $qtd_c,$data, $data_exp){

    $cmd = $this->pdo->prepare("SELECT codigo from estoque WHERE codigo = :c"); // VRIFICAR CADASTRO
    $cmd->bindValue(":c",$codigo);
    $cmd->execute();
    if ($cmd->rowCount() > 0) // EMAIL JÁ EXISTE
    {
      return false;
    }else // EMAIL NÃO FOI ENCONTRADO
    {

    //  session_start();

      // if ($saida == "") {
      //   $saida = 0;
      // }

      // $quant = (int)$entrada - (int)$saida;
     $_SESSION['entrada_up'] = $entrada;
     $quant = $entrada;
     $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $cd = $this->pdo->prepare("INSERT INTO estoque (codigo,descricao,categoria,valor,entrada,quant,qtd_compra,data,data_exp) VALUES (:c, :d, :cat, :val, :et,:q,:qc,:dn, :de)");
      $cd->bindValue(":c",$codigo);
      $cd->bindValue(":d",$descricao);
      $cd->bindValue(":cat",$categoria);
      $cd->bindValue(":val",$valor);
      $cd->bindValue(":et",$entrada);
      $cd->bindValue(":q",$quant);
      $cd->bindValue(":qc",$qtd_c);
      $cd->bindValue(":dn",$data);
      $cd->bindValue(":de",$data_exp);
      $cd->execute();
      return true;
    }
  }

  public function atualizarDados($codigo, $descricao, $categoria, $valor, $entrada, $qtd_c,$data, $data_exp){

    $cmd = $this->pdo->prepare("UPDATE estoque SET descricao = :d, categoria = :cat, valor = :v, quant = :et, qtd_compra = :qc, data = :dn ,data_exp = :de WHERE codigo = :id");
    $cmd->bindValue(":d",$descricao);
    $cmd->bindValue(":cat",$categoria);
    $cmd->bindValue(":v",$valor);
    $cmd->bindValue(":et",$entrada);
    $cmd->bindValue(":qc",$qtd_c);
    $cmd->bindValue(":dn",$data);
    $cmd->bindValue(":de",$data_exp);
    $cmd->bindValue(":id",$codigo);
    $cmd->execute();

  
}


  public function excluirProduto($id){

    $cmd = $this->pdo->prepare("DELETE FROM estoque WHERE codigo = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function buscarDadosProduto($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM estoque WHERE codigo = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }
}









 ?>

<?php
require_once '../model/Connection.php';

/**
 *
 */
class Categoria extends Connection
{
  public function cadastrarCatg($nome){

    $cmd = $this->pdo->prepare("SELECT id_categoria from categoria WHERE nomeCategoria = :n"); // VRIFICAR CADASTRO
    $cmd->bindValue(":n",$nome);
    $cmd->execute();
    if ($cmd->rowCount() > 0) // EMAIL JÁ EXISTE
    {
      return false;
    }else // EMAIL NÃO FOI ENCONTRADO
    {
      $cmd = $this->pdo->prepare("INSERT INTO categoria (nomeCategoria) VALUES (:n)");
      $cmd->bindValue(":n",$nome);
      $cmd->execute();

      return true;
    }
  }

  public function atualizarDados($id,$nome){

        $cmd = $this->pdo->prepare("UPDATE categoria SET nomeCategoria = :n WHERE id_categoria = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
  }

  public function buscarDadosCategoria($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM categoria WHERE id_categoria = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function excluirCategoria($id){

    $cmd = $this->pdo->prepare("DELETE FROM categoria WHERE id_categoria = :id");
    $cmd->bindValue(":id", $id);
    $cmd->execute();

    
    
    
  }

}













 ?>

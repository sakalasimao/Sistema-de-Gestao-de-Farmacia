<?php
require_once '../model/Connection.php';
/**
 *  Classe para fazer o CRUD no funcionario
 */
class Fabricante extends Connection
{


  public function buscarDadosFabricante($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM fabricante WHERE id_fabricante = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function atualizarDados($id,$nome,$pais){

        $cmd = $this->pdo->prepare("UPDATE fabricante SET nomeFabricante = :n, pais = :p  WHERE id_fabricante = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":p",$pais);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
  }

  public function excluirFabricante($id){

    $cmd = $this->pdo->prepare("DELETE FROM fabricante WHERE id_fabricante = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function cadastrarFabricante($nome, $pais){

    $cmd = $this->pdo->prepare("SELECT id_fabricante from fabricante WHERE nomeFabricante = :n"); // VRIFICAR CADASTRO
    $cmd->bindValue(":n",$nome);
    $cmd->execute();
    if ($cmd->rowCount() > 0) //  JÁ EXISTE
    {
      return false;
    }else //  NÃO FOI ENCONTRADO
    {
      $cmd = $this->pdo->prepare("INSERT INTO fabricante (nomeFabricante,pais) VALUES (:n, :p)");
      $cmd->bindValue(":n",$nome);
      $cmd->bindValue(":p",$pais);
      $cmd->execute();

      return true;
    }
  }



}
















 ?>

<?php
require_once '../model/Connection.php';
/**
 *  Classe para fazer o CRUD no funcionario
 */
class Funcionario extends Connection
{


  public function buscarDadosFuncionario($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM funcionarios WHERE id_funcionario = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function atualizarDados($id,$nome,$telefone,$email,$endereco, $cargo){

        $cmd = $this->pdo->prepare("UPDATE funcionarios SET nomeFuncionario = :n, telefone = :t, emailFuncionario = :e, endereco = :ed, cargo = :c WHERE id_funcionario = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":t",$telefone);
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":ed",$endereco);
        $cmd->bindValue(":c",$cargo);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
  }

  public function excluirFuncionario($id){

    $cmd = $this->pdo->prepare("DELETE FROM funcionarios WHERE id_funcionario = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function cadastrarFuncionario($nome, $telefone, $email, $endereco, $cargo){

    $cmd = $this->pdo->prepare("SELECT id_funcionario from pessoa WHERE email = :e"); // VRIFICAR CADASTRO
    $cmd->bindValue(":e",$email);
    $cmd->execute();
    if ($cmd->rowCount() > 0) // JÁ EXISTE
    {
      return false;
    }else //  NÃO FOI ENCONTRADO
    {
      $cmd = $this->pdo->prepare("INSERT INTO funcionarios (nomeFuncionario,telefone,emailFuncionario,endereco,cargo) VALUES (:n, :t, :e, :ed, :c)");
      $cmd->bindValue(":n",$nome);
      $cmd->bindValue(":t",$telefone);
      $cmd->bindValue(":e",$email);
      $cmd->bindValue(":ed",$endereco);
      $cmd->bindValue(":c",$cargo);
      $cmd->execute();

      return true;
    }
  }



}
















 ?>

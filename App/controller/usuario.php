<?php
require_once '../model/Connection.php';
/**
 *  Classe para fazer o CRUD no funcionario
 */
class usuario extends Connection
{


  public function buscarDadosUsuario($id){

    $res = array();
    $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    return $res;
  }

  public function atualizarDados($id,$nome,$email,$acesso){

        $cmd = $this->pdo->prepare("UPDATE usuarios SET nome = :n, email = :e, fk_acesso_usuario = :ac WHERE id_usuario = :id");
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":ac",$acesso);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
  }

  public function excluirUsuario($id){

    $cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function cadastrarUsuario($nome,$senha,$email,$acesso){

    $cmd = $this->pdo->prepare("SELECT id_usuario from usuarios WHERE email = :e"); // VRIFICAR CADASTRO
    $cmd->bindValue(":e",$email);
    $cmd->execute();
    if ($cmd->rowCount() > 0) // JÁ EXISTE
    {
      return false;
    }else //  NÃO FOI ENCONTRADO
    {
      $cmd = $this->pdo->prepare("INSERT INTO usuarios (nome,senha,email,fk_acesso_usuario, controleAcesso) VALUES 
      (:n, :s, :e, :ac, :contr)");
      $cmd->bindValue(":n",$nome);
      $cmd->bindValue(":s",$senha);
      $cmd->bindValue(":e",$email);
      $cmd->bindValue(":ac",$acesso);
      $cmd->bindValue(":contr", 0); // NUNCA LOGOU NO SISTEMA
      $cmd->execute();

      return true;
    }
  }



}
















 ?>

<?php

require_once '../model/Connection.php';

/**
 * Classe para Fazer login
 */
class Sessao extends Connection
{

  public function logar($email,$senha){

    {

      $cmd = $this->pdo->prepare("SELECT id_usuario,fk_acesso_usuario,nome,email,controleAcesso FROM usuarios WHERE email = :e AND senha = :s");
      $cmd->bindValue(":e",$email);
      $cmd->bindValue(":s",$senha);
      $cmd->execute();
  
      if ($cmd->rowCount() > 0) {
          $dados = $cmd->fetch();
          session_start();

          $_SESSION['id_usuario'] = $dados['id_usuario'];
          $_SESSION['email'] = $dados['email'];
          $_SESSION['acesso'] = $dados['fk_acesso_usuario'];
          $_SESSION['nome_dados']  = $dados['nome'];
          $_SESSION['email'] = $dados['email'];
          $_SESSION['controleAcesso']  = $dados['controleAcesso'];

  
  
        return true;
      }else {
  
  
      return false;
      }

    }




   
  }

  public function logoutAdmin(){
    session_start();
    unset($_SESSION['nome_admin']);
    header("Location: ../../index.php");
  }

  public function logoutGerente(){
    session_start();
    unset($_SESSION['nome_gerente']);
    header("Location: ../../index.php");
  }

  public function logoutFarmac(){
    session_start();
    unset($_SESSION['nome_farmaceutico']);
    header("Location: ../../index.php");
  }

}











 ?>

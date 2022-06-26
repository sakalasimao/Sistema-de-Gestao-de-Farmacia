<?php
require_once '../controller/sessao.php';
require_once '../model/Connection.php';
$entrar = new Sessao;
$conn = new Connection;
session_start();


if (isset($_POST['nome'])) {

  $nome = addslashes($_POST['nome']);
  $senha = addslashes($_POST['senha']);

  if (!empty($nome) && !empty($senha)) {

    if ($entrar->logar($nome,$senha)) {

      if($_SESSION['controleAcesso'] == 0){

       // $_SESSION['email_login'] = $nome;
        header('Location: ../../password_new.php');

      }else{
        if ($_SESSION['acesso'] == 1) {
          //ADMIN
          unset($_SESSION['erro']);
            $_SESSION['nome_admin'] = $_SESSION['nome_dados'];
            $_SESSION['email_admin'] = $_SESSION['email'];
            $_SESSION['id_usuario_admin'] = $_SESSION['id_usuario'];
/*INICIO DO LOG ADMIN*/
          $desc = "Acessou o Sistema";
          $tipo = "Aviso"; 
          $dataV = date('y-m-d');
          /**  
           *  Informação 
           * Aviso
           * Erro
          */
          $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
          $cmd->bindValue(":t",$tipo);
          $cmd->bindValue(":ds",$desc);
          $cmd->bindValue(":dn",$dataV);
          $cmd->bindValue(":fk", $_SESSION['id_usuario_admin']);
          $cmd->execute();

/* FIM DO LOG ADMIN*/
            header("Location: ../view/AdminDash.php");
        }
    
        if ($_SESSION['acesso'] == 2) {
          //GERENTE
          unset($_SESSION['erro']);
          $_SESSION['nome_gerente'] = $_SESSION['nome_dados'];
          $_SESSION['email_ger'] = $_SESSION['email'];
          $_SESSION['id_usuario_ger'] = $_SESSION['id_usuario'];

    /*INICIO DO LOG */
          $desc = "Acessou o Sistema";
          $tipo = "Aviso"; 
          $dataV = date('y-m-d');
          /**  
           *  Informação 
           * Aviso
           * Erro
          */
          $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
          $cmd->bindValue(":t",$tipo);
          $cmd->bindValue(":ds",$desc);
          $cmd->bindValue(":dn",$dataV);
          $cmd->bindValue(":fk", $_SESSION['id_usuario_ger']);
          $cmd->execute();

/* FIM DO LOG */

          header("Location: ../view/GerFuncRead.php");
        }
    
        if ($_SESSION['acesso'] == 3) {
          //FARMACEUTICO
          unset($_SESSION['erro']);
          $_SESSION['nome_farmaceutico'] = $_SESSION['nome_dados'];
          $_SESSION['email_farm'] = $_SESSION['email'];
          $_SESSION['id_usuario_farm'] = $_SESSION['id_usuario'];

    /*INICIO DO LOG */
              $desc = "Acessou o Sistema";
              $tipo = "Aviso"; 
              $dataV = date('y-m-d');
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
    
    /* FIM DO LOG */

          header("Location: ../view/FarmVenda.php");
        }

      }

    


  }else {
   // session_start();
    $_SESSION['erro_senha'] = "";
    
    $not_login = "Não Logado";
    $cmd2 = $conn->pdo->prepare("SELECT id_usuario, nome FROM usuarios  WHERE nome = :n");
    $cmd2->bindValue(":n", $not_login);
    $cmd2->execute();
    $res = $cmd2->fetch();

    $login_ghost = $res['id_usuario'];

    /*INICIO DO LOG */
    $desc = "Erro ao Autenticar no Sistema";
    $tipo = "Erro"; 
    $dataV = date('y-m-d');
    /**  
     *  Informação 
     * Aviso
     * Erro
    */
    $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
    $cmd->bindValue(":t",$tipo);
    $cmd->bindValue(":ds",$desc);
    $cmd->bindValue(":dn",$dataV);
    $cmd->bindValue(":fk", $login_ghost);
    $cmd->execute();

/* FIM DO LOG */
   header('Location: ../../index.php');
  }

  }else {
    session_start();
    $_SESSION['erro_vazio'] = "";
    header('Location: ../../index.php');
  }
}

if (isset($_POST['logout-farm'])) {
        /*INICIO DO LOG ADMIN*/
        $desc = "Saiu do Sistema";
        $tipo = "Aviso"; 
        $dataV = date('y-m-d');
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
  
  /* FIM DO LOG ADMIN*/
  $entrar->logoutFarmac();
}


if (isset($_POST['logout-gerent'])) {
        /*INICIO DO LOG ADMIN*/
        $desc = "Saiu do Sistema";
        $tipo = "Aviso"; 
        $dataV = date('y-m-d');
        /**  
         *  Informação 
         * Aviso
         * Erro
        */
        $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
        $cmd->bindValue(":t",$tipo);
        $cmd->bindValue(":ds",$desc);
        $cmd->bindValue(":dn",$dataV);
        $cmd->bindValue(":fk", $_SESSION['id_usuario_ger']);
        $cmd->execute();
  
  /* FIM DO LOG ADMIN*/
  $entrar->logoutGerente();
}

if (isset($_POST['logout-admin'])) {
      /*INICIO DO LOG ADMIN*/
      $desc = "Saiu do Sistema";
      $tipo = "Aviso"; 
      $dataV = date('y-m-d');
      /**  
       *  Informação 
       * Aviso
       * Erro
      */
      $cmd = $conn->pdo->prepare("INSERT INTO logger (tipo,descricao,criandoLogger, fk_usuario_logger) VALUES (:t, :ds, :dn, :fk)");
      $cmd->bindValue(":t",$tipo);
      $cmd->bindValue(":ds",$desc);
      $cmd->bindValue(":dn",$dataV);
      $cmd->bindValue(":fk", $_SESSION['id_usuario_admin']);
      $cmd->execute();

/* FIM DO LOG ADMIN*/
  $entrar->logoutAdmin();
}







 ?>

<?php

require_once '../model/Connection.php';
/**
 *
 */
class Dash extends Connection
{

  public function contarUsuarios(){

    $cmd = $this->pdo->query("SELECT count(id_usuario) AS quant_user FROM usuarios");
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

     if ( $res['quant_user'] > 0) {
       $_SESSION['quant_user'] = $res['quant_user'];
    }else{
       $_SESSION['quant_user'] = 0;
    }
  }

  public function FaturamentoTotal(){

    $cmd = $this->pdo->query("SELECT sum(vendaTotal) AS ftotal from vendas");
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

     if ( $res['ftotal'] > 0) {
       $_SESSION['ftotal'] = $res['ftotal'];
    }else{
       $_SESSION['ftotal'] = 0;
    }
  }

  public function contarProdutos(){

    $cmd = $this->pdo->query("SELECT count(id_cli) AS quant_cli FROM clientes");
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

    if ( $res['quant_cli'] > 0) {
       $_SESSION['quant_cli'] = $res['quant_cli'];
    }else{
       $_SESSION['quant_cli'] = 0;
    }

  }

  public function contarFuncionario(){

    $cmd = $this->pdo->prepare("SELECT count(id_funcionario) AS quant_func FROM funcionarios");
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

     if ( $res['quant_func'] > 0) {
        $_SESSION['quant_func'] = $res['quant_func'];
     }else{
        $_SESSION['quant_func'] = 0;
     }
  }

}







 ?>

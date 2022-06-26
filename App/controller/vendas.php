<?php
require_once '../model/Connection.php';

/**
 *
 */
class Vendas extends Connection
{

  public function cadastrarVenda($venda_total, $venda_desconto, $nome_cliente, $pagamento_cliente, $venda_troco, $venda_data, $venda_user, $tipo_pagamento){
    //  $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $cmd = $this->pdo->prepare("SELECT id_venda from vendas WHERE fk_usuario_venda = :fk_us and vendaTotal = :vendat  and vendaDesconto = :vendadesc
       and vendaCliente = :vendacli and vendaPagCliente = :pagcliente and vendaTroco = :vendatr and vendaData = :vendadat and fk_tipopag_venda = :fk_tp "); // VRIFICAR CADASTRO
     
      $cmd->bindValue(":fk_us",$venda_user);
      $cmd->bindValue(":vendat",$venda_total);
      $cmd->bindValue(":vendadesc",$venda_desconto);
      $cmd->bindValue(":vendacli",$nome_cliente);

      $cmd->bindValue(":pagcliente",$pagamento_cliente);
      $cmd->bindValue(":vendatr",$venda_troco);

      $cmd->bindValue(":vendadat",$venda_data);
      $cmd->bindValue(":fk_tp",$tipo_pagamento);
      $cmd->execute();

      if ($cmd->rowCount() > 0) // JÁ EXISTE
      {
        return false;
      }else // NÃO FOI ENCONTRADO -  CADASTRA NOVA
      {
        $comand = $this->pdo->prepare("INSERT INTO vendas (vendaTotal, vendaDesconto, vendaCliente, vendaPagCliente, vendaTroco, vendaData, fk_usuario_venda, fk_tipopag_venda)
        VALUES(:vendaTotal, :vendaDesconto , :vendaCliente , :vendaPagCliente, :vendaTroco, :vendaData, :fk_usuario_venda, :fk_tipopag_venda);");
       
       $comand->bindValue(":fk_usuario_venda",$venda_user);
       $comand->bindValue(":vendaTotal",$venda_total);
       $comand->bindValue(":vendaDesconto",$venda_desconto);
       $comand->bindValue(":vendaCliente",$nome_cliente);
 
       $comand->bindValue(":vendaPagCliente",$pagamento_cliente);
       $comand->bindValue(":vendaTroco",$venda_troco);
 
       $comand->bindValue(":vendaData",$venda_data);
       $comand->bindValue(":fk_tipopag_venda",$tipo_pagamento);
       $comand->execute();

        return true;
      }

    }

    public function buscarDados(){

      $res = array();
      $cmd = $this->pdo->query("SELECT * FROM vendas ORDER BY id_venda DESC");
      $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
      return $res;

    }

    public function buscarVendaGrafico(){

      $res = array();
      $cmd = $this->pdo->query("SELECT count(id_venda) as total,monthname(vendaData) as mes from vendas where month(vendaData) between  1 and 12 group by month(vendaData)");
      $res = $cmd->fetch();

       //var_dump($res[0]['total']);
       //var_dump($res);

       foreach ($res as $data) {
         $total = $data['total'];
         $mes = $data['mes'];
       }
       return $res;

    }
  }























 ?>

<?php

require_once '../model/Connection.php';
/**
 *
 */
class Carrinho extends Connection
{


  public function buscarDados(){

    $res = array();
    $cmd = $this->pdo->query("SELECT * FROM carrinho_temp");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $res;

  }

  public function finalizarVenda($data){

    foreach ($data as $key => $carrinho) {

      

   

        $comand = $this->pdo->prepare("SELECT * FROM produtos WHERE id_produto = :id");
        $comand->bindValue(":id", $carrinho['fk_produtos_carrinho']);
        $comand->execute();
        $res = $comand->fetchAll(PDO::FETCH_ASSOC);

          $qtdProduto = $res[0]["qtdProduto"] - $carrinho['qtdVenda'];

          $cmd = $this->pdo->prepare("UPDATE produtos SET qtdProduto = :q WHERE id_produto = :id");
          $cmd->bindValue(":id", $carrinho['fk_produtos_carrinho']);
          $cmd->bindValue(":q", $qtdProduto);
          $cmd->execute();
          $res = $cmd->fetch(PDO::FETCH_ASSOC);

          $venda = $this->pdo->prepare("SELECT * FROM vendas  order by id_venda desc");
          $venda->execute();
          $res_sale =  $venda->fetch();

         // var_dump($res_sale['id_venda']);  

       

          $itens_venda = $this->pdo->prepare("INSERT INTO itens_venda (qtdVendaItens, precoVendaItens, subtotalVendaItens, fk_vendas_itens, fk_produtos_itens) 
          VALUES (:qtdIt, :precoIt, :subIt, :fkVIt, :fkPIt )");
          $itens_venda->bindValue(':qtdIt', $carrinho['qtdVenda']);
          $itens_venda->bindValue(':precoIt', $carrinho['precoVenda']);
          $itens_venda->bindValue(':subIt', $carrinho['subtotalVenda']);
          $itens_venda->bindValue(':fkVIt',  $res_sale['id_venda']);
          $itens_venda->bindValue(':fkPIt', $carrinho['fk_produtos_carrinho']);
          $itens_venda->execute();

          $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        //
       

    }

  }

  public function excluirProdutoCarrinho($id){

    $cmd = $this->pdo->prepare("DELETE FROM carrinho_temp WHERE id_carrinho = :id");
    $cmd->bindValue(":id",$id);
    $cmd->execute();
  }

  public function excluirProdutoCarrinhoTudo(){

    $cmd = $this->pdo->prepare("DELETE FROM carrinho_temp ");
    $cmd->execute();
  }


  public function adicionarCarrinho($barcode, $qtdVenda, $precoVenda, $subtotalVenda, $desconto, $id_prod){

    $cmd = $this->pdo->prepare("SELECT id_carrinho, barcode, nomeProduto, precoVenda, qtdVenda, subtotalVenda, desconto from 
    carrinho_temp inner join produtos on carrinho_temp.fk_produtos_carrinho = produtos.id_produto where barcode = :code or nomeProduto = :nomeP"); // VRIFICAR CADASTRO
    $cmd->bindValue(":code",$barcode);
    $cmd->bindValue(":nomeP",$barcode);
    $cmd->execute();

    if ($cmd->rowCount() > 0) // Já está no carrinho;
    {
       #PEGANDO VALORES DO CARRINHO

      $cart_qtd = $cmd->fetch();
     
      $qtd = $cart_qtd['qtdVenda'];
      $preco = $cart_qtd['precoVenda'];
      $subT = $cart_qtd['subtotalVenda'];
      $id_cart = $cart_qtd['id_carrinho'];

      $qtdUp = $qtd + 1;
      $sub = (int)$preco * (int)$qtdUp;

      # ATUALIZAR QUANTIDADE COM BARCODE

      $updateQtd = $this->pdo->prepare("UPDATE carrinho_temp SET qtdVenda = :qtd , subtotalVenda = :sub WHERE id_carrinho = :id");
      $updateQtd->bindValue(":qtd",$qtdUp);
      $updateQtd->bindValue(":sub",$sub);
      $updateQtd->bindValue(":id",$id_cart);
      $updateQtd->execute();


      
      return false;

    }else //ainda não está no carrinho
    {
      

        $cmd = $this->pdo->prepare("INSERT INTO carrinho_temp (qtdVenda, precoVenda, subtotalVenda, desconto, fk_produtos_carrinho) VALUES (:qtd, :price ,:sub, :dc, :fk)");
        $cmd->bindValue(":qtd",$qtdVenda);
        $cmd->bindValue(":price",$precoVenda);
        $cmd->bindValue(":sub",$subtotalVenda);
        $cmd->bindValue(":dc",$desconto);
        $cmd->bindValue(":fk",$id_prod);
        $cmd->execute();

        return true;
      

    }
  }

  public function somaSubtotal(){

    $cmd = $this->pdo->query("SELECT sum(subtotalVenda) AS sumsub FROM carrinho_temp");
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);

       $_SESSION['sumsub'] = $res['sumsub'];

    }

    public function descontoTotal(){

      $cmd = $this->pdo->query("SELECT sum(desconto) AS dc FROM carrinho_temp");
      $cmd->execute();
      $res = $cmd->fetch(PDO::FETCH_ASSOC);
  
         $_SESSION['descontoTotal'] = $res['dc'];
  
      }




}







 ?>

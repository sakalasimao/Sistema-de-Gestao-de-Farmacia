<?php
require_once '../model/Connection.php';
$conn = new Connection;
session_start();

// var_dump($_POST);

if(isset($_GET['plus'])){

     // BTN ADICIONAR +1 DE QTD NO CARRINHO

    $carrinho = $conn->pdo->prepare("SELECT * FROM carrinho_temp WHERE id_carrinho = :id");
    $carrinho->bindValue(":id",$_GET['plus']);
    $carrinho->execute();
    $carrinho_itens = $carrinho->fetch();

    $qtdVenda = $carrinho_itens['qtdVenda'];
    $precoVenda = $carrinho_itens['precoVenda'];
    $idProduto_carrinho = $carrinho_itens['fk_produtos_carrinho'];
    
     $qtdPlus = $qtdVenda + 1;

     $sub = $precoVenda * $qtdPlus;

     $product = $conn->pdo->prepare("SELECT * FROM produtos WHERE id_produto = :idp");
     $product->bindValue(":idp",$idProduto_carrinho);
    $product->execute();

    $product_itens = $product->fetch();

     $qtdProd = $product_itens['qtdProduto']; // qtd produtos

        if($qtdPlus > $qtdProd){
            //echo 'Já Atigiste o limite no estoque do produto!';
            $_SESSION['limite_estoque'] = '';
            
        }else{
            $qtdUp = $conn->pdo->prepare("UPDATE carrinho_temp SET qtdVenda = :qtd, subtotalVenda = :sub WHERE id_carrinho = :id");
                $qtdUp->bindValue(":qtd",$qtdPlus);
                $qtdUp->bindValue(":sub", $sub);
                $qtdUp->bindValue(":id",$_GET['plus']);
                $qtdUp->execute();
        }

     



}else{

    // BTN REMOVER + 1 DE QTD NO CARRINHO

    $carrinho = $conn->pdo->prepare("SELECT * FROM carrinho_temp WHERE id_carrinho = :id");
    $carrinho->bindValue(":id",$_GET['minus']);
    $carrinho->execute();
    $carrinho_itens = $carrinho->fetch();


    $qtdVenda =  $carrinho_itens['qtdVenda'];
    $precoVenda = $carrinho_itens['precoVenda'];

    $qtdMinus = $qtdVenda - 1;

    if($qtdMinus == 0){

        $delete = $conn->pdo->prepare("DELETE FROM carrinho_temp WHERE id_carrinho = :id");
        $delete->bindValue(":id",$_GET['minus']);
        $delete->execute();
    }

    $sub = $precoVenda * $qtdMinus;

    $qtdUp = $conn->pdo->prepare("UPDATE carrinho_temp SET qtdVenda = :qtd, subtotalVenda = :sub WHERE id_carrinho = :id");
    $qtdUp->bindValue(":qtd",$qtdMinus);
    $qtdUp->bindValue(":sub", $sub);
    $qtdUp->bindValue(":id",$_GET['minus']);
    $qtdUp->execute();

}



/*DISCONTO DB */

// if(isset($_GET['descont']) && isset($_POST['desconto'])){

//     $carrinho = $conn->pdo->prepare("SELECT fk_produtos_carrinho, id_carrinho, barcode, nomeProduto, precoVenda, qtdVenda, subtotalVenda, desconto, fk_produtos_carrinho from 
//     carrinho_temp inner join produtos on carrinho_temp.fk_produtos_carrinho = produtos.id_produto
//      WHERE fk_produtos_carrinho = :id");
//     $carrinho->bindValue(":id",$_GET['descont']);
//     $carrinho->execute();
//     $carrinho_itens = $carrinho->fetch();

//     $id = $carrinho_itens['id_carrinho'];
//     $fk_p = $carrinho_itens['fk_produtos_carrinho'];

//     echo $fk_p;


//     $qtdUp = $conn->pdo->prepare("UPDATE carrinho_temp SET desconto = :dc WHERE  fk_produtos_carrinho = :fk");
//     $qtdUp->bindValue(":dc",$_POST['desconto']);
//     $qtdUp->bindValue(":fk",$_GET['descont']);
//     $qtdUp->execute();
// }






?>
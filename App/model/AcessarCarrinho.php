<?php
session_start();

require_once 'Connection.php';
include_once '../controller/Carrinho.php';
$conn = new Connection;
$cart = new Carrinho;

$pesquisa = $_GET['pesquisa'];


if($pesquisa != "" ){

$cmd = $conn->pdo->prepare("SELECT id_produto, barcode, nomeProduto, precoProduto, qtdProduto, dataExpProduto FROM produtos WHERE barcode = :barcode or nomeProduto = :np  and date(current_date())   < dataExpProduto"); // PRODUTOS PESQUISA
$cmd->bindValue(":barcode",$pesquisa);
$cmd->bindValue(":np",$pesquisa);
$cmd->execute();

if ($cmd->rowCount()) {

	$res =  $cmd->fetch(PDO::FETCH_ASSOC);
	$qtd_carrinho = $res['qtdProduto'];
  $dataxp_carrinho = $res['dataExpProduto'];


  if (!$qtd_carrinho == 0) {

    if ($qtd_carrinho > 0) {



    $id_prod = $res['id_produto'];
    $codigo = $res['barcode'];
    $nome_prod =   $res['nomeProduto'];
    $preco =  $res['precoProduto'];
    $desc = 0;
    $quant = 1;

    $subtotal  = (int)$preco;


 
    if (!$cart->adicionarCarrinho($codigo, $quant, $preco, $subtotal, $desc, $id_prod))
    {

    echo "	<script>
       window.location.href='../view/FarmVenda.php';
     </script>";
    
    }else{
 /*
      echo "	<script>
       window.location.href='../view/FarmVenda.php';
     </script>";
    */
    }

  
  }else{
    // PRODUTO ESGOTADO NO ESTOQUE

    echo '
    <script type="text/javascript">
    $(document).ready(function(){
      var toastMixin = Swal.mixin({
          toast: true,
          icon: "success",
          title: "General Title",
          animation: false,
          position: "top-right",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer)
            toast.addEventListener("mouseleave", Swal.resumeTimer)
          }
        });
  
        toastMixin.fire({
          animation: true,
          title: "Produto esgotado no estoque!",
          icon: "warning"
        });
    });
    </script>
    ';
  }

  }else {
     // PRODUTO ESGOTADO NO ESTOQUE

     echo '
     <script type="text/javascript">
     $(document).ready(function(){
       var toastMixin = Swal.mixin({
           toast: true,
           icon: "success",
           title: "General Title",
           animation: false,
           position: "top-right",
           showConfirmButton: false,
           timer: 3000,
           timerProgressBar: true,
           didOpen: (toast) => {
             toast.addEventListener("mouseenter", Swal.stopTimer)
             toast.addEventListener("mouseleave", Swal.resumeTimer)
           }
         });
   
         toastMixin.fire({
           animation: true,
           title: "Produto esgotado no estoque!",
           icon: "warning"
         });
     });
     </script>
     ';
    
  }



}

}else{
  echo '
  <script type="text/javascript">
  $(document).ready(function(){
    var toastMixin = Swal.mixin({
        toast: true,
        icon: "success",
        title: "General Title",
        animation: false,
        position: "top-right",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer)
          toast.addEventListener("mouseleave", Swal.resumeTimer)
        }
      });

      toastMixin.fire({
        animation: true,
        title: "Preencha os campos",
        icon: "warning"
      });
  });
  </script>
  ';
}






if (isset($_GET['id'])) {

  $id_produto = addslashes($_GET['id']);
  $cart->excluirProdutoCarrinho($id_produto);
   header('Location: ../view/FarmVenda.php');


 } 
 
 
 
 ?>

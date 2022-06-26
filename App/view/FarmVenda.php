<?php
ob_start();
session_start();
require_once '../model/Connection.php';
require_once '../controller/Carrinho.php';
require_once '../controller/vendas.php';
$conn = new Connection;
$cart = new Carrinho;
$sales =  new Vendas;

if (!isset($_SESSION['nome_farmaceutico'])) {
  echo "<script>window.location.href='../../index.php';</script>";
  exit;
}

 ?>
<!doctype html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="shortcut icon" href="images/logo-green.svg" type="image/x-icon">
     <link rel="stylesheet" href="../../Library/boostrap5/bootstrap.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
     <link rel="stylesheet" href="../../Library/fontawesome/fontawesome-free-5.15.4-web/css/all.min.css">
      <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/FarmVenda.css">
    <title>S. Farmacia</title>
  </head>
  <body>

    <div class="page">

      <div class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-logo-container"  data-bs-toggle="modal" data-bs-target="#exampleModalToggle" title="Visualizar Perfil"> <!--PERFIL-->
            <div class="logo-container">
              <img src="images/logo-green.svg" alt="logo" class="logo-sidebar">
            </div>
                <div class="brand-name-container" >
                  <p class="brand-name">
                    <?php echo $_SESSION['nome_farmaceutico']; ?> <br>
                    <span class="brand-subname">
                      Farmacêutico
                    </span>

                  </p>
                </div>
          </div>
        </div>

        <div class="sidebar-body">
          <ul class="navegation-list">
            <li class="navegation-list-item nav-color">
              <a href="#" class="navegation-link active">
                <div class="row">
                  <div class="col-1">
                    <i class="fa-solid fa-box"></i>
                  </div>
                  <div class="col">
                    Caixa
                  </div>
                </div>

              </a>
            </li>

          

            <li class="navegation-list-item">
              <a href="FarmProd.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                  <i class="fa-solid fa-receipt"></i>
                  </div>
                  <div class="col">
                    Produtos
                  </div>
                </div>
              </a>
            </li>

            <li class="navegation-list-item">
              <a href="FarmMov.php" class="navegation-link">
                <div class="row">
                  <div class="col-1 me-2">
                  <i class="fa-solid fa-coins"></i>
                  </div>
                  <div class="col">
                    Movimentos
                  </div>
                </div>
              </a>
            </li>

            <form class="" action="../model/logarSistema.php" method="post">
              <button type="submit" name="logout-farm" class="btn" style="padding:0px; margin:0px; height:50px;">
                <li class="btn-logout">
                  <a href="#" class="navegation-link">
                    <div class="row d-flex align-items-center ">
                      <div class="col-1">
                        <i class="fa-solid fa-arrow-left"></i>
                      </div>
                      <div class="col">
                      Sair
                      </div>
                    </div>
                  </a>
                </li>
                </button>
              </form>

          </ul>

        </div>

      </div>

      <div class="content">
        <div class="container mt-3">
          <div class="row mb-1 ms-1">
            <div class="col-10">
              <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Área de Vendas</a></li>
                </ol>
              </nav>
            </div>
          </div>


          <div class="row">
            <div class="col-md-4" >
              <div class="card p-3 card-conf">
                <div class="body-card p-2">


                    <div class="row mb-2 px-2">

                    <?php $_SESSION['barcode'] = ""; ?>

                    <?php if(isset($_SESSION['barcodeMode'])) :?> <!---MODO CÓDIGO-->
                        <label for="pesquisa" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Código do Produto</label>
                        
                        <div class="input-group " style="margin-left: -13px;">
                          <input type="text" class="input-style-border form-control-sm col" style="width: 300px;" name="pesquisa" placeholder="Código de Barras" autocomplete="off" id="pesquisa" disabled>
                          <a href="?writeMode"  title="Modo Escrever" class="input-group-text col-2 d-flex justify-content-center" id="basic-addon2" style="border-radius: 0 5px 5px 0 ;"><i class="fa-solid fa-arrows-rotate"></i></a>
                        </div>

                        
                        <div id="meg">
                        </div>
                    <?php else:?> <!---MODO ESCREVER-->

                        <label for="pesquisa" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Nome do Produto</label>
                 
                        <div class="input-group " style="margin-left: -13px;">
                          <input type="text" class="input-style-border form-control-sm col" style="width: 300px;" name="pesquisa" placeholder="Nome do Produto" autocomplete="off" id="pesquisa">
                          <a href="?barcodeMode" title="Modo Código" class="input-group-text col-2 d-flex justify-content-center" id="basic-addon2" style="border-radius: 0 5px 5px 0 ;"><i class="fa-solid fa-arrows-rotate"></i></a>
                        </div>
                            
                        <div id="meg">
                        </div>

                    <?php endif;?>

                      </div>

                      <?php
                      
                      if(isset($_GET['barcodeMode'])){
                        $_SESSION['barcodeMode'] = "";
                        echo '<script>location.reload();</script>';
                        header('Location: FarmVenda.php');
                        
                      }

                      if(isset($_GET['writeMode'])){
                        unset($_SESSION['barcodeMode']);
                        echo '<script>location.reload();</script>';
                        header('Location: FarmVenda.php');
                       
                      }
                      
                      
                      ?>


                <form action="../model/AcessarVenda.php" method="post">
                      <div class="row px-2 mb-2">
                          <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Nome do Cliente</label>
                          <input type="text" class="input-style form-control-sm  me-1" maxlength="20" style="width: 300px;" name="cliente" placeholder="Ex: Simão dos Santos" id="cliente">
                        </div>

                        <div class="row px-2 mb-2">
                        <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Valor do Cliente</label>
                          <input type="number"  min="1" class="input-style form-control-sm  me-1" style="width: 200px;"  name="valor_cli" placeholder="0" id="value_client" onchange="calcCliente()">
                        </div>
<!----------------------
                        <div class="row px-2 mb-2">
                        <?php $cart->descontoTotal(); ?>
                        <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Desconto Total</label>
                        <input type="number"  min="1" class="input-style form-control-sm  me-1" style="width: 200px;"  name="desconto" placeholder="0" id="desconto" onchange="calcCliente()">
                        </div>
                    ------------------>

                        <div class="row px-2 mb-2">
                        <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Tipo de Pagamento</label>
                        <select class="form-select form-select-sm " aria-label="select tipo de pag" style="width: 200px;" name="tipoPag" required id="pag" onchange="calcCliente()">
                              <?php

                              $cmd = $conn->pdo->prepare("SELECT * from tipopag");
                              $cmd->execute();

                              if ($cmd->rowCount() > 0) {
                                while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

                                echo "<option value='{$res['id_pag']}'>{$res['pagamento']}</option>";

                            }
                              }

                           ?>
                           </select>
                        </div>

                        <hr style="width: 300px;">

                        <div class="row px-2 mb-2">
                        <?php $cart->somaSubtotal(); ?>
                        <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Total da Venda</label>
                         <input type="hidden" name="total" value="<?php if (isset($_SESSION['sumsub'])) { echo $_SESSION['sumsub'];} ?>">
                          <input type="number"  min="1" class="input-style form-control-sm  me-1" style="width: 200px;"  name="total" placeholder="0" id="total" value="<?php if (isset($_SESSION['sumsub'])) { echo $_SESSION['sumsub'];} ?>" disabled>
                          <input type="hidden"   class="input-style form-control-sm  me-1" style="width: 200px;"  name="total" placeholder="0.00" id="resultado" disabled>

                          
                        </div>

                        <div class="row px-2 mb-3">
                        <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px;">Troco</label>
                            
                          <input type="number"  min="1" class="input-style form-control-sm  me-1" style="width: 200px;"  name="troco" placeholder="0" id="troco" readonly = true >
                        </div>


                          <div class="row ">
                            <div class="col ">
                              <input type="hidden" name="final" value="">
                              <button type="submit" name="button" class="btn btn-success mb-1 col">Finalizar</button>
                              <a href="FarmVenda.php?deleteCart" class="btn btn-danger col" style="color:#fff;">Cancelar</a>
                            </div>
                          </div>
                     </form>
                                <?php
                                
                              
                                if (isset($_GET['deleteCart'])) {
                                  
                                  $cart->excluirProdutoCarrinhoTudo();
                                  
                                  header('Location: FarmVenda.php');
                                }
                              
                                 ?>


                </div>
              </div>
            </div>

            
            <div class="col">

                  <table class="content-table table shadow-sm">
                    <thead>
                      <th>Código</th> 
                      <th>Nome</th>
                      <th>Preco</th>
                      <th>Quantidade</th>
                      <th>Subtotal</th>
                      <th>Operações</th>
                    </thead>
                    <?php

                    $cmd = $conn->pdo->query("SELECT dataExpProduto, fk_produtos_carrinho, id_carrinho, barcode, nomeProduto, precoVenda, qtdVenda, subtotalVenda, desconto from 
                    carrinho_temp inner join produtos on carrinho_temp.fk_produtos_carrinho = produtos.id_produto ORDER BY id_carrinho DESC");
                    
                      $datav = date('y-m-d');
                      while ($res = $cmd->fetch(PDO::FETCH_ASSOC)){

                        ?>
                        <tbody>
                          <tr>
                          <td><?php
                              if($res['barcode'] == ""){
                                $barcode = "SEM CÓDIGO";
                              }else{
                                $barcode = $res['barcode'];
                              }
                               echo ucwords($barcode); 
                               ?></td>

                            <td><?php echo  $res['nomeProduto'];?></td>
                            <td><?php echo  $res['precoVenda'];?></td>
                            <td>
                             
                              <a  data-id="<?php echo $res['id_carrinho']; ?>" class="btn btn-sm btn-success me-1 plus" style="border-radius: 30px;"><strong>+</strong></a>
                              <?php echo $res['qtdVenda']; ?>
                              <input type="hidden" class="quantity" value="<?php echo $res['qtdVenda']; ?>">
                              <a  data-id="<?php echo $res['id_carrinho']; ?>" class="btn  btn-success ms-1 minus" style="border-radius: 60px; padding:4px 10px;"><strong>-</strong></a>
                            </td>
                            <td ><?php echo $res['subtotalVenda']; ?></td>
                            <td>
                              <a href="../model/AcessarCarrinho.php?id=<?php echo $res['id_carrinho']; ?>" ><button type="button" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button></a>
                            </td>
                          </tr>
                        </tbody>


                        <?php
                      }


                     ?>
                  </table>    
            </div>
          </div>

          </div>
          </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>

  <?php
    include 'php_include/msg_farmvenda.php';
    if(isset($_SESSION['delete_cart'])){
      $cart->excluirProdutoCarrinhoTudo();
      echo '<script>location.reload();</script>';
  unset($_SESSION['delete_cart']);

}

if (isset($_SESSION['limite_estoque'])) {
  echo '
  <script>
  $(document).ready(function(){
      Swal.fire({
          icon: "error",
          title: "Atigiste o Limite",
          text: "Já Atigiste o limite no estoque deste produto!"
      });
  });
</script>
  ';
  unset($_SESSION['limite_estoque']);
}    




 
 
 

    ob_end_flush();
    ?>

    <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="../../Library/onscan.js-master/onscan.js"></script>
    <script src="js/scanner.js"></script>
    <script src="js/venda.js"></script>
    <script src="js/quantity.js"></script>
    <script>
    $(function(){
      
      $("#pesquisa").autocomplete({
        source: 'autocomplete.php'
      });

      $("#pesquisa").change(function(){
        
    $.ajax({
      
          url: '../model/AcessarCarrinho.php',
          type: 'GET',
          async: true,
          data: {
              pesquisa: $("#pesquisa").val()
          },
          success: function(data){
              location.reload();
              location.reload();
              //$('#meg').html(data);
              //alert("OLLLÁ");
  
          },
          error: function(data){
              //$('#meg').html("PÁGINA INSERT NÃO ENCONTRADO!!");
          }
      });

    });

    });

   
 </script>

<?php include 'php_include/model_perfil_farm.php';?>
  </body>
</html>


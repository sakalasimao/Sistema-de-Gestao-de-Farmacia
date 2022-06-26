<?php



ob_start();
require_once '../model/Connection.php';
require_once '../controller/produtos.php';
$conn = new Connection;
$prod = new Produtos;
session_start();

if (!isset($_SESSION['nome_gerente'])) {
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
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/GerFuncRead.css">
    <title>S. Farmacia</title>
  </head>
  <body>

    <div class="page">

    <div class="sidebar">
        <div class="sidebar-header">
          <div class="sidebar-logo-container">
            <div class="logo-container">
              <img src="images/logo-green.svg" alt="logo" class="logo-sidebar">
            </div>
                <div class="brand-name-container" >
                  <p class="brand-name">
                    <?php echo $_SESSION['nome_gerente']; ?> <br>
                    <span class="brand-subname">
                      Gerente
                    </span>

                  </p>
                </div>
          </div>
        </div>

        <div class="sidebar-body">
          <ul class="navegation-list">
            <li class="navegation-list-item nav-color">
              <a href="GerFuncRead.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-book "></i>
                  </div>
                  <div class="col">
                    Cadastros
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item">
              <a href="GerVendas.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="far fa-chart-bar"></i>
                  </div>
                  <div class="col">
                    Vendas
                  </div>
                </div>

              </a>
            </li>

            <li class="navegation-list-item">
              <a href="GerEstoque.php" class="navegation-link">
                <div class="row">
                  <div class="col-1">
                    <i class="fas fa-archive"></i>
                  </div>
                  <div class="col">
                    Estoque
                  </div>
                </div>
              </a>
            </li>


            <form action="../model/logarSistema.php" method="post">
              <button type="submit" name="logout-gerent" class="btn " style="padding:0px; margin:0px; height:50px;">
                <li class="btn-logout">
                  <a href="#" class="navegation-link ">
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
            <div class="col">
            <nav  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="GerFuncRead.php"  class="ind">Cadastros</a></li>
                    <li class="breadcrumb-item"><a href="GerProdRead.php"  class="ind">Produtos</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Atualizar</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <?php
                                  if (isset($_GET['id_up'])) {

                                    $id_update = addslashes($_GET['id_up']);
                                    $res = $prod->buscarDadosProduto($id_update);
                                  }

                  

                                  if (isset($_POST['btn_prod_up'])) {

                                    

                                    $id_upd = addslashes($_GET['id_up']);
                                    $barcode = addslashes($_POST['code_prod']);
                                    $nome = addslashes($_POST['nome_prod']);
                                    $preco = addslashes($_POST['preco_prod']);
                                    $qtd = addslashes($_POST['qtd_prod']);
                                    $qtdc = addslashes($_POST['qtdc_prod']);
                                    $catg = addslashes($_POST['catg_prod']);
                                    $fabr = addslashes($_POST['fab_prod']);
                                    $data_exp = addslashes($_POST['dataexp']);
                                    $data = date('Y-m-d');

                                    if (!empty($nome) && !empty($qtd)  && !empty($qtdc)  && !empty($preco)) {

                                   $prod->atualizarDados($id_upd, $barcode, $nome, $catg, $preco, $qtd, $qtdc, $data, $data_exp, $fabr);
                                    header('Location: GerProdRead.php');
                                    
                                   

                                  }else {
                                    $_SESSION['campos'] = "";
                                  }

                                  }
                                  ob_end_flush();
                                   ?>




          <div class="row mb-4 ms-1 d-flex align-itens-center mt-5">
      <div class="col"> <!---CADASTRO--->
        <form   method="POST">
            <div class="card  p-2" style="border-radius: 8px;">
            <div class="body-card p-3">

<div class="row px-2 mb-2 d-flex align-itens-center">

  <div class="col">
     <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Código do Produto</label>
     <input type="number"  min= "1" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="code_prod" placeholder="3456789712345" value="<?php if (isset($res)) {echo $res['barcode'];} ?>"  >
  </div>

  <div class="col">
     <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Nome <span style="color:red;">*</span></label>
     <input type="text" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="nome_prod" placeholder="Amigyn" required value="<?php if (isset($res)) {echo $res['nomeProduto'];} ?>">
  </div>
    
  </div>

  <div class="row px-2 mb-2">

    <div class="col">
      <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Preço Unitário <span style="color:red;">*</span></label>
      <input type="number" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="preco_prod" placeholder="1000" min="1"   value="<?php if (isset($res)) {echo $res['precoProduto'];} ?>">
    </div>

    <div class="col mt-1">
      <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Quantidade Unitária <span style="color:red;">*</span></label>
      <input type="number" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="qtd_prod" placeholder="34" min="1" value="<?php if (isset($res)) {echo $res['qtdProduto'];} ?>">
    </div>
      
    </div>

    

    <div class="row px-2 mb-2 d-flex align-itens-center ">

    <div class="col">
    <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Quantidade de Compra <span style="color:red;">*</span></label>
      <input type="number" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" name="qtdc_prod" placeholder="70" min="1" value="<?php if (isset($res)) {echo $res['qtdCompraProduto'];} ?>">
    </div>

    <div class="col">
    <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Categoria <span style="color:red;">*</span></label>

    <select  class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" required name="catg_prod" >
    <?php

        $cmd = $conn->pdo->prepare("SELECT * from categoria order by id_categoria desc");
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
          while ($res2 = $cmd->fetch(PDO::FETCH_ASSOC)) {

          echo "<option value='{$res2['id_categoria']}'";

          if($res2['id_categoria'] == $res['fk_categoria_produto']){
            echo "selected='selected'";
          }
          
         echo " >{$res2['nomeCategoria']}</option>";

        }
        }

        ?>
    </select>

    </div>
   
    </div>

    <div class="row px-2 mb-2">

    <div class="col">
    <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Fabricante</label>

    <select  class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;" required name="fab_prod">
    <?php

        $cmd = $conn->pdo->prepare("SELECT * from fabricante order by id_fabricante desc");
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
          while ($res2 = $cmd->fetch(PDO::FETCH_ASSOC)) {

          echo "<option value='{$res2['id_fabricante']}'";

          if($res2['id_fabricante'] == $res['fk_fabricante_produto']){
            echo "selected = 'selected'";
          }
          
         echo " >{$res2['nomeFabricante']} | {$res2['pais']}</option>";

        }
        }

        ?>
    </select>

    </div>

    <div class="col">
    <label for="" style="margin-left: -10px; font-weight: 500; font-size: 15px; display:block;">Data de Expiração <span style="color:red;">*</span></label>
      <input type="date" name="dataexp" class="input-style form-control-sm  me-1"  style="width: 300px; margin-left: -10px;"  value="<?php if (isset($res)) {echo $res['dataExpProduto'];} ?>">
      </div>


    </div>


    <div class="row px-2 mb-2">


      <div class="col mt-4">
            <button type="submit" name="btn_prod_up" class="btn btn-success btn-sm me-2">Atualizar</button>
            <a href="GerProdRead.php" class=" btn btn-danger btn-sm" >Cancelar</a>
        </div>


</div>

  
  
</div>
            </div>
          </form>

      </div>

            <div class="col-4"> 
            <img src="images/catg_prod.png" alt="cadastro" class="img_config" >
            </div>
        


        </div>
    </div>


    <script src="../../Library/boostrap5/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="../../Library/sweetalert/sweetalert2.js"></script>
  </body>
</html>

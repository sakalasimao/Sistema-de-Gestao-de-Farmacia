<?php

include_once '../model/Connection.php';
require_once '../controller/categoria.php';
$conn = new Connection;
$catg = new Categoria;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/solid.js" integrity="sha384-KPytPVc+hwHwX9HXl4tA7SWJ0Sob6StzjVRoxC4Q4U0JgXujpuVrkBxR0Hsf8A25" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/fontawesome.js" integrity="sha384-9zErGp+biBilRrlpD1l3ExnaqXc8QLITlNpGtb4OL6W1JChl0wwmDNs4U/0UA8L8" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
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
            <li class="navegation-list-item ">
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

            <li class="navegation-list-item nav-color">
              <a href="#" class="navegation-link">
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
                  <li class="breadcrumb-item active" aria-current="page"><a class="ind ind-now">Estoque</a></li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="row mb-1 ms-1">
  
          <div class="card  p-2  card-config mt-2">
              <div class="body-card p-1">

        <div class="row mt-2"> <!---ARÉA DE PESQUISA E RELATÓRIOS-->
              <div class="col">
                  <form method="POST">
                      <div class="input-group mb-3">
                          <input type="text" class="input-style" size="20" name="pesqAll" placeholder="Pesquisar...">
                          <button type="submit" class="input-group-text" id="basic-addon2"><a href="#" style="color:#000"><i class="fa-solid fa-magnifying-glass"></i></a></button type="submit">
                         
                      </div>
                    </form>
                    </div>
            
                   <div class="col">
                     <!-------
                               <form method="post" style="display: flex; flex-direction: row; gap:10px;" class="ms-3 mt-2">
                <input type="date" class="form-control " name="data1" style="width: 120px;">
              <input type="date" class="form-control " name="data2" style="width: 120px;">
              <button type="submit" class="btn btn-sm btn-success" name="pes">Pesquisar</button>
              <a href="?stopFilter" class="btn btn-sm btn-danger " style="float: right;" title="Parar de Filtrar"><i class="fa-solid fa-trash-can"></i></a>
              </form>

                ------>
                <form method="post">
                        <div class="input-group mb-3">
                            <input type="date" class="form-control"  name="data1" placeholder=""  title="Data Inicial">
                            <input type="date" class="form-control"  name="data2" placeholder="" title="Data Final">
                          <button class="input-group-text" type="submit" name="pes"><i class="fa-solid fa-magnifying-glass"></i></button>
                           
                          </div>
                </form>

               <?php //var_dump($_POST); ?> 
                       
                    </div>

                    <div class="col  ">
                         <!---- 
                            <a href="?stopFilter" class="btn btn-sm btn-danger " style="float: right;" title="Parar de Filtrar"><i class="fa-solid fa-trash-can"></i></a>
                            <a href="../model/AcessarHVenda.php?report_hv"><button type="button" name="button" class="btn btn-success btn-sm btn-plus ms-2 ">Gerar Relatório</button></a>
                    ---->
                        <div class=" btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a  class="btn btn-danger" href="?stopFilter" title="Remover Filtração"><i class="fa-solid fa-filter"></i> Remover</a>
                            <a class="btn btn-success" title="Relatório Geral" href="../model/AcessarEstoque.php?report_stock_03"><i class="fa-solid fa-file-lines"></i> Relatório Geral</a>
                          </div>
                    
                    
                          </div>
                </div>

              </div>
          </div>


        <div class="row mt-2 ms-4" style="float: left;">
          <div class="col">
            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <a class="btn btn-success " href="GerEstoque.php">Produtos</a>
                    <a class="btn btn-success " href="GerEstoque_1mes.php">Expirados daqui a um mês</a>
                    <a  class="btn btn-success active">Já expirados</a>
              </div>
          </div>
        </div>
        
        
          <div class="row mb-1 ms-1 mt-2">
             
             <div class="table-responsive">

                 
               <table class="content-table table shadow-sm mt-2">
                 <thead>
                   <th>Código</th>
                   <th>Nome</th>
                   <th>Entrada</th>
                   <th>Saida</th>
                   <th>Qtd Compra</th>
                   <th>Criando</th>
                   <th>Expiração</th>
                 </thead>

                   <?php

                   if(isset($_POST['pes'])){

                     $data2= $_POST['data2'];
                     $data1= $_POST['data1'];
                     

                     $cmd = $conn->pdo->prepare("SELECT nome as Operador, vendaTotal, vendaDesconto, vendaCliente, pagamento, vendaTroco, vendaData FROM vendas v JOIN usuarios s 
                     ON v.fk_usuario_venda = s.id_usuario
                     JOIN tipopag t 
                     ON s.id_usuario = t.id_pag where vendaData between :d1 and :d2  ORDER BY id_venda DESC");
                     $cmd->bindValue(":d1",$data1);
                     $cmd->bindValue(":d2",$data2);
                     $cmd->execute();

                     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {

                       ?>
                       <tbody>
                         <tr style="color: #1363DF;">
                         <td><?php echo $res->Operador; ?></td>
                         <td><?php echo $res->vendaTotal; ?></td>
                         <td><?php echo $res->vendaDesconto; ?></td>
                         <td><?php echo $res->vendaCliente; ?></td>
                         <td><?php echo $res->pagamento; ?></td>
                         <td><?php echo $res->vendaTroco; ?></td>
                         <td><?php echo $res->vendaData; ?></td>
                         </tr>
                       </tbody>


                       <?php
                     }

                     $_SESSION['data1_hvenda'] = $data1;
                     $_SESSION['data2_hvenda'] = $data2;

                   }elseif(isset(($_POST['pesqAll']))){

                     //var_dump($_POST);

                     $pesqAll = $_POST['pesqAll'];

                     
                     $cmd = $conn->pdo->prepare("SELECT barcode, nomeProduto, estrada, qtdProduto as saida, qtdCompraProduto,
                     criandoProduto, dataExpProduto from estoque e JOIN produtos p 
                    ON e.fk_produto_estoque = p.id_produto where nomeProduto LIKE '%$pesqAll%' OR barcode = :barcode  OR 
                     estrada = :et  OR saida = :s");
                     $cmd->bindValue(":barcode", $pesqAll);
                     $cmd->bindValue(":et", $pesqAll);
                     $cmd->bindValue(":s", $pesqAll);
                     $cmd->execute();

                     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

                       ?>
                      <tbody>
                         <tr style="color: #1363DF;">
                         <td><?php echo $res['barcode']; ?></td>
                         <td><?php echo $res['nomeProduto']; ?></td>
                         <td><?php echo $res['estrada'];?></td>
                         <td><?php echo  $res['saida'];?></td>
                         <td><?php echo  $res['qtdCompraProduto'];?></td>
                         <td><?php echo  $res['criandoProduto'];?></td>
                         <td><?php echo  $res['dataExpProduto'];?></td>
                         </tr>
                       </tbody>

                       <?php
                     }


                   }else{

                     unset($_SESSION['data1_hvenda']);
                     unset($_SESSION['data2_hvenda']);

                     $cmd = $conn->pdo->query("SELECT id_estoque, barcode, nomeProduto, estrada,  qtdProduto as saida, qtdCompraProduto,
                     criandoProduto,  dataExpProduto from estoque e JOIN produtos p 
                    ON e.fk_produto_estoque = p.id_produto where   date(current_date())   > dataExpProduto ORDER BY id_estoque DESC" );
                    

                     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

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
                         <td><?php echo $res['nomeProduto']; ?></td>
                         <td><?php echo $res['estrada'];?></td>
                         <td><?php echo  $res['saida'];?></td>
                         <td><?php echo  $res['qtdCompraProduto'];?></td>
                         <td><?php echo  $res['criandoProduto'];?></td>
                         <td><?php echo  $res['dataExpProduto'];?></td>
                         </tr>
                       </tbody>


                       <?php
                     }

                      
                   }


                   ?>



               </table>

             </div>
       
     </div>
                    
                    
                    
                
                </div>  

     













                  </div>
                </div>
              </div>
          </div>



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    if (isset($_SESSION['sucesso_cadastro'])) {
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
            title: "Cadastrado com Sucesso",
          });
      });
      </script>
      ';
       unset($_SESSION['sucesso_cadastro']);
    }

     ?>

  <script>
  // SWEET ALERT DELETE
     $('.btn_sweet_del').on('click', function(e) {
       e.preventDefault();
       const href = $(this).attr('href');

       Swal.fire({
       title: 'Você tem certeza ?',
       text: 'Você não será capaz de reverter isso!',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Sim, deletar isso!'
     }).then((result) => {
         if (result.value) {
           document.location.href = href;
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
               title: "Deletado com Sucesso",
             });
         }
     })

     })
   </script>



    <script>
        $(document).ready(function() {
        $('#table_funcionario').DataTable({


          "language":{
        "decimal":        "",
        "emptyTable":     "Não a dados na tabela",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ ",
        "infoEmpty":      "Nenhum registro disponível",
        "infoFiltered":   "(Filtrado de _MAX_ entradas totais)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrar _MENU_ ",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Procurar:",
        "zeroRecords":    "Nenhum registro correspondente encontrado",
        "paginate": {
            "first":      "Primeiro",
            "last":       "Ultimo",
            "next":       "Próximo",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": ative para classificar a coluna em ordem crescente",
            "sortDescending": ": ativar para ordenar a coluna decrescente"
        }
    }

            });


    } );

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

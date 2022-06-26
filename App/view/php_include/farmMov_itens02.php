<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 8px;">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel">Produtos Mais Vendidos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">

      <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome do Produto</th>
              </tr>
            </thead>
            <tbody>
         <?php
                $cmd = $conn->pdo->query("SELECT  sum(fk_vendas_itens) as id, nomeProduto FROM itens_venda i JOIN produtos p 
                ON i.fk_produtos_itens = p.id_produto group by nomeProduto order by id desc;");     
                  while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

      ?>
      <tbody>
        <tr  style="color: #1363DF;">
        <td><?php echo $res['id']; ?></td>
        <td><?php echo $res['nomeProduto']; ?></td>
        
        </tr>
      </tbody>


      <?php
      } 
      ?>


            </tbody>
          </table>
      </div>

      <div class="modal-footer border-0">
        <a  class="btn btn-success" href="../model/AcessarProduto.php?report_itens_02">Relatório</a>
      </div>
    </div>
  </div>
</div>
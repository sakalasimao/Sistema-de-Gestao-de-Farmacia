<?php
ob_start();
include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_estoque_ja extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/GerEstoque.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Helena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório do Estoque de Produtos Já Expirados'),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
     $this->SetFont('Times','',12);
     $this->Cell(55,10,utf8_decode('Código'),1,0,'C');
     $this->Cell(50,10,'Nome',1,0,'C');
     $this->Cell(30,10,'Entrada',1,0,'C');
     $this->Cell(40,10,utf8_decode('Qtd'),1,0,'C');
     $this->Cell(40,10,utf8_decode('Quantidade de Compra'),1,0,'C');
     $this->Cell(35,10,'Data de Cadastro',1,0,'C');
     $this->Cell(35,10,'Data de Expiracao',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->query("SELECT id_estoque, barcode, nomeProduto, estrada,  qtdProduto as saida, qtdCompraProduto,
     criandoProduto,  dataExpProduto from estoque e JOIN produtos p 
    ON e.fk_produto_estoque = p.id_produto where   date(current_date())   > dataExpProduto ORDER BY id_estoque DESC");

     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {

      $barcode = $res['barcode'];
      if($barcode == ""){ $barcode = 'SEM CÓDIGO';}else { $barcode = $res['barcode']; }

       $this->Cell(55,10,utf8_decode($barcode),1,0,'L');
       $this->Cell(50,10,utf8_decode($res['nomeProduto']),1,0,'L');
       $this->Cell(30,10,utf8_decode($res['estrada']),1,0,'L');
       $this->Cell(40,10,utf8_decode($res['saida']),1,0,'L');
       $this->Cell(40,10,utf8_decode($res['qtdCompraProduto']),1,0,'L');
       $this->Cell(35,10,utf8_decode($res['criandoProduto']),1,0,'L');
       $this->Cell(35,10,utf8_decode($res['dataExpProduto']),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_estoque_ja;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório de Estoque - ').$datanome.'.pdf','I');
ob_end_flush();
 ?>

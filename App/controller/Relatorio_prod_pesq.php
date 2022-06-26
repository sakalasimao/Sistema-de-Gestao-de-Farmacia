<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_prod_pesq extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/GerProdRead.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório dos Produtos de Pesquisa Por: '.$_SESSION['pesq_report']),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
    
     $this->SetFont('Times','',12);
     $this->Cell(40,10,utf8_decode('Código'),1,0,'C');
     $this->Cell(50,10,'Produto',1,0,'C');
     $this->Cell(55,10,'Categoria',1,0,'C');
     $this->Cell(40,10,utf8_decode('Preço'),1,0,'C');
     $this->Cell(20,10,'Qtd',1,0,'C');
     $this->Cell(40,10,'Fabricante',1,0,'C');
     $this->Cell(40,10,utf8_decode('Data de Expiração'),1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
    $pesqAll = $_SESSION['pesq_report'];
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->prepare("SELECT  id_produto, barcode, nomeProduto, precoProduto, nomeCategoria, qtdProduto, nomeFabricante, dataExpProduto FROM produtos p  JOIN fabricante f
     ON p.fk_fabricante_produto = f.id_fabricante JOIN categoria c ON p.fk_categoria_produto = c.id_categoria WHERE 
                        barcode = :code OR nomeProduto LIKE '%$pesqAll%' OR nomeCategoria LIKE '%$pesqAll%'
                         OR precoProduto = :p  OR nomeFabricante LIKE '%$pesqAll%'");
     $cmd->bindValue(":code", $pesqAll);
     $cmd->bindValue(":p", $pesqAll);
    $cmd->execute();

     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {
      $barcode = $res['barcode'];
      if($barcode == ""){ $barcode = 'SEM CÓDIGO';}else { $barcode = $res['barcode']; }
      
       $this->Cell(40,10,utf8_decode($barcode),1,0,'L');
       $this->Cell(50,10,utf8_decode($res['nomeProduto']),1,0,'L');
       $this->Cell(55,10,utf8_decode($res['nomeCategoria']),1,0,'L');
       $this->Cell(40,10,utf8_decode($res['precoProduto']),1,0,'L');
       $this->Cell(20,10,utf8_decode($res['qtdProduto']),1,0,'L');
       $this->Cell(40,10,utf8_decode( substr($res['nomeFabricante'],0, 15) ).' ...',1,0,'L');
       $this->Cell(40,10,utf8_decode($res['dataExpProduto']),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_prod_pesq;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório dos Produtos - ').$datanome.'.pdf','I');


 ?>

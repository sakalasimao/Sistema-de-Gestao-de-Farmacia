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
class Relatorio_fab extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/GerFabRead.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório dos Fabricantes Cadastrados'),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
    
     $this->SetFont('Times','',12);
     $this->Cell(80,10,utf8_decode('Nome'),1,0,'C');
     $this->Cell(55,10,utf8_decode('Pais'),1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->query("SELECT id_fabricante, nomeFabricante, pais FROM fabricante; ORDER BY id_fabricante DESC");

     while ($res = $cmd->fetch(PDO::FETCH_ASSOC)) {
      
       $this->Cell(80,10,utf8_decode($res['nomeFabricante']),1,0,'L');
       $this->Cell(55,10,utf8_decode($res['pais']),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_fab;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório de Fabricantes - ').$datanome.'.pdf','I');
ob_end_flush();

 ?>

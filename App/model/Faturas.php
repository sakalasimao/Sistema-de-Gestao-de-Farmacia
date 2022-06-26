<?php
session_start();
include_once '../controller/Carrinho.php';
include_once '../controller/vendas.php';
include_once 'Connection.php';
require '../../Library/fpdf184/fpdf.php';
$cart = new Carrinho;
$sales = new Vendas;
$conn = new Connection;

/**
 *
 */
class PDF extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/nada.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('EMPLOYEE DOCUMENTS'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Street Address of Employee Office'),0,0,'C');
    $this->Ln(20);

  }

  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, 'Page'.$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){

     $this->SetFont('Times','',12);
     $this->Cell(20,10,'ID',1,0,'C');
     $this->Cell(40,10,'Name',1,0,'C');
     $this->Cell(40,10,'Position',1,0,'C');
     $this->Cell(60,10,'Office',1,0,'C');
     $this->Cell(36,10,'Age',1,0,'C');
     $this->Cell(30,10,'Start Date',1,0,'C');
     $this->Cell(50,10,'Salary',1,0,'C');
     $this->Ln();

   }

   // function viewTable($conn){
   //
   // }
}

$pdf = new PDF;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
// $pdf->viewTable($conn);
$pdf->Output();


 ?>

<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;


/**
 *
 */
class Relatorio_func_pesq extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/GerFuncRead.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(170,30, utf8_decode('Relatório dos Funcionarios Cadastrados Por Pesquisa: '.$_SESSION['pesq_report']),0,0,'C');
    $this->Ln(20);

  }


  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',9);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   function headerTable(){
     $this->Cell(30);
     $this->SetFont('Times','',12);
     $this->Cell(45,10,'Nome Completo',1,0,'C');
     $this->Cell(30,10,'Telefone',1,0,'C');
     $this->Cell(55,10,'E-mail',1,0,'C');
     $this->Cell(60,10,utf8_decode('Endereço'),1,0,'C');
     $this->Cell(50,10,'Cargo',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){
     $this->SetFont('Times','', 12);
     $pesqAll = $_SESSION['pesq_report'];
     $cmd = $conn->pdo->query("SELECT * FROM funcionarios WHERE 
     nomeFuncionario LIKE '%$pesqAll%' OR telefone LIKE '%$pesqAll%' OR emailFuncionario LIKE '%$pesqAll%' OR endereco LIKE '%$pesqAll%' OR cargo LIKE '%$pesqAll%' ");

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
        $this->Cell(30);
       $this->Cell(45,10,utf8_decode($res->nomeFuncionario),1,0,'L');
       $this->Cell(30,10,utf8_decode($res->telefone),1,0,'L');
       $this->Cell(55,10,utf8_decode($res->emailFuncionario),1,0,'L');
       $this->Cell(60,10,utf8_decode($res->endereco),1,0,'L');
       $this->Cell(50,10,utf8_decode($res->cargo),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_func_pesq;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório dos Funcionarios - ').$datanome.'.pdf','I');


 ?>

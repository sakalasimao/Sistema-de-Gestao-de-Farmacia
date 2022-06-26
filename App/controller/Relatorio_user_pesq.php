<?php

include_once 'usuario.php';
include_once '../model/Connection.php';
require '../../Library/fpdf184/fpdf.php';
$user = new Usuario;
$conn = new Connection;

/**
 *
 */
class Relatorio_user_pesq extends FPDF
{
  function header(){
    $this->Image('../view/images/logo-green.png',10,6,-600,0,'','http://localhost/SistemadeFarmacia/App/view/AdminUser.php');
    $this->SetFont('Arial','B',14);
    $this->Cell(276,5, utf8_decode('Farmácia Maria Filomena'),0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Cell(276,10, utf8_decode('Endereço: Sequele, Rua 01, Bloco 02'),0,0,'C');
    $this->Ln(5);
    $this->Cell(276,10, utf8_decode('NIF: 5416820451'),0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','B',13);
    $this->Cell(100,30, utf8_decode('Relatório dos Utilizadores Cadastrados Por: '. $_SESSION['pesq_report_pesq']),0,0,'C');
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
     $this->Cell(45,10,'Nome',1,0,'C');
     $this->Cell(40,10,'Nivel de Acesso',1,0,'C');
     $this->Cell(60,10,'E-,mail',1,0,'C');
     $this->Ln();

   }

   function viewTable($conn){

    $pesqAll = $_SESSION['pesq_report_pesq'];

     $this->SetFont('Times','', 12);
     $cmd = $conn->pdo->prepare("SELECT nome, nome_nivel, email FROM usuarios s JOIN nivel n ON  s.fk_acesso_usuario = n.id_nivel WHERE 
                        nome  LIKE '%$pesqAll%' OR nome_nivel LIKE '%$pesqAll%' OR email LIKE '%$pesqAll%'");
                        $cmd->execute();

     while ($res = $cmd->fetch(PDO::FETCH_OBJ)) {
        $this->Cell(30);
       $this->Cell(45,10,utf8_decode($res->nome),1,0,'L');
       $this->Cell(40,10,utf8_decode($res->nome_nivel),1,0,'L');
       $this->Cell(60,10,utf8_decode($res->email),1,0,'L');
       $this->Ln();
     }
   }
}

$pdf = new Relatorio_user_pesq;
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($conn);
$datanome = date('y/m/d');
$pdf->Output(utf8_decode('Relatório dos Utilizadores - ').$datanome.'.pdf','I');


 ?>

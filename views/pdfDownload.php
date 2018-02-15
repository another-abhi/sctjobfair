
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('fpdf.php');

session_start();

class PDF extends FPDF
{
  function Footer()
  {
      // Go to 1.5 cm from bottom
      $this->SetY(-15);
      // Select Arial italic 8
      $this->SetFont('Arial','I',8);
      // Print centered page number
      $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
  }
}

if( !isset($_SESSION["headers"]) ){
  //header("Location: index.php");
  //exit();
}

$headers = $_SESSION["headers"];
$data = $_SESSION["data"];
$count = $_SESSION["tableIndex"];
$condition = $_SESSION["condition"];
// $pdf = new PDF();
// $pdf->SetFont('Arial','',14);
// $pdf->AddPage();
// $pdf->BasicTable($headers,$data);
// $pdf->Output('D', "sample.pdf");

$n = 0;

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetFont('Arial','B',9);
$pdf->AddPage();
$pdf->Cell(100, 10, $condition);
$pdf->Ln();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,7,"PID",1);
$pdf->Cell(13,7,"STATUS",1);
$pdf->Cell(40,7,"NAME",1);
$pdf->Cell(25,7,"CONTACT",1);
$pdf->Cell(8,7,"SEX",1);
$pdf->Cell(9,7,"CNT",1);
$pdf->Cell(20,7,"UCOURSE",1);
$pdf->Cell(50,7,"COLLEGE",1);
$pdf->Cell(15,7,"BRANCH",1);
$pdf->Cell(10,7,"LOGS",1);
$pdf->Cell(80,7,"COMPANY",1);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
foreach($data as $key => $row ){
  $pdf->Cell(10,5,$row["pid"],1);
  $pdf->Cell(13,5,$row["paymentstatus"],1);
  $pdf->Cell(40,5,$row["fullname"],1);
  $pdf->Cell(25,5,$row["contact"],1);
  $pdf->Cell(8,5,$row["gender"],1);
  $pdf->Cell(9,5,$row["companycount"],1);
  $pdf->Cell(20,5,$row["ugcourse"],1);
  $pdf->Cell(50,5,substr($row["ugcollege"],0,25),1);
  $pdf->Cell(15,5,$row["ugbranch"],1);
  $pdf->Cell(10,5,$row["backlogs"],1);
  $pdf->Cell(80,5,$row["company"],1);
  $pdf->Ln();
  $n++;
  if($n == 31){
    $pdf->SetFont('Arial','B',9);
    $pdf->AddPage();
    $pdf->Cell(100, 10, $condition);
    $pdf->Ln();
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(10,7,"PID",1);
    $pdf->Cell(13,7,"STATUS",1);
    $pdf->Cell(40,7,"NAME",1);
    $pdf->Cell(25,7,"CONTACT",1);
    $pdf->Cell(8,7,"SEX",1);
    $pdf->Cell(9,7,"CNT",1);
    $pdf->Cell(20,7,"UCOURSE",1);
    $pdf->Cell(50,7,"COLLEGE",1);
    $pdf->Cell(15,7,"BRANCH",1);
    $pdf->Cell(10,7,"LOGS",1);
    $pdf->Cell(80,7,"COMPANY",1);
    $pdf->Ln();
    $pdf->SetFont('Arial','',8);
    $n = 0;
  }
}
$pdf->Output('I', "sample.pdf");
exit();
?>
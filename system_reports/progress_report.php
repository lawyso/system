<?php
include_once '../session.php';
include_once '../includes/conn.inc';
include_once '../includes/func.php';

include_once 'fpdf/fpdf.php';

class PDF extends FPDF
{
  /* Page header */
  function Header()
  {

    $this->SetFont('Arial', 'UB', 15);
    /* Move to the right */
    $this->Cell(50);

    $this->Cell(100, 10, 'UNIVERSITY DISSERTATION MANAGEMENT REPORT', 0, 0, 'C');
    $this->Ln();
    $this->Cell(200, 6, "Student Research Progress Report", 0, 0, 'C');
  }
  /* Page footer */
  function Footer()
  {
    /* Position at 1.5 cm from bottom */
    $this->SetY(-15);
    /* Arial italic 8 */
    $this->SetFont('Arial', 'I', 8);
    /* Page number */
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}
$pdf = new PDF('p', 'mm', 'Legal');
$title = 'Student Research Progress Report';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 40);
$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);

//set initial y axis position per page
$y_axis_initial = 26;

//print column titles
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetY($y_axis_initial);
$pdf->SetX(10);
$pdf->Cell(12, 6, 'S/N', 1, 0, 'L', 1);
$pdf->Cell(40, 6, 'Students Name', 1, 0, 'L', 1);
$pdf->Cell(46, 6, 'Supervised By', 1, 0, 'L', 1);
$pdf->Cell(80, 6, 'Research Topic', 1, 0, 'L', 1);
$pdf->Cell(22, 6, 'Status', 1, 0, 'L', 1);
//Set Row Height
$row_height = 6;

//Set new y_axis
$y_axis = $y_axis_initial + $row_height;

//Select the Products you want to show in your PDF file
$result = fetchtable('d_users_primary', "user_group='2' AND status='1'", "uid", "asc", "1000000", '*');

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

while ($row = mysqli_fetch_array($result)) {
  //If the current row is the last one, create new page and print column title
  if ($i == $max) {
    $pdf->AddPage();

    //print column titles for the current page
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetY($y_axis_initial);
    $pdf->SetX(10);
    $pdf->Cell(12, 6, 'S/N', 1, 0, 'L', 1);
    $pdf->Cell(40, 6, 'Students Name', 1, 0, 'L', 1);
    $pdf->Cell(46, 6, 'Supervised By', 1, 0, 'L', 1);
    $pdf->Cell(80, 6, 'Research Topic', 1, 0, 'L', 1);
    $pdf->Cell(22, 6, 'Status', 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis_initial + $row_height;

    //Set $i variable to 0 (first row)
    $i = 0;
  }

  $sup_id = profileName($row['supervisor_id']);
  $student_id = profileName($row['uid']);
  $topic_id = topic_name($row['topic_id']);
  $progress_id = research_progress($row['progress_stage']);
  $count++;
  $period = ".";
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis);
  $pdf->SetX(10);
  $pdf->MultiCell(12, 6, $count . $period, 1, 'L', 1);
  $pdf->SetXY(22, $y_axis);
  $pdf->MultiCell(40, 6, $student_id, 1, 'L', 1);
  $pdf->SetXY(62, $y_axis);
  $pdf->MultiCell(46, 6, $sup_id, 1, 'L', 1);
  $pdf->SetXY(108, $y_axis);
  $pdf->MultiCell(80, 6, $topic_id, 1, 'L', 1);
  $pdf->SetXY(188, $y_axis);
  $pdf->MultiCell(22, 6, $progress_id, 1, 'L', 1);

  //Go to next row
  $y_axis = $y_axis + $row_height;
  $i = $i + 1;
}

//Send file
$pdf->Output();

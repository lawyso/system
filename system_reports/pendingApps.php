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
    $this->Cell(200, 6, "Pending Approvals Report", 0, 0, 'C');
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
$title = 'Research Pending Approval Report';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 40);
$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);

//Select the Products you want to show in your PDF file
$result = fetchtable('d_topics', "status='0'", "topic_id", "asc", "1000000", '*');
$number_of_topics = mysqli_num_rows($result);

//Initialize the 3 columns and the total
$column_sn = "";
$column_name = "";
$column_topic = "";
$column_date = "";

//For each row, add the field to the corresponding column
while ($row = mysqli_fetch_array($result)) {
  $student_id = profileName($row['created_by']);
  $topic_id = $row['topic_id'];
  $topic_name = $row['topic_name'];
  $created_date = $row['created_date'];
  $count++;
  $period = ".";

  $column_sn = $column_sn . $count . "\n";
  $column_name = $column_name .  $student_id . "\n";
  $column_topic = $column_topic . $topic_name . "\n";
  $column_date = $column_date . $created_date . "\n";
}

//Fields Name position
$Y_Fields_Name_position = 26;
//Table position, under Fields Name
$Y_Table_Position = 32;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232, 232, 232);
//Bold Font for Field Name
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(10);
$pdf->Cell(10, 6, 'S/N', 1, 0, 'L', 0);
$pdf->SetX(20);
$pdf->Cell(50, 6, 'STUDENT NAME', 1, 0, 'L', 0);
$pdf->SetX(70);
$pdf->Cell(100, 6, 'Research Topic', 1, 0, 'L', 0);
$pdf->SetX(170);
$pdf->Cell(35, 6, 'Date Created', 1, 0, 'L', 0);
$pdf->Ln();

//Now show the 4 columns
$pdf->SetFont('Arial', '', 10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(10);
$pdf->MultiCell(10, 6, $column_sn, 1, 'L');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(50, 6, $column_name, 1, 'L');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(70);
$pdf->MultiCell(100, 6, $column_topic, 1, 'L', true);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->MultiCell(35, 6, $column_date, 1, 'L');

//Create lines (boxes) for each ROW Topic)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_topics) {
  $pdf->SetX(10);
  $pdf->MultiCell(195, 6, '', 1);
  $i = $i + 1;
}

//Send file
$pdf->Output();

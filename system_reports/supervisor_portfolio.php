<?php
include_once '../session.php';
include_once '../includes/conn.inc';
include_once '../includes/func.php';

//call main fpdf file
require('fpdf/fpdf.php');
//create new class extending fpdf class
class PDF_MC_Table extends FPDF
{
  // variable to store widths and aligns of cells, and line height
  var $widths;
  var $aligns;
  var $lineHeight;
  //Set the array of column widths
  function SetWidths($w)
  {
    $this->widths = $w;
  }
  //Set the array of column alignments
  function SetAligns($a)
  {
    $this->aligns = $a;
  }
  //Set line height
  function SetLineHeight($h)
  {
    $this->lineHeight = $h;
  }
  //Calculate the height of the row
  function Row($data)
  {
    // number of line
    $nb = 0;
    // loop each data to find out greatest line number in a row.
    for ($i = 0; $i < count($data); $i++) {
      // NbLines will calculate how many lines needed to display text wrapped in specified width.
      // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
      $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    }

    //multiply number of line with line height. This will be the height of current row
    $h = $this->lineHeight * $nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of current row
    for ($i = 0; $i < count($data); $i++) {
      // width of the current col
      $w = $this->widths[$i];
      // alignment of the current col. if unset, make it left.
      $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
      //Save the current position
      $x = $this->GetX();
      $y = $this->GetY();
      //Draw the border
      $this->Rect($x, $y, $w, $h);
      //Print the text
      $this->MultiCell($w, 5, $data[$i], 0, $a);
      //Put the position to the right of the cell
      $this->SetXY($x + $w, $y);
    }
    //Go to the next line
    $this->Ln($h);
  }
  function CheckPageBreak($h)
  {
    //If the height h would cause an overflow, add a new page immediately
    if ($this->GetY() + $h > $this->PageBreakTrigger)
      $this->AddPage($this->CurOrientation);
  }
  function NbLines($w, $txt)
  {
    //calculate the number of lines a MultiCell of width w will take
    $cw = &$this->CurrentFont['cw'];
    if ($w == 0)
      $w = $this->w - $this->rMargin - $this->x;
    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
    $s = str_replace("\r", '', $txt);
    $nb = strlen($s);
    if ($nb > 0 and $s[$nb - 1] == "\n")
      $nb--;
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $nl = 1;
    while ($i < $nb) {
      $c = $s[$i];
      if ($c == "\n") {
        $i++;
        $sep = -1;
        $j = $i;
        $l = 0;
        $nl++;
        continue;
      }
      if ($c == ' ')
        $sep = $i;
      $l += $cw[$c];
      if ($l > $wmax) {
        if ($sep == -1) {
          if ($i == $j)
            $i++;
        } else
          $i = $sep + 1;
        $sep = -1;
        $j = $i;
        $l = 0;
        $nl++;
      } else
        $i++;
    }
    return $nl;
  }
  /* Page header */
  function Header()
  {

    $this->SetFont('Arial', 'UB', 15);
    /* Move to the right */
    $this->Cell(50);

    $this->Cell(100, 10, 'UNIVERSITY DISSERTATION MANAGEMENT REPORT', 0, 0, 'C');
    $this->Ln();
    $this->Cell(200, 6, "Student Assigned Report", 0, 0, 'C');
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
$pdf = new PDF_MC_Table('p', 'mm', 'Legal');
$title = 'Student Assigned Report';
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 40);
$pdf->AddPage();
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 6, 'Supervisor Name:', 0, 'L');
$pdf->Cell(60, 6, profileName($myid), 0, 'L');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);

//set width for each column (6 columns)
$pdf->SetWidths(array(9, 40, 120, 25));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(6);

//set alignment
$pdf->SetAligns(array('L', 'L', 'L', 'L', 'L'));

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(9, 6, "S/N", 1, 0);
$pdf->Cell(40, 6, "Student Name", 1, 0);
$pdf->Cell(120, 6, "Research Topic", 1, 0);
$pdf->Cell(25, 6, "Status", 1, 0);
$count = 1;
//add a new line
$pdf->Ln();
//reset font
$pdf->SetFont('Arial', '', 10);

//Select the Products you want to show in your PDF file
$result = fetchtable('d_users_primary', "user_group='2' AND status='1' AND supervisor_id='$myid'", "uid", "asc", "1000000", '*');

//loop the data
foreach ($result as $item) {
  //write data using Row() method containing array of values.
  $pdf->Row(array(
    $count . '.',
    profileName($item['uid']),
    topic_name($item['topic_id']),
    research_progress($item['progress_stage']),
  ));
  $count++;
}

//Send file
$pdf->Output();

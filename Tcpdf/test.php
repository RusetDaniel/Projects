<?php


require_once "connect.php";

$A_nume = $A_adresa = $A_reprezentant = $A_functie = $A_telefon = $A_fax = $A_email = $A_www = "";
$B_nume = $B_adresa = $B_reprezentant = $B_functie = $B_numar = $B_cod = $B_telefon = $B_fax = $B_email = $B_www = "";
$C_nume = $C_nascut = $C_localitatea = $C_cetatenie = $C_card = $C_cnp = $C_inmtr = $C_an = $C_seria = $C_grupa = $C_telefon = $C_email = $C_domiciliu = $C_domiciliu2 = $C_pasaport = $C_permis_sedere = $C_ciclul = $C_domeniul = $C_specializarea = "";
$nr_ore = $start = $end = $interval_orar = "";
$D_nume = $D_functie = $D_telefon = $D_email = "";
$O_nume = $O_functie = "";


if (isset($_POST['submit'])) {

// 1
$A_nume = $_POST['A_nume'];
$A_adresa = $_POST['A_adresa'];
$A_reprezentant = $_POST['A_reprezentant'];
$A_functie = $_POST['A_functie'];
$A_telefon = $_POST['A_telefon'];
$A_fax = $_POST['A_fax'];
$A_email = $_POST['A_email'];
$A_www = $_POST['A_www'];
// 2
$B_nume = $_POST['B_nume'];
$B_adresa = $_POST['B_adresa'];
$B_numar = $_POST['B_numar'];
$B_cod = $_POST['B_cod'];
$B_reprezentant = $_POST['B_reprezentant'];
$B_functie = $_POST['B_functie'];
$B_telefon = $_POST['B_telefon'];
$B_fax = $_POST['B_fax'];
$B_email = $_POST['B_email'];
$B_www = $_POST['B_www'];
// 3
$C_nume = $_POST['C_nume'];
$C_nascut = $_POST['C_nascut'];
$C_localitatea = $_POST['C_localitatea'];
$C_cetatenie = $_POST['C_cetatenie'];
$C_card = $_POST['C_card'];
$C_cnp = $_POST['C_cnp'];
$C_inmtr = $_POST['C_inmtr'];
$C_an = $_POST['C_an'];
$C_seria = $_POST['C_seria'];
$C_grupa = $_POST['C_grupa'];
$C_telefon = $_POST['C_telefon'];
$C_email = $_POST['C_email'];
$C_domiciliu = $_POST['C_domiciliu'];
$C_domiciliu2 = $_POST['C_domiciliu'];
$C_pasaport = $_POST['C_pasaport'];
$C_permis_sedere = $_POST['C_permis_sedere'];
$C_ciclul = $_POST['C_ciclul'];
$C_domeniul = $_POST['C_domeniul'];
$C_specializarea = $_POST['C_specializarea'];

// 4
$nr_ore = $_POST['ore'];
$start = $_POST['start'];
$end = $_POST['end'];
$interval_orar = $_POST['interval_orar'];

// 5
$D_nume = $_POST['D_nume'];
$D_functie = $_POST['D_functie'];
$D_telefon = $_POST['D_telefon'];
$D_email = $_POST['D_email'];
// 6
$O_nume = $_POST['O_nume'];
$O_functie = $_POST['O_functie'];
/*
$sql = "INSERT INTO forms(A_nume,A_adresa,A_reprezentant,A_functie,A_telefon,A_fax,A_email,A_www,B_nume,
  B_adresa,B_reprezentant,B_functie,B_numar,B_cod,B_telefon,B_fax,B_email,B_www,C_nume,C_nascut,
  C_localitatea,C_cetatenie,C_card,C_cnp,C_inmtr,C_an,C_seria,C_grupa,C_telefon,C_email,C_domiciliu,C_domiciliu2,nr_ore,start,endd)
   VALUES('$A_nume','$A_adresa','$A_reprezentant','$A_functie','$A_telefon' ,'$A_fax','$A_email','$A_www',
   '$B_nume','$B_adresa','$B_reprezentant','$B_functie','$B_numar','$B_cod','$B_telefon','$B_fax','$B_email','$B_www',
   '$C_nume','$C_nascut','$C_localitatea','$C_cetatenie','$C_card', '$C_cnp','$C_inmtr','$C_an','$C_seria', '$C_grupa','$C_telefon','$C_email','$C_domiciliu','$C_domiciliu2',
   '$nr_ore','$start','$end') ";

   if ($link->query($sql) === TRUE) {
    } else {
    echo "Error: " . $sql . "<br>" . $link->error;
    }
    $link->close();
*/

include('library/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set font
$pdf->SetFont('times', '', 10);

// Conferinta-Cadru --------------------------------------------------------->
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CC/1.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(22, 103);
$text=$A_nume;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(22, 116);
$text=$A_adresa;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 123);
$text=$A_reprezentant;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 129);
$text=$A_functie;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 110);
$text=$A_telefon;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 116);
$text=$A_fax;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 122);
$text=$A_email;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 129);
$text=$A_www;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

// BBBBBBBBBB --------------------------------- BBBBBBBBBBBBB

$pdf->SetXY(22, 151);
$text=$B_nume;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(22, 164);
$text=$B_adresa;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(95, 170);
$text=$B_numar;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(95, 176);
$text=$B_cod;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 183);
$text=$B_reprezentant;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 189);
$text=$B_functie;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 170);
$text=$B_telefon;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 176);
$text=$B_fax;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 182);
$text=$B_email;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 189);
$text=$B_www;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');


// CCCCCCCCCC ----------------------------------CCCCCCCCCCCCCCCCCCCCC
$pdf->SetXY(22, 211);
$text=$C_nume;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(77, 218);
$text=$C_nascut;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(77, 224);
$text=$C_localitatea;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(77, 230);
$text=$C_cetatenie;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(77, 236);
$text=$C_card;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 211);
$text=$C_cnp;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 218);
$text=$C_inmtr;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 224);
$text=$C_an;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 230);
$text=$C_seria;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 236);
$text=$C_grupa;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 242);
$text=$C_telefon;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(149, 248);
$text=$C_email;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(22, 261);
$text=$C_domiciliu;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(22, 274);
$text=$C_domiciliu2;
$pdf->Cell(30, 0, $text, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');
// PAGE 2 -------------------------------------------------------------------- 2

$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CC/2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(80, 97);
$pdf->Cell(30, 0, $nr_ore, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(118, 104);
$pdf->Cell(30, 0, $start, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(172, 104);
$pdf->Cell(30, 0, $end, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');


// PAGE 3 -------------------------------------------------------------------- 3


$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CC/3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(35, 110);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(35, 117);
$pdf->Cell(30, 0, $B_functie, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(35, 124);
$pdf->Cell(30, 0, $B_telefon, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(124, 124);
$pdf->Cell(30, 0, $B_email, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

// ---

$pdf->SetXY(35, 140);
$pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(35, 147);
$pdf->Cell(30, 0, $D_functie, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(35, 154);
$pdf->Cell(30, 0, $D_telefon, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(124, 154);
$pdf->Cell(30, 0, $D_email, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');


// PAGE 4 -------------------------------------------------------------------- 4

$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CC/4.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(57, 75);
$pdf->Cell(30, 0, $O_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 81);
$pdf->Cell(30, 0, $O_functie.',', 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 103);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 109);
$pdf->Cell(30, 0, $B_functie.',', 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 131);
$pdf->Cell(30, 0, $C_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 168);
$pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 174);
$pdf->Cell(30, 0, $D_functie.',', 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 196);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(57, 202);
$pdf->Cell(30, 0, $B_functie.',', 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');
// <------------------------------------------------------------ Conferinta-Cadru

// Portofoliu-de-Practica ------------------------------------------------------------>

//Page 1
$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/PP/1.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(80, 76);
$pdf->Cell(30, 0, $nr_ore, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(80, 83);
$pdf->Cell(30, 0, $interval_orar, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(170, 76);
$pdf->Cell(30, 0, $start, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(170, 83);
$pdf->Cell(30, 0, $end, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(26, 96);
$pdf->Cell(30, 0, $B_adresa, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(26, 166);
$pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(116, 166);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

//Page 2
$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/PP/2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(62, 233);
$pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(62, 248);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(62, 263);
$pdf->Cell(30, 0, $C_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

// <------------------------------------------------------------Portofoliu-de-Practica


// Raport Saptamanal ---------------------------------------------------------------->
//Page 1

// GET DAYS
$begin=strtotime($start);
$end2=strtotime($end);
$week_number= 0;
$week_start="";
if($begin>$end2){
 echo "Invalid time interval! <br/>";
 return 0;
}else{
  $no_days=0;
  $weekends=0;
 while($begin<=$end2){
   $what_day=date("N",$begin);
    if($what_day>5) {
         $weekends++;
    }else{
      $no_days++;
      if ($week_start == "") {
        $week_start = date('Y-m-d',$begin);
      }
    }

    if ($no_days == 5) {
      $no_days = 0;
      $week_number++;
      $week_end = date('Y-m-d', $begin);

      $pdf->AddPage();

      // get the current page break margin
      $bMargin = $pdf->getBreakMargin();
      // get current auto-page-break mode
      $auto_page_break = $pdf->getAutoPageBreak();
      // disable auto-page-break
      $pdf->SetAutoPageBreak(false, 0);
      // set bacground image
      $img_file = 'Pages/FES/1.jpg';
      $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

      $pdf->SetXY(42, 93);
      $pdf->Cell(30, 0, $C_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(170, 93);
      $pdf->Cell(30, 0, $week_number, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(80, 100);
      $pdf->Cell(30, 0, $nr_ore, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(80, 107);
      $pdf->Cell(30, 0, $interval_orar, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(170, 100);
      $pdf->Cell(30, 0, $week_start, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(170, 107);
      $pdf->Cell(30, 0, $week_end, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(26, 120);
      $pdf->Cell(30, 0, $B_adresa, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');


      //Page 2
      $pdf->AddPage();

      // get the current page break margin
      $bMargin = $pdf->getBreakMargin();
      // get current auto-page-break mode
      $auto_page_break = $pdf->getAutoPageBreak();
      // disable auto-page-break
      $pdf->SetAutoPageBreak(false, 0);
      // set bacground image
      $img_file = 'Pages/FES/2.jpg';
      $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

      $pdf->SetXY(57, 112);
      $pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $pdf->SetXY(57, 124);
      $pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

      $week_start = "";
    }
   $begin+=86400;
 };
}

//  <---------------------------------------------------------------- Raport Saptamanal


// Raport Final ---------------------------------------------------------------->
//Page 1

$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/RE/1.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(42, 106);
$pdf->Cell(30, 0, $C_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');


$pdf->SetXY(80, 113);
$pdf->Cell(30, 0, $nr_ore, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(80, 120);
$pdf->Cell(30, 0, $interval_orar, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(170, 113);
$pdf->Cell(30, 0, $start, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(170, 120);
$pdf->Cell(30, 0, $end, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(26, 133);
$pdf->Cell(30, 0, $B_adresa, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

//Page 2
$pdf->AddPage();

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/RE/2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(62, 163);
$pdf->Cell(30, 0, $D_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(62, 178);
$pdf->Cell(30, 0, $B_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

// <---------------------------------------------------------------- Raport Final

// Caiet de practica ---------------------------------------------------------------->

$pdf->SetFont('times', '', 12);

//PAGE 1
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/1.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(90, 195);
$pdf->Cell(30, 0, $C_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 203);
$pdf->Cell(30, 0, $C_ciclul, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 212);
$pdf->Cell(30, 0, $C_domeniul, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 220);
$pdf->Cell(30, 0, $C_specializarea, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 228);
$pdf->Cell(30, 0, $C_an, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 236);
$pdf->Cell(30, 0, $start." - ".$end, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 244);
$pdf->Cell(30, 0, $B_nume, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(90, 252);
$pdf->Cell(30, 0, $B_reprezentant, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

//PAGE 2
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/2.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 3
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/3.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 4
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/4.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 5
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/5.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 6
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/6.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

$pdf->SetXY(65, 68);
$pdf->Cell(30, 0, $start, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

$pdf->SetXY(145, 68);
$pdf->Cell(30, 0, $interval_orar, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

//PAGE 7

$begin=strtotime($start);
$begin+=86400;
$end2=strtotime($end);
if($begin>$end2){
 echo "Invalid time interval! <br/>";
 return 0;
}else{
  $weekends=0;
 while($begin<=$end2){
   $what_day=date("N",$begin);
    if($what_day>5) {
         $weekends++;
    }else{
        $current_date = date('Y-m-d',$begin);

        $pdf->AddPage();
        // get the current page break margin
        $bMargin = $pdf->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
        // disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = 'Pages/CP/7.jpg';
        $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

        $pdf->SetXY(65, 66);
        $pdf->Cell(30, 0, $current_date, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');

        $pdf->SetXY(145, 66);
        $pdf->Cell(30, 0, $interval_orar, 0, $ln=0, 'L', 0, '', 0, false, 'B', 'B');
    }
    $begin+=86400;
  }
}


//PAGE 8
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/8.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 9
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/9.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 10
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/10.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//PAGE 11
$pdf->AddPage();
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'Pages/CP/11.jpg';
$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// <---------------------------------------------------------------- Caiet de practica

$pdf->Output('formulare.practică', 'I');

}







 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      <?php include 'Style.css'; ?>
    </style>
  </head>
  <body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="boxes">
      <p>1 &nbsp; &nbsp; Organizator de practică: </p>
      <input type="text" name="A_nume" value="<?php echo $A_nume; ?>" style=" width:850px;"><hr>
      <div class="contact">
        <label>Telefon:</label><br>
        <input type="text" name="A_telefon" value="<?php echo $A_telefon; ?>"><br>
        <label>Fax: </label><br>
        <input type="text" name="A_fax" value="<?php echo $A_fax; ?>"><br>
        <label>E-Mail: </label><br>
        <input type="email" name="A_email" value="<?php echo $A_email; ?>"><br>
        <label>www: </label><br>
        <input type="text" name="A_www" value="<?php echo $A_www; ?>"><br>
      </div>
      <label>cu sediul social în:</label><br>
      <input type="text" name="A_adresa" value="<?php echo $A_adresa; ?>" style=" width:350px;"><br>
      <label>Reprezentată de către:</label><br>
      <input type="text" name="A_reprezentant" value="<?php echo $A_reprezentant; ?>" style=" width:250px;"><br>
      <label>În calitate de:</label><br>
      <input type="text" name="A_functie" value="<?php echo $A_functie; ?>" style=" width:250px;"><br>
    </div>


    <div class="boxes">
      <p>2 &nbsp; &nbsp; Societatea comercială, instituția centrală/locală, persoana juridică (denumită <b> partener de practică</b>):</p><hr>
      <div class="contact">
        <label>Telefon:</label><br>
        <input type="text" name="B_telefon" value="<?php echo $B_telefon; ?>"><br>
        <label>Fax: </label><br>
        <input type="text" name="B_fax" value="<?php echo $B_fax; ?>"><br>
        <label>E-Mail: </label><br>
        <input type="email" name="B_email" value="<?php echo $B_email; ?>"><br>
        <label>www: </label><br>
        <input type="text" name="B_www" value="<?php echo $B_www; ?>"><br>
      </div>
      <input type="text" name="B_nume" value="<?php echo $B_nume; ?>" style=" width:500px;"><br>
      <label>cu sediul social în:</label><br>
      <input type="text" name="B_adresa" value="<?php echo $B_adresa; ?>" style=" width:350px;"><br>
      <label>înregistrată la Registrul Comerțului sub numărul:</label><br>
      <input type="text" name="B_numar" value="<?php echo $B_numar; ?>" style=" width:250px;"><br>
      <label>și având codul unic de înregistrare:</label><br>
      <input type="text" name="B_cod" value="<?php echo $B_cod; ?>" style=" width:250px;"><br>
      <label>Reprezentată de către:</label><br>
      <input type="text" name="B_reprezentant" value="<?php echo $B_reprezentant; ?>" style=" width:250px;"><br>
      <label>În calitate de:</label><br>
      <input type="text" name="B_functie" value="<?php echo $B_functie; ?>" style=" width:250px;"><br>
    </div>


    <div class="boxes">
      <p>3 &nbsp; &nbsp; Student al Facultății de Științe, Departament Informatica (denumit în continuare <b>practicant</b>):</p> <hr>
      <div class="contact">
        <label>CNP:</label><br>
        <input type="text" name="C_cnp" value="<?php echo $C_cnp; ?>"><br>
        <label>Înmatriculat în anul:</label><br>
        <input type="text" name="C_inmtr" value="<?php echo $C_inmtr; ?>"><br>
        <label>Anul de studiu:</label><br>
        <input type="text" name="C_an" value="<?php echo $C_an; ?>"><br>
        <label>Seria:</label><br>
        <input type="text" name="C_seria" value="<?php echo $C_seria; ?>"><br>
        <label>Grupa:</label><br>
        <input type="text" name="C_grupa" value="<?php echo $C_grupa; ?>"><br>
        <label>Telefon:</label><br>
        <input type="text" name="C_telefon" value="<?php echo $C_telefon; ?>"><br>
        <label>E-Mail: </label><br>
        <input type="email" name="C_email" value="<?php echo $C_email; ?>"><br>
      </div>
      <input type="text" name="C_nume" value="<?php echo $C_nume; ?>" style=" width:500px;"><br>
      <label>Născut(ă) la data:</label><br>
      <input type="date" name="C_nascut" value="<?php echo $C_nascut; ?>"><br>
      <label>În localitatea:</label><br>
      <input type="text" name="C_localitatea" value="<?php echo $C_localitatea; ?>"><br>
      <label>Cetățenie:</label><br>
      <input type="text" name="C_cetatenie" value="<?php echo $C_cetatenie; ?>"><br>
      <label>Card de identitate (dacă este cazul):</label><br>
      <input type="text" name="C_card" value="<?php echo $C_card; ?>"><br>
      <label>Pașaport (dacă este cazul):</label><br>
      <input type="text" name="C_pasaport" value="<?php echo $C_pasaport; ?>"><br>
      <label>Permis de ședere (dacă este cazul):</label><br>
      <input type="text" name="C_permis_sedere" value="<?php echo $C_permis_sedere; ?>"><br>
      <label>Ciclul de studii:</label><br>
      <input type="text" name="C_ciclul" value="<?php echo $C_ciclul; ?>"><br>
      <label>Domeniul:</label><br>
      <input type="text" name="C_domeniul" value="<?php echo $C_domeniul; ?>"><br>
      <label>Specializarea:</label><br>
      <input type="text" name="C_specializarea" value="<?php echo $C_specializarea; ?>"><br>


      <div class="dom">
        <hr>
        <label>Adresa de domiciliu:</label><br>
        <input type="text" name="C_domiciliu" value="<?php echo $C_domiciliu; ?>" style=" width:500px;"><hr>
        <label>Adresa unde va locui pe durata desfășurării stagiului de practică:</label><br>
        <input type="text" name="C_domiciliu2" value="<?php echo $C_domiciliu2; ?>" style=" width:500px;"><br>
      </div>
    </div>


    <div class="boxes">
      <p>(1) Stagiul de practică va avea durata de <input type="text" name="ore" value="<?php echo $nr_ore; ?>"> de ore.</p> <hr>
      <p> (2) Perioada desfășurării stagiului de practică este de la (ZZ.LL.AAAA) <input type="date" name="start" value="<?php echo $start; ?>"> până la (ZZ.LL.AAAA) <input type="date" name="end" value="<?php echo $end; ?>"></p>
      <p>(3) Intervalul orar zilnic (Luni - Vineri) <input type="text" name="interval_orar" value="<?php echo $interval_orar; ?>" placeholder="00:00 - 00:00"> </p>
    </div>

    <div class="boxes">
      <h3>Expert stagii de practică:</h3>
      <label>Dl./Dna.:</label><br>
      <input type="text" name="D_nume" value="<?php echo $D_nume; ?>"><br>

      <label>Funcția:</label><br>
      <input type="text" name="D_functie" value="<?php echo $D_functie; ?>"><br>

      <label>Telefon:</label><br>
      <input type="text" name="D_telefon" value="<?php echo $D_telefon ?>"><br>

      <label>E-Mail:</label><br>
      <input type="text" name="D_email" value="<?php echo $D_email; ?>"><br>
    </div>
    <div class="boxes">
      <h3>Organizator de practica</h3>
      <label>Nume:</label><br>
      <input type="text" name="O_nume" value="<?php echo $O_nume; ?>"><br>

      <label>Functie:</label><br>
      <input type="text" name="O_functie" value="<?php echo $O_functie; ?>"><br>
    </div>

    <input type="submit" name="submit" value="Submit">
</form>


  </body>
</html>

<?php
session_start();
?>
<?php
require('fpdf182/fpdf.php');
require_once "pdo.php";
$failure = false;
$success = false;
$recipi=$_GET['recipi'];

if (!isset($_SESSION['email']))
{
    die("Not logged in");
}
elseif (isset($_POST['logout']) && $_POST['logout'] == 'Logout')
{
    header('Location: logout.php');
}
$header = $pdo->query("SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='recipi' 
    AND `TABLE_NAME`='recipies'");
$stmt = $pdo->query("SELECT category,recipi,ingrediants,steps,foodfile,tips FROM recipies where recipi='$recipi'");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
class PDF extends FPDF
{
function Header()
{
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Cell(43,15,'The Recipi Book',1,0);
    $this->Ln(20);
}
function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

foreach($rows as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(0,10,$column,0,1);
        $pdf->Image('image/'.$row['foodfile'].'',100,50,80,50,'JPG');
}
$pdf->Output();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="cards.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php require_once "bootstrap.php"; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <title>my reciepies</title>
</head>
<body class="body">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<div class="container">
    <h1 class="text-dark"></h1>
    <?php
    if (isset($_SESSION['error']))
    {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
</div>
</body>

<?php

session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

require '../assets/PDF/fpdf.php';
$userid=$_SESSION['userid'];



$sqlcart="SELECT c.cartId as cid, c.tablouId, c.materialId, c.dimensiuneId, c.ramaId, c.qty, c.pret_qty1,
 u.userName, u.userEmail, u.userPhone, u.userCity, u.userAddress
  FROM cart c, users u
 WHERE c.userId='$userid' AND c.userId=u.userId";

$sql_runcart=mysqli_query($connection, $sqlcart);


// get facturaAID
$sqlAID="SELECT MAX(facturaAID) as AID FROM comanda";

$sql_runAID=mysqli_query($connection, $sqlAID);
if(mysqli_num_rows($sql_runAID)>0){
    foreach($sql_runAID as $obiectAID){
        $AID=$obiectAID['AID'];
        $AID=$AID+1;
}

}
else{
    $AID=1;
}

foreach($sql_runcart as $obiect){
    if(($obiect['userName'])!=NULL AND ($obiect['userPhone'])!=NULL AND ($obiect['userEmail'])!=NULL AND ($obiect['userCity'])!=NULL 
AND ($obiect['userAddress'])!=NULL)
{

$userName=$obiect['userName'];
$userEmail=$obiect['userEmail'];
$userCity=$obiect['userCity'];
$userAddress=$obiect['userAddress'];
$pretTablou=sprintf('%.0F',($obiect['qty']*$obiect['pret_qty1']));

    $sql="INSERT INTO comanda (userId, tablouId, materialId, dimensiuneId, ramaId, qty,
    pret_qty1, userName, userEmail, userPhone, userCity, userAddress, PretComanda, facturaAID) VALUES 
    ('$userid', ".$obiect['tablouId'].",".$obiect['materialId'].",".$obiect['dimensiuneId'].",
    ".$obiect['ramaId'].",".$obiect['qty'].", ".$obiect['pret_qty1'].", '$userName','$userEmail',".$obiect['userPhone'].",
    '$userCity','$userAddress', '$pretTablou','$AID')";
     $sql_run=mysqli_query($connection, $sql);
    }
    else{
        header("location: ../profile_update.php?error=emptyData");
        exit();
    }    
}

if($sql_run){
   
    $sqldelete="DELETE FROM cart WHERE userId='$userid'";
    $sql_rundelete=mysqli_query($connection, $sqldelete);
    if($sql_rundelete){



        $sqlcomanda="SELECT c.comandaId as cid, c.userId, c.tablouId, c.materialId, c.dimensiuneId, c.ramaId, c.qty, c.pretComanda,
        c.dateComanda, c.facturaAID, c.pret_qty1,
        t.tablouId, t.tablouName,
        u.userName, u.userEmail, u.userPhone, u.userCity, u.userAddress,
        m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName
         FROM comanda c, users u, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r
        WHERE c.userId='$userid' AND c.userId=u.userId AND c.materialId=m.materialId AND 
        c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND c.tablouId=t.tablouId
        
        AND c.facturaAID='$AID'
        ORDER BY c.comandaId DESC

  ";
    //    AND TIME_FORMAT(c.dateComanda,'%H:%i')=(SELECT MAX(TIME_FORMAT(dateComanda,'%H:%i')) FROM comanda)
       $sql_runcomanda=mysqli_query($connection, $sqlcomanda);

    foreach($sql_runcomanda as $obiect){
$userName=$obiect['userName'];
$userCity=$obiect['userCity'];
$userAddress=$obiect['userAddress'];
$dateoriginal=$obiect['dateComanda'];
$IDfactura="COM".$AID;
     }
     $date=str_replace(':', '-', $dateoriginal);
    $date2=substr_replace($date ,"", -9);
    $adresa=$userAddress.' '.$userCity;
/*A4 width : 219mm*/

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Factura',0,0);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(71 ,5,'Furnizor',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,5,'Cumparator',0,1);

$pdf->SetFont('Arial','',10);

$pdf->Cell(130 ,5,'AME DESIGN 2000 SRL',0,0);
$pdf->Cell(25 ,5,$userName,0,0);
$pdf->Cell(34 ,5,'',0,1);

$pdf->Cell(130 ,5,'Str Dezrobirii 123 Sector 6 Bucuresti',0,0);
$pdf->Cell(25 ,5,$adresa,0,0);
$pdf->Cell(34 ,5,'',0,1);

 
$pdf->Cell(130 ,5,'Telefon: 0728874482',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'',0,0);
$pdf->Cell(34 ,5,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(75 ,5,'',0,0);
$pdf->Cell(75 ,5,'Detalii',0,0);
$pdf->Cell(75 ,5,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(75 ,5,'',0,0);
$pdf->Cell(75 ,5,'Id factura: '.$IDfactura,0,0);
$pdf->Cell(75 ,5,'',0,1);

$pdf->Cell(75 ,5,'',0,0);
$pdf->Cell(75 ,5,'Data: '.$date2,0,0);
$pdf->Cell(75 ,5,'',0,1);

$pdf->Cell(75 ,5,'',0,0);
$pdf->Cell(75 ,5,'TVA: 19%',0,0);
$pdf->Cell(75 ,5,'',0,1);

$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(60 ,6,'Denumire imagine',1,0,'C');
$pdf->Cell(10 ,6,'U.M.',1,0,'C');
$pdf->Cell(17 ,6,'Cantitate',1,0,'C');
$pdf->Cell(15 ,6,'Pret/buc',1,0,'C');
$pdf->Cell(10 ,6,'TVA',1,0,'C');
$pdf->Cell(30 ,6,'Material',1,0,'C');
$pdf->Cell(25 ,6,'Dimensiune',1,0,'C');
$pdf->Cell(17 ,6,'Tip rama',1,0,'C');
$pdf->Cell(15 ,6,'Subtotal',1,1,'C');

$pdf->SetFont('Arial','',10);
$total=0;
foreach($sql_runcomanda as $obiect){
    

        
        $pdf->Cell(60 ,6,$obiect['tablouName'],1,0,'C');
        $pdf->Cell(10 ,6,'buc',1,0,'C');
        $pdf->Cell(17 ,6,$obiect['qty'],1,0,'C');  
       $pdf->Cell(15 ,6,$obiect['pret_qty1'],1,0,'C');
       $pdf->Cell(10,6,($obiect['pret_qty1']*0.19),1,0,'C');
        $pdf->Cell(30 ,6,$obiect['materialName'],1,0,'C');
        $pdf->Cell(25 ,6,$obiect['dimensiuneName'],1,0,'C');
        $pdf->Cell(17 ,6,$obiect['ramaName'],1,0,'C');
        $pdf->Cell(15 ,6,$obiect['pretComanda'],1,1,'C');

$total=$obiect['pretComanda']+$total;
}
 
		

$pdf->Cell(118 ,6,'',0,0);
$pdf->Cell(30 ,6,'Total',0,0);
$pdf->Cell(45 ,6,$total,1,1,'R');


$pdf->Output("F",'../uploads/Invoice/'.$userName.' '.$date.'.pdf');


$pdfname=$userName.' '.$date.'.pdf';

$sqlpdf="UPDATE comanda SET facturaComanda='$pdfname'
WHERE userId='$userid' AND facturaAID='$AID'";
$sql_runpdf=mysqli_query($connection, $sqlpdf);


        header("location: ../cart.php?error=none");
        exit();
    }
    else{
        header("location: ../cart.php?error=sqldelete");
        exit();
    }
}
else{
    header("location: ../cart.php?error=sql?$getName");
    exit();
}






<?php
session_start();
include_once('../INC/dbh.inc.php');
include_once('../INC/functions.inc.php');




if($_SESSION['isadmin']=="admin")
{
if(isset($_GET['id']))
{
    $id=$_GET['id'];

$sql="SELECT facturaAID, comandaFinalizata FROM comanda
WHERE facturaAID='$id'";

$sql_run=mysqli_query($connection,$sql);


foreach($sql_run as $obiect){

    if($obiect['comandaFinalizata']=="Nu"){
        $sql="UPDATE comanda 
        SET comandaFinalizata= 'Da'
        WHERE facturaAID='$id'";
        $sql_run=mysqli_query($connection,$sql);

    }
    else
    {
        $sql="UPDATE comanda 
        SET comandaFinalizata= 'Nu'
        WHERE facturaAID='$id'";
        $sql_run=mysqli_query($connection,$sql);
  
    }


}
header("location: ../detalii_raport_comenzi.php?facturaAID=".$id);
exit();
   

}
else{
    header("location: ../raport_comenzi.php");
exit();
}
}
else{
    header("location: ../index.php");
    exit();
}
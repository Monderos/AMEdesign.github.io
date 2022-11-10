<?php
if(isset($_GET["id"])){

$idcart=$_GET["id"];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';


$sql="DELETE FROM cart WHERE cartId='$idcart'";
$sql_run=mysqli_query($connection,$sql);
if($sql_run){
    header("location: ../cart.php");
exit();
}
else{
    header("location: ../error.php");
    exit();
}

}







else{

    header("location: ../cart.php");
    exit();
}
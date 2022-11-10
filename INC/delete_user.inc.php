<?php
session_start();
if($_SESSION['isadmin'])
{
if(isset($_GET["id"])){

$id=$_GET["id"];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';


$sql="DELETE FROM users WHERE userId='$id'";
$sql_run=mysqli_query($connection,$sql);
if($sql_run){
    header("location: ../raport_users.php");
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
}
else{
    header("location: ../index.php");
    exit();
}
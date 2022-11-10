<?php
session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';
if(isset($_SESSION['auth'])){
    
$scope=$_POST['scope'];

    switch($scope){
        case "add":
            $tablouId=$_POST['tablouId'];
            $materialId=$_POST['materialId'];
            $dimensiuneId=$_POST['dimensiuneId'];
            $ramaId=$_POST['ramaId'];
            $qty=$_POST['qty'];
$pret_qty1=$_POST['pret_qty1'];
            $userId=$_SESSION['userid'];


            $tabluExists="SELECT * FROM cart WHERE tablouId='$tablouId' AND materialId='$materialId' AND dimensiuneId='$dimensiuneId'
            AND ramaId='$ramaId' AND userId='$userId'";
            $tablouExists_run=mysqli_query($connection,$tabluExists);
            if(mysqli_num_rows($tablouExists_run)>0){

                echo 2;
            }
            else{
                
            $sql="INSERT INTO cart (userId, tablouId, materialId, dimensiuneId, ramaId, qty, pret_qty1) VALUES ('$userId','$tablouId',
            '$materialId', '$dimensiuneId', '$ramaId', '$qty', '$pret_qty1')";
            $sql_run=mysqli_query($connection,$sql);

            if($sql_run){
                echo 3;
            }
            else{
                echo 1;
            }
            }

            break;
            default:
            echo 1;

    }

    }

else
{
    echo 0;
}
?>
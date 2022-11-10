<?php
include_once('../INC/dbh.inc.php');
include_once('../INC/functions.inc.php');



if(isset($_POST['trash_categorie'])){

$categId=mysqli_real_escape_string($connection, $_POST['categId']);
$sql="SELECT * FROM tablou_categorie WHERE categId='$categId'";
$sql_run = mysqli_query($connection, $sql);
$sql_data=mysqli_fetch_array($sql_run);


  //stergere din tabela tablou
  $trash= "DELETE FROM tablou_categorie WHERE categId='$categId'";
  $trash_run=mysqli_query($connection,$trash);


//stergere tabela tablousicagtegorie
  $trash= "DELETE FROM tablousicategorie WHERE categId='$categId'";
  $trash_run=mysqli_query($connection,$trash);

}

else if(isset($_POST['trash_tablou'])){


    


    //functie pt gasirea imaginilor asociate tabloului
    $tablouId=mysqli_real_escape_string($connection, $_POST['tablouId']);
    $sql="SELECT * FROM tablou WHERE tablouId='$tablouId'";
    $sql_run = mysqli_query($connection, $sql);
    $sql_data=mysqli_fetch_array($sql_run);
    $imagine=$sql_data['tablouImage'];
    $imagine2=$sql_data['tablouImage2'];
    $imagine3=$sql_data['tablouImage3'];
    $imagine4=$sql_data['tablouImage4'];
    $imagine5=$sql_data['tablouImage5'];
    $imagine6=$sql_data['tablouImage6'];

    //stergere din tabela tablou
    $trash= "DELETE FROM tablou WHERE tablouId='$tablouId'";
    $trash_run=mysqli_query($connection,$trash);


//stergere tabela tablousicagtegorie
    $trash= "DELETE FROM tablousicategorie WHERE tablouId='$tablouId'";
    $trash_run=mysqli_query($connection,$trash);

if($trash_run){
    unlink("../uploads/".$imagine);
    unlink("../uploads/".$imagine2);
    unlink("../uploads/".$imagine3);
    unlink("../uploads/".$imagine4);
    unlink("../uploads/".$imagine5);
    unlink("../uploads/".$imagine6);
}
   

}


else{
    header("location: ../index.php");
    exit();
}
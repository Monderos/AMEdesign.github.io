<?php
if(isset($_POST["submit"])){

$categorie=$_POST["categorie"];
$id=$_POST['submit'];
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(categExists($connection, $categorie) !==false){
    
    header("location: ../editare_categorie.php?error=categorietaken&id=$id");
    exit();
}
else if((empty($_POST['categorie']))){
    header("location: ../editare_categorie.php?error=noinput&id=$id");
    exit();
}
    else{
        updateCategorie($connection, $categorie, $id);
    }      

}







else{

    header("location: ../editare_stergere_categorie.php");
    exit();
}
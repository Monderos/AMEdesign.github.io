<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';
//verificare daca datele au fost prin butonul submit
if(isset($_POST['submit']))
{
    $tip=$_POST['tip'];
}


//error handler
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);

//iserare pt tablouri
if(($tip=="inserare_tablouri.php") && (!empty($_FILES['imagine']['name']))
&& (!empty($_FILES['imagine2']['name']))
&& (!empty($_FILES['imagine3']['name']))
&& (!empty($_FILES['imagine4']['name']))
&& (!empty($_FILES['imagine5']['name']))
&& (!empty($_FILES['imagine6']['name']))
&& (!empty($_POST['titlu'])))
{
    $tip=$_POST['tip'];
$imagine=$_FILES['imagine']['name'];
$imagine2=$_FILES['imagine2']['name'];
$imagine3=$_FILES['imagine3']['name'];
$imagine4=$_FILES['imagine4']['name'];
$imagine5=$_FILES['imagine5']['name'];
$imagine6=$_FILES['imagine6']['name'];
$titlu=$_POST['titlu'];
$descriere=$_POST['descriere'];
$autor=$_POST['autor'];
$adaos=$_POST['adaos'];





//string de categorii
$categ=NULL;
$categorie=getAll($connection, "tablou_categorie"); 
if(mysqli_num_rows($categorie)>0){
  foreach($categorie as $obiect){
if($obiect['categId']==$_POST[$obiect['categId']]){
    $categ=$categ.",".$obiect['categId'];
    
}
    
}
}
$categ=ltrim($categ, ",");


//upload imagini

$path="../uploads";



$imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
$filename=$imagine."1".time().'.'.$imagine_e;

$imagine_e2=pathinfo($imagine2, PATHINFO_EXTENSION);
$filename2=$imagine2."2".time().'.'.$imagine_e2;

$imagine_e3=pathinfo($imagine3, PATHINFO_EXTENSION);
$filename3=$imagine3.time()."3".'.'.$imagine_e3;

$imagine_e4=pathinfo($imagine4, PATHINFO_EXTENSION);
$filename4=$imagine4.time()."4".'.'.$imagine_e4;

$imagine_e5=pathinfo($imagine5, PATHINFO_EXTENSION);
$filename5=$imagine5.time()."5".'.'.$imagine_e5;

$imagine_e6=pathinfo($imagine6, PATHINFO_EXTENSION);
$filename6=$imagine6.time()."6".'.'.$imagine_e6;


insertTablou($connection, $path, $filename,$titlu, $descriere, $adaos,$filename2,$filename3, $filename4,$filename5,$filename6, $autor, $categ);

//inserare in tablouandcategorie
$idProdus=$connection-> insert_id;

$categorie2=getAll($connection, "tablou_categorie");
foreach($categorie2 as $obiect){
    if($obiect['categId']==$_POST[$obiect['categId']]){
        $idCateg=$obiect['categId'];       
        insertTablouAndCategorie($connection,$idCateg,$idProdus);
    }
}  

}





else if($tip=="inserare_categorii.php" && (!empty($_POST['categorie']))){
    $numeCateg=$_POST['categorie'];

    //verificare daca exista categoria
    if(categExists($connection, $numeCateg) !==false){
        header("location: ../inserare_categorii.php?error=categorietaken");
        exit();
    }
        else{
            insertCateg($connection, $numeCateg);
        }      
    
}

else
{
    
    header("location: ../" .$tip."?error=noinput");
    exit();
}



<?php
if(isset($_POST["submit"])){

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

//error handler
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);

$idProdus=$_POST['submit'];
$titlu=$_POST['titlu'];
$descriere=$_POST['descriere'];
$autor=$_POST['autor'];
$adaos=$_POST['adaos'];



if(!empty($_POST['titlu']))
{
updateTablou($connection,$titlu,$descriere,$adaos,$autor,$idProdus);





$path="../uploads";






//gasire imagini
$tablouId=mysqli_real_escape_string($connection, $idProdus);
    $sql="SELECT * FROM tablou WHERE tablouId='$idProdus'";
    $sql_run = mysqli_query($connection, $sql);
    $sql_data=mysqli_fetch_array($sql_run);
    

    //VERIFICARE FIECARE IMAGINE
if(!empty($_FILES['imagine']['name'])){
        //stergere imagine
        $imagine=$sql_data['tablouImage'];
        unlink("../uploads/".$imagine);
//noua imagine
        $imagine=$_FILES['imagine']['name'];
        $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
        $filename=$imagine."1".time().'.'.$imagine_e;
        move_uploaded_file($_FILES['imagine']['tmp_name'], $path.'/'.$filename);
        updateImagine($connection, "tablouImage",$filename, $idProdus);
}

if(!empty($_FILES['imagine2']['name'])){
 //stergere imagine
 $imagine=$sql_data['tablouImage2'];
 unlink("../uploads/".$imagine);
//noua imagine
 $imagine=$_FILES['imagine2']['name'];
 $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
 $filename=$imagine."2".time().'.'.$imagine_e;
 move_uploaded_file($_FILES['imagine2']['tmp_name'], $path.'/'.$filename);
 updateImagine($connection, "tablouImage2",$filename, $idProdus);
}

if(!empty($_FILES['imagine3']['name'])){
 //stergere imagine
 $imagine=$sql_data['tablouImage3'];
 unlink("../uploads/".$imagine);
//noua imagine
 $imagine=$_FILES['imagine3']['name'];
 $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
 $filename=$imagine."3".time().'.'.$imagine_e;
 move_uploaded_file($_FILES['imagine3']['tmp_name'], $path.'/'.$filename);
 updateImagine($connection, "tablouImage3",$filename, $idProdus);
            }
  
 if(!empty($_FILES['imagine4']['name'])){
 //stergere imagine
 $imagine=$sql_data['tablouImage4'];
 unlink("../uploads/".$imagine);
//noua imagine
 $imagine=$_FILES['imagine4']['name'];
 $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
 $filename=$imagine."4".time().'.'.$imagine_e;
 move_uploaded_file($_FILES['imagine4']['tmp_name'], $path.'/'.$filename);
 updateImagine($connection, "tablouImage4",$filename, $idProdus);
                }

                if(!empty($_FILES['imagine5']['name'])){
                    //stergere imagine
                    $imagine=$sql_data['tablouImage5'];
                    unlink("../uploads/".$imagine);
                   //noua imagine
                    $imagine=$_FILES['imagine5']['name'];
                    $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
                    $filename=$imagine."5".time().'.'.$imagine_e;
                    move_uploaded_file($_FILES['imagine5']['tmp_name'], $path.'/'.$filename);
                    updateImagine($connection, "tablouImage5",$filename, $idProdus);
                                   }
    
                                   if(!empty($_FILES['imagine6']['name'])){
                                    //stergere imagine
                                    $imagine=$sql_data['tablouImage6'];
                                    unlink("../uploads/".$imagine);
                                   //noua imagine
                                    $imagine=$_FILES['imagine6']['name'];
                                    $imagine_e=pathinfo($imagine, PATHINFO_EXTENSION);
                                    $filename=$imagine."6".time().'.'.$imagine_e;
                                    move_uploaded_file($_FILES['imagine6']['tmp_name'], $path.'/'.$filename);
                                    updateImagine($connection, "tablouImage6",$filename, $idProdus);
                                                   }





$trash= "DELETE FROM tablousicategorie WHERE tablouId='$idProdus'";
$trash_run=mysqli_query($connection,$trash);

$categorie2=getAll($connection, "tablou_categorie");
foreach($categorie2 as $obiect){
    if($obiect['categId']==$_POST[$obiect['categId']]){
        $idCateg=$obiect['categId']; 
        insertTablouAndCategorie($connection,$idCateg,$idProdus);
    }
}


}


else
{
header("location: ../editare_tablou.php?error=noinput&id=$idProdus");
exit();
}


header("location: ../editare_tablou.php?error=none&id=$idProdus");
exit();

}

else{

    header("location: ../editare_stergere_tablou.php");
    exit();
}
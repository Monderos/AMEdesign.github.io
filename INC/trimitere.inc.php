<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_SESSION['userid'])){


if(isset($_POST['submit']))
{

if(!empty($_FILES['file']['name'])){
    if(!empty($_POST['detalii'])){
   

$detalii=$_POST['detalii'];

$file=$_FILES['file']['name'];

mkdir("../uploads/Comenzi_speciale/".$_SESSION['userid']);
$folder=$_SESSION['userid'];

$path="../uploads/Comenzi_speciale/$folder";

$file_e=pathinfo($file, PATHINFO_EXTENSION);
$filename=$file." ".time().".".$file_e;

$txtfile=fopen("../uploads/Comenzi_speciale/".$_SESSION['userid']."/Detalii $filename.txt","w");


fwrite($txtfile,$detalii."   




Nume: ".$_SESSION['username']);
move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'.$filename);

        header("location: ../trimitere.php?error=none");
        exit();


    }
    else{
        header("location: ../trimitere.php?error=noinputdetalii");
        exit();
    }
}
else{
    header("location: ../trimitere.php?error=noinputfile");
    exit();
}


}

else
{
    header("location: ../index.php");
    exit();
}
}
else
{
header("location: ../trimitere.php?error=nouser");
    exit();
}
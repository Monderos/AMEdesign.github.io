<?php
include_once('../INC/dbh.inc.php');
include_once('../INC/functions.inc.php');

if(isset($_POST['submit_filter'])){

//error handler
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);


if(isset($_POST['isFinalized']))
{
$All="All";
$isFinalized=true;
   
}
if(($_POST['Name']))
    {
        $Name=$_POST['Name'];
        $name=true;
      
    }

    if(($_POST['Date']))
    {
        $Date=$_POST['Date'];
        $date=true;
      
    }
    if(($_POST['Date2']))
    {
        $Date2=$_POST['Date2'];
        $date2=true;
      
    }



   
if($Date2!=""){


    if($Date=="" || $Date2<$Date){

        header("location: ../raport_comenzi.php?error=wrong_date");
        exit();
    }
}
if($name || $isFinalized || ($date && $date2)){

    header("location: ../raport_comenzi.php?$All&name=$Name&date=$Date&date2=$Date2");
    exit();

}
else if($name || $isFinalized || $date){
    header("location: ../raport_comenzi.php?$All&name=$Name&date=$Date");
    exit();
}

else{

    header("location: ../raport_comenzi.php");
exit();
}

}




else
{
header("location: ../index.php");
exit();
}
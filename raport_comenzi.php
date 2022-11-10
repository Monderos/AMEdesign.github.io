<?php
include_once 'navbar_admin.php';
?>


<div class="d-flex d-column justify-content-center  mt">
<div class="filter white px-3 text-center">
<span>Filters</span>
<div class="font-rubik b">
<select class="list-group-input" type="text" name="tip" onchange="window.location=this.value">
<option value ="raport_comenzi.php">Comenzi
</option>
<option value ="raport_users.php">Utilizatori
</option>

</select>
<form autocomplete="off" action="INC/raport.filter.inc.php" method="post" enctype="multipart/form-data" class="list-group white position-relative">


<div >
        <?php
        if(isset($_GET["All"])){
                $checked="checked";
        }
        else{
                $checked="";
        }
        ?>
        
<input class="form-check-input mx-2 mb-2" type="checkbox" name="isFinalized" id="isFinalized" value="1" <?= $checked?>>
<label class="form-check-label white">Toate comenzile</label>
</input>
</br>
<input class="mx-2 mb-2" type="text" name="Name" placeholder="nume, oras, tablou, AID">

</input>
&nbsp;&nbsp;Interval data:
<input class="mx-2 mb-2 text-center" type="date" name="Date">

</input>
<input class="mx-2 mb-2 text-center" type="date" name="Date2">

</input>
</div>


<button class="text-center" type="submit" name="submit_filter" value="Upload">
        Caută
</button>
</form>
</div>
</div>


<div class="wrapper_tablouri d-flex flex-wrap container my-3 mx-3 px-3">


<?php

require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';

$all=false;
$name=false;
$date=false;
$date2=false;
$Date="";
$Date2="";



if(!isset($_GET[""])){
        $function="getComanda";
}
if(isset($_GET["All"])){
        $all=true;
        
}
if(isset($_GET["name"])){
        if($_GET["name"]=="")
        {

        }
        else{
                $name=true;
                $Name=$_GET["name"];
                
        }
}
if(isset($_GET["date"])){
        if($_GET["date"]=="")
        {

        }
        else{
                $date=true;
                $Date=$_GET["date"];
        }
        
}
       
if(isset($_GET["date2"])){
        if($_GET["date2"]=="")
                 {
                
                  }
                  else{
                                $date2=true;
                                $Date2=$_GET["date2"];

                                
                  }
                }


        if($all && $name && $date){
                $function="getComandaAllNameDate";
        }
        else if($name && $date){
                $function="getComandaNameDate";
        }
        else if($all && $name){
                $function="getComandaAllName";
        }
        else if($all && $date)
        {
                $function="getComandaAllDate";
        }
        else if($all){
                $function="getComandaAll";
        }
        else if($name){
                $function="getComandaName";
        }
        else if($date){
        $function="getComandaDate";
        }
        
 

if($date && $name==false){
        $comanda=$function($connection,$Date, $Date2);
}

else if($name && $date==false){
        $comanda=$function($connection,$Name);
        
}
else if($name && $date){
        $comanda=$function($connection, $Date, $Name, $Date2);
}
else{
        $comanda=$function($connection);
}

if(mysqli_num_rows($comanda)>0){
        ?>
        <table class="table position-relative white text-center align-middle"> 
<thead class="position-relative white">
        <tr>

        <th scope="col">AID</th>
      <th scope="col">Nume</th>
      <th scope="col">Oraș</th>
      <th scope="col">Tablouri</th>
      <th scope="col">Data</th>
     
      <th scope="col">Cantitate</th>
      <th scope="col">Preț</th>
      <th scope="col">Detalii</th>
      <th scope="col">Finalizata</th>
      <th scope="col">Factură</th>
    </tr>
</thead>
<tbody class="position-relative white">
        <?php
        if(isset($_GET["error"])){
                if($_GET["error"]=="wrong_date"){
                        echo "<p class='position-relative error'> Introduceți o perioadă validă! </p>";
        
                }
        }


$count=0;

  foreach($comanda as $obiect){
       $count++;
?>

<tr>

<th class="white" scope="row"><?= $obiect['AID'];;?></th>

<td>
     <?= $obiect['userName'];?>
</td>
<td>
     <?= $obiect['userCity'];?>
</td>
<td>
     <?= $obiect['tablouName'];?>
</td>
<td>
     <?= $obiect['dateComanda'];?>
</td>

<td>

<?= $obiect['qty'];?>
 
</td>
<td>

<?= $obiect['pretComanda'];?>
 
</td>
<td>
<a class="fst-italic text-decoration-underline" href="detalii_raport_comenzi?facturaAID=<?= $obiect['AID']; ?>">Detalii</a>
</td>
<td>
       
        <?= $obiect['fin'];?>
</td>
<td>

<a href="uploads/Invoice/<?= $obiect['facturaComanda'];?>">PDF</a>
 
</td>
</th>
</tr>

           
   
        


    
<?php 


    }
 echo ' <span class="text-center position-relative" style="color:#AAA;text-align:center;">Număr elemente: '.$count.'</span>';
}
else{
        ?>
        <div class=" position-relative">
                <?php
    echo '<span class="text-center" style="color:#AAA;text-align:center;">Nu există comenzi cu aceste filtre!</span>';
    ?>
        </div>
        <?php
}

?>
</tbody>
</table>
</div>
</div>

<?php
include_once 'footer.php';
?>
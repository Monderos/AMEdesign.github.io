<?php
include_once 'navbar.php';


require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
 
$fintotal="";
$userid=$_SESSION['userid'];
$comanda="SELECT c.comandaId, c.userId, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId, c.qty, c.pretComanda, c.facturaAID,
c.comandaFinalizata as fin, c.facturaComanda,
     t.tablouId, t.tablouName, t.tablouImage,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName
FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r

WHERE c.userId='$userid' AND c.tablouId=t.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId
GROUP BY c.facturaAID";
$comandarun=mysqli_query($connection,$comanda);

if(mysqli_num_rows($comandarun)>0){
    ?>

<div class="d-flex d-column justify-content-center  mt">



<div class="wrapper_comenzi d-flex flex-wrap container my-3 mx-3 px-3">

<table class="table position-relative white text-center align-middle"> 
<thead class="position-relative white">
        <tr>
        <th scope="col">ID</th>
     

      
      <th scope="col">Data</th>
      <th scope="col">Tablouri</th>
      <th scope="col">Număr tablouri</th>
      <th scope="col">Preț total (lei)</th>
      <th  scope="col">Detalii</th>
      <th scope="col">Finalizata</th>
      <th scope="col">Factură</th>
    </tr>
</thead>
<tbody class="position-relative white">

   <?php     




//pagination

//nr total de elemente
$nr=mysqli_num_rows($comandarun);

if(isset($_GET['pagen']))
$pagen=preg_replace('#[^0-9]#i','',$_GET['pagen']);//securiate daca este introdus un caracter de la tastatura
else{
    $pagen=1;
}

$limit=5;
$final=ceil($nr/$limit); //ultima pagina

if($pagen<1){//verificare daca este introdus 0
$pagen=1;
}
else if($pagen>$final){//verificare sa nu depaseasca numarul maxim de pagini
$pagen=$final;
}

//creare numere cu link 
$centru="";
$s1=$pagen-1;//numerul cu 1 inainte
$s2=$pagen-2;//numerul cu 2 inainte
$a1=$pagen+1;//numerul cu 1 in fata
$a3=$pagen+2;//numerul cu 2 in fata

//SISTEM AFISARE

//daca este prima pagina sa nu arate backbutton
if($pagen==1){
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
$centru.='&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pagen='.$a1.'">'.$a1.'</a>&nbsp;';
}
//daca este ultima pagina...
else if($pagen==$final){
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$s1.'">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
}
//oriunde in mijloc
else if($pagen>2 && $pagen<($final-1)){
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$s2.'">'.$s2.'</a>&nbsp;';
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$s1.'">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span>&nbsp;';
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$a1.'">'.$a1.'</a>&nbsp;';
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$a2.'">'.$a2.'</a>&nbsp;';
}
//penultima pagina
else if($pagen>1 && $pagen<$final){
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$s1.'">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
$centru.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pagen='.$a1.'">'.$a1.'</a>&nbsp;';
}


$limitsql='LIMIT '.($pagen-1)*$limit.','.$limit;
$userid=$_SESSION['userid'];
$sqlpage="SELECT c.comandaId, c.userId, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId, SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda, c.facturaAID,
c.comandaFinalizata as fin, c.facturaComanda,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName, t.tablouImage,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName
FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r

WHERE c.userId='$userid' AND c.tablouId=t.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId
GROUP BY c.facturaAID
order by fin DESC,c.dateComanda DESC ".$limitsql;
$sqlpagerun=mysqli_query($connection,$sqlpage);


//afisare

$pageDisp="";
if($final!=1){
    $pageDisp.='Pagina <strong class="position-relative">'.$pagen.'</strong> / '.$final.' ----';
    if($pagen !=1){
        $inapoi=$pagen-1;
        $pageDisp.='&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pagen='.$inapoi.'"> Înapoi</a>';
    
    }
    $pageDisp.='<span class="paginare_nr position-relative">'.$centru.'</span>';
    
    if($pagen!=$final){
        $inainte=$pagen+1;
        $pageDisp.='&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pagen='.$inainte.'"> Înainte</a>';
    }
}
  foreach($sqlpagerun as $obiect){
       
?>

<tr>

<th class="white" scope="row"><?= $obiect['facturaAID'];?></th>




<td>
<?= $obiect['dateComanda'];?>
</td>
<td>
<?= $obiect['tablouName'];?>
</td>
<td>
<?= $obiect['qty'];?>
</td>
<td>
<?= $obiect['pretComanda'];?>
</td>

<td>

<a class="text-decoration-underline fst-italic" href="detalii_comanda?facturaAID=<?= $obiect['facturaAID']; ?>">Detalii</a>
</td>
<td>
   
<?php

if($obiect['fin']=="Nu"){
  $fintotal="Nu";
    $color="red";
}
else
{
$fintotal="Da";
$color="green";
}
echo '<span style="color:'.$color.'">'.$fintotal.'</span>';
?>
   
</td>
<td>
<a href="uploads/Invoice/<?= $obiect['facturaComanda'];?>">PDF</a>

</td>
</th>
</tr>

           
   
        


    
<?php 
    }
    ?>
    <div class="position-relative white container text-center"><?php echo $pageDisp; ?></div>
    <?php
}
else{
    ?>
    
    <div class="wrapper_comenzi container">
    <div class="text-center">
    <span class="white">Nu ați făcut nicio comandă!</span>
    </div>
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
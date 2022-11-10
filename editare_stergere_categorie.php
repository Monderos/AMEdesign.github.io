<?php
include_once 'navbar_admin.php';
?>


<div class="d-flex d-column justify-content-center  mt">
<div class="filter white px-3 text-center">
<span >Filters</span>
<div class="font-rubik b ">
<select class="list-group-input" type="text" name="tip" onchange="window.location=this.value">
<option value ="editare_stergere_categorie.php">Categorie 
</option>
<option value ="editare_stergere_tablou.php">Tablou 
</option>





</select>
</div>
</div>


<div class="wrapper_tablouri d-flex flex-wrap container my-3 mx-3 px-3">

<?php
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';

$categorie=getAllOrdered($connection, "tablou_categorie","categNume"); 

if(mysqli_num_rows($categorie)>0){

//pagination

//nr total de elemente
$nr=mysqli_num_rows($categorie);

if(isset($_GET['pagen']))
$pagen=preg_replace('#[^0-9]#i','',$_GET['pagen']);//securiate daca este introdus un caracter de la tastatura
else{
    $pagen=1;
}

$limit=15;
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

$sqlpage="SELECT * FROM tablou_categorie ORDER BY categNume ".$limitsql;
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


        <div class="white lista_editare mt-5 pt-2 p-1 mb-5 text-center">       
        <span class="text-center mx-auto">
        <?= $obiect['categNume']; ?>      
        </span>
        <div>
        
<a href="editare_categorie.php?id=<?= $obiect['categId'];?>">
        <button type=button id="" class="fa fa-edit ls edit_categorie" value="<?= $obiect['categId']; ?>" data-value="<?= $obiect['categNume']; ?>">
 </button>
</a>

        <button type=button id="" class="fa fa-trash ls trash_categorie" value="<?= $obiect['categId']; ?>" data-value="<?= $obiect['categNume']; ?>">
 </button>

 
 
         </div>
        </div>
        


    
<?php 
    }
    ?>
<div class="position-relative white container text-center"><?php echo $pageDisp; ?></div>
<?php
}
else{
    echo '<span style="color:#AAA;text-align:center;">Nu există categorii momentan!</span>';
}

?>
</div>
</div>

<?php
include_once 'footer.php';
?>
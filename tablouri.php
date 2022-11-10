
<?php

include_once 'navbar.php';
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';



//sitem filter



$sqlfilter="";
$cautare="";
$cautare2="";
$categorie=false;
$autor="";
$filter=0;
$countsql=0;

    $sqlfilter="SELECT tc.categId, tc.tablouId, 
    t.tablouId, t.tablouName, t.tablouImage, t.tablouAutor 
    FROM tablousicategorie tc, tablou t 
    WHERE t.tablouId=tc.tablouId AND tc.categId IN (";
    
    foreach($_POST as $key => $value) {
       
        if (preg_match("/^\d+$/", $value)) {
            
            $filter=1;
            $countsql++;
            $categorie=true;
         echo "<script>console.log('Debug Objects: " . $value . "' );</script>";



$sqlfilter.="'$value',";

 echo "<script>console.log('$sqlfilter');</script>";


        }
        else if($value!="" AND $categorie==false){
            
            $filter=1;

       

            $sqlfilter="SELECT 
            tablouId, tablouName, tablouImage, tablouAutor 
            FROM tablou 
            WHERE tablouAutor='".$value."' ";

        }
       else if($value!="" AND $categorie) {
       echo "<script>console.log('Debug Objects: " . $value . "' );</script>";
$autor="AND t.tablouAutor="."'$value'"." ";


        }

      }
      if($categorie){
        $sqlfilter=substr_replace($sqlfilter,")", -1);
        $sqlfilter.=" GROUP BY tc.tablouId HAVING COUNT(*) = $countsql ";
        $sqlfilter.=$autor;
     
        $sqlfilterrun=mysqli_query($connection,$sqlfilter);
     
      }
      else{
        $sqlfilter.=$autor;
       
        $sqlfilterrun=mysqli_query($connection,$sqlfilter);
        
      }
  

      if(isset($_GET['name']) && $_GET['name']!=""){
        $cautare="WHERE tablouName LIKE '%".$_GET['name']."%' ";
        $sqlfilterrun="SELECT * FROM tablou ".$cautare;
        $cautare2=$_GET['name'];
        }
        else if($_GET['name']=""){
            $cautare="";
            $cautare2="";
        }

?>

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
<div class="d-flex d-column justify-content-center mt">
<div class="filter">
    <div class="white px-3 b text-center">
<span >Filters</span>
    </div>
<p class="px-2 primary font-rubik font-size-16">Categorii:</p>
<div class="categorii">
<form autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="list-group white position-relative"
id="form">
<?php
$categorie=getAllOrdered($connection, "tablou_categorie","categNume");
if(mysqli_num_rows($categorie)>0){
 
        foreach($categorie as $obiectcateg){
           
            ?>
            <div>
    <input   <?php 
    if(!empty($_POST[$obiectcateg['categId']]))
    {
    echo "checked"; 
    }
    
    ?>
     class="form-check-input mx-2 mb-2" type="checkbox" value="<?= $obiectcateg['categId']; ?>"
     id="<?=$obiectcateg['categId'];?>" name="<?= $obiectcateg['categId']; ?>">
      <label class="form-check-label white " for="flexCheckDefault" 
     >
      <?= $obiectcateg['categNume'];?>
      </label>
    
      </input>
            </div>
    
    
    
    <?php
        
    }
 
}
else{
    echo '<span style="color:#AAA;text-align:center;">Nu există categorii momentan!</span>';
}
?>
</div>


<br>
<p class="px-2 primary font-rubik font-size-16">Artist:</p>
<div class="categorii">
   
<?php

$idautornr=0;
$autor=getUnique($connection, "tablouAutor", "tablou");
if(mysqli_num_rows($autor)>0){
foreach($autor as $obiectautor){
    $idautornr++;
    $idautor="a".$idautornr;
    ?>
     <div>
<input 
<?php 

if(!empty($_POST[$idautor]))
{
echo "checked"; 
}
    
    ?>
   
class="form-check-input mx-2 mb-2 autor" type="checkbox" value="<?=$obiectautor['tablouAutor'];?>" id="<?=$obiectautor['tablouAutor'];?>"
 name="<?= $idautor?>">
  <label class="form-check-label white " for="flexCheckDefault">
  <?= $obiectautor['tablouAutor'];?>
  </label>

  </input>
        </div>
        
        <?php
}
}
else{
    echo '<span style="color:#AAA;text-align:center;">Nu există autori momentan!</span>';
}
?>

</div>
<div class="text-center mt-4">
<button class="text-center" type="submit" name="submit_filter">
    FILTER</button>
</div>

</div>

<div class="wrapper_tablouri container d-flex flex-wrap my-3 mx-3 px-3">

<?php

if($cautare!=""){
    $tablouri=gettabelWhereLikeId($connection, "tablou","tablouName",$cautare2);
}
else{
    $tablouri=getAll($connection, "tablou");
}


if(mysqli_num_rows($tablouri)>0){


//pagination

//nr total de elemente
if($filter==0){
    $nr=mysqli_num_rows($tablouri);
}
else{
    $nr=mysqli_num_rows($sqlfilterrun);
}

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
if($pagen==NULL){
    $pagen=1;
}
else if($pagen>$final){//verificare sa nu depaseasca numarul maxim de pagini
$pagen=$final;
}
if($pagen==0){
    $pagen=1;
}

//creare numere cu link 
$centru="";
$s1=$pagen-1;//numerul cu 1 inainte
$s2=$pagen-2;//numerul cu 2 inainte
$a1=$pagen+1;//numerul cu 1 in fata
$a2=$pagen+2;//numerul cu 2 in fata

//SISTEM AFISARE

//daca este prima pagina sa nu arate backbutton
if($pagen==1){
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
$centru.='&nbsp; <a class="a1" href="#">'.$a1.'</a>&nbsp;';
}
//daca este ultima pagina...
else if($pagen==$final){
$centru.='&nbsp;<a class="s1" href="#">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
}
//oriunde in mijloc
else if($pagen>2 && $pagen<($final-1)){
$centru.='&nbsp;<a class="s2" href="#">'.$s2.'</a>&nbsp;';
$centru.='&nbsp;<a class="s1" href="#">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span>&nbsp;';
$centru.='&nbsp;<a class="a1" href="#">'.$a1.'</a>&nbsp;';
$centru.='&nbsp;<a class="a2" href="#">'.$a2.'</a>&nbsp;';
}
//penultima pagina
else if($pagen>1 && $pagen<$final){
$centru.='&nbsp;<a href="#" class="s1">'.$s1.'</a>&nbsp;';
$centru.='&nbsp; <span class="paginare position-relative">'.$pagen.'</span> &nbsp;';
$centru.='&nbsp;<a href="#" class="a1">'.$a1.'</a>&nbsp;';
}


$limitsql='LIMIT '.($pagen-1)*$limit.','.$limit;

if($filter==0){
    $sqlpage="SELECT * FROM tablou ".$cautare.$limitsql;
    $sqlpagerun=mysqli_query($connection,$sqlpage);
    echo "<script>console.log('Debug Objects: " . $sqlpage . "' );</script>";
}
else{

    $sqlpage=$sqlfilter.$limitsql;
    $sqlpagerun=mysqli_query($connection,$sqlpage);
 echo "<script>console.log('Debug Objects: " . $sqlpage . "' );</script>";
}



//afisare

$pageDisp="";

if($final!=1){
    $pageDisp.='Pagina <strong class="position-relative">'.$pagen.'</strong> / '.$final.' ----';
    if($pagen !=1){
       

        $pageDisp.='&nbsp; <a id="inapoi" href="#"> Înapoi </a>';
    
    }
    $pageDisp.='<span class="paginare_nr position-relative">'.$centru.'</span>';
    
    if($pagen!=$final){
     
        $pageDisp.='&nbsp; <a id="inainte" href="#"> Înainte</a>';
    }
}
?>
</form>
<?php
if(mysqli_num_rows($sqlpagerun)==0)
{
    echo '
    <span class="position-relative"  style="color:#AAA;text-align:center;">Nu există tablouri cu aceste filtre!</span>';
}
else
{
    foreach($sqlpagerun as $obiect){
  
        ?>
        <a href="produs.php?tablou=<?= $obiect['tablouId'];?>">
                <div class="grid-products card2 mt-5 pt-2 p-1 mb-5 bd-highlight">
                
                <img class="text-center mx-auto" src ="../Licenta/uploads/<?= $obiect['tablouImage']; ?>"
                        width="150 px" height="100 px"/>
                        
                    <div class="card-title text-center mx-auto ">
                        <h5 class="card-title text-dark"><?= $obiect['tablouName']; ?></h5>
                    
                    </div>
                    </a>
                </div>
        
         
            
        <?php 
            
}
?>
<div class="position-relative white container text-center"><?php echo $pageDisp; ?></div>
<?php
    
}
}
else{
    echo '<span class="position-relative" style="color:#AAA;text-align:center;">Nu există tablouri momentan!</span>';
}

if (isset($_GET["pagen"])){
    $inainte=$_GET["pagen"]+1;
}else{
    $inainte=2;
}


if (isset($_GET["pagen"])){
    $inapoi=$_GET["pagen"]-1;
}
else{
    $inapoi=1;
}
if(isset($_GET['name'])){
    $cautare2=$_GET['name'];
}
else{
    $cautare2="";
}

?>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">



$(document).ready(function(){



$('.autor').change(function(){

  if(this.checked){
     $('.autor').not(this).prop('checked', false);
  }    
});

});

$('#inainte').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $inainte; ?>');
   document.getElementById('form').submit();
    
});
$('#inapoi').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $inapoi ?>');
   document.getElementById('form').submit();
    
});



$('.a1').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $a1; ?>');
   document.getElementById('form').submit();
    
});
$('.a2').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $a2; ?>');
   document.getElementById('form').submit();
    
});

$('.s1').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $s1; ?>');
   document.getElementById('form').submit();
    
});
$('.s2').on('click',function(event){
   $('#form').attr('action', 'tablouri.php?name=<?php echo $cautare2 ?>&pagen=<?php echo $s2; ?>');
   document.getElementById('form').submit();
    
});


</script>


<?php
include_once 'footer.php';

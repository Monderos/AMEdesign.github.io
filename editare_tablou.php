<?php 
include_once 'navbar_admin.php';
?>

<?php 

require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';

if(isset($_GET['id'])){


$id=$_GET["id"];

$tablou=getTabelWhereId($connection,"tablou","tablouId",$id);

$obiect=mysqli_fetch_array($tablou);
$idtt=$obiect['tablouId'];

}
else{
    header("editare_stergere_tablou");
    exit();
}

?>


<section class="_insert">
<div class="d-flex justify-content-center insert">


<form autocomplete="off" action="INC/tablou_update.inc.php" method="post" enctype="multipart/form-data" class="list-group">
    
<div class="d-flex justify-content-center">

<?php
if(isset($_GET["error"])){
if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="noinput"){
  echo "<p class='error'> Nu puteți lăsa fără un titlu! </p>";
}
else if($_GET["error"]=="none"){
  echo "<p class='success'> Ați editat cu succes tabloul! </p>";
}

}
?>
    </div>
    <div class="font-rubik b list-group-item overflow-none">
    <a href="editare_stergere_tablou.php">
  <button type=button class="fa fa-arrow-left">
  </button>
</a>  
    Editare:  <?= $obiect["tablouName"]?>,
   
</br>
    Id: <?= $obiect["tablouId"]?>

</div>

<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine principală actuală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine">
<hr class="border-3 black">
</div>

<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine ramă albă 1 actuală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage2"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine2">
<hr class="border-3 black">
</div>


<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine ramă neagră 1 actuală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage3"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine3">
<hr class="border-3 black">
</div>

<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine fără ramă actuală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage4"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine4">
<hr class="border-3 black">
</div>

<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine ramă albă 2 actuală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage5"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine5">
<hr class="border-3 black">
</div>

<div class="font-rubik b list-group-item">

<span class=" text-center">Imagine ramă neagră 2 acutală:</span>

<img class="mx-5 zoom mt-2" src="uploads/<?= $obiect["tablouImage6"]?>"
height=100px width=150px>

</br>
</br>

Imagine nouă:
<input class="list-group-input" type="file" name="imagine6">
<hr class="border-3 black">
</div>

<div class="font-rubik b list-group-item">
Nume:
  <input class="list-group-input" type="text" name="titlu" value="<?= $obiect["tablouName"]?>">
</div>


<div class="font-rubik b list-group-item">
Descriere:
  <textarea class="descriere" type="text" name="descriere"><?= $obiect["tablouDesc"]?></textarea>
</div>

<div class="font-rubik b list-group-item">

Autor:
  <input id="autor" class="list-group-input"
  type="text" name="autor" value="<?= $obiect["tablouAutor"]?>">



</div>


<div id="adaos" class="font-rubik b list-group-item">

Adaos preț:
  <input class="list-group-input" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" 
  type="number" name="adaos" value="<?= $obiect["tablouAdaos"]?>">
</div>


<div class="font-rubik b list-group-item">
Categorie:
<br>
<?php

$checkcateg=getAll($connection,"tablousicategorie");




$categorie=getAllOrdered($connection, "tablou_categorie","categNume"); 
if(mysqli_num_rows($categorie)>0){
  foreach($categorie as $obiect){

    $idt=$obiect['categId'];
    $search="SELECT * FROM tablousicategorie WHERE categId LIKE '$idt' AND tablouId LIKE '$idtt'";
    $search_run=mysqli_query($connection,$search);
    if(mysqli_num_rows($search_run)>0){

    
?>

<input checked class="form-check-input" type="checkbox" value="<?= $obiect['categId']; ?>" id="flexCheckDefault" name="<?= $obiect['categId']; ?>">
  <label class="form-check-label" for="flexCheckDefault">
  <?= $obiect['categNume'];?>
  </label>

  </input>
  </br>
  <?php
   }
else
{
    ?>
    <input class="form-check-input" type="checkbox" value="<?= $obiect['categId']; ?>" id="flexCheckDefault" name="<?= $obiect['categId']; ?>">
  <label class="form-check-label" for="flexCheckDefault">
  <?= $obiect['categNume'];?>
  </label>

  </input>
  </br>
  <?php
  }
}
}
else
{
  echo '<span style="color:#AAA;text-align:center;">Nicio categorie disponobilă</span>';
}

?>
</div>





  <li class="list-group-item d-flex" >
  <a href="editare_stergere_tablou.php">
  <button type=button class="fa fa-arrow-left">
  </button>
</a>  


    <button class="fa fa-upload lm" type="submit" name="submit" value="<?= $id?>">   
     
        
    </button>
    
</li>
        
    </div>
    </form>
  
</div>
    
   
</section>



<?php

include_once 'footer.php';
?>




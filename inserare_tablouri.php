<?php 
include_once 'navbar_admin.php';
?>

<?php 
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
?>


<section class="_insert">
<div class="d-flex justify-content-center insert">

<form autocomplete="off" action="INC/insert.inc.php" method="post" enctype="multipart/form-data" class="list-group">
    
<div class="d-flex justify-content-center">

<?php
if(isset($_GET["error"])){
if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="noinput"){
  echo "<p class='error'> Inserați toate imaginile și un titlu obligatoriu! </p>";
}
else if($_GET["error"]=="none"){
  echo "<p class='success'> Ați adăugat cu succes produsul! </p>";
}

}
?>
    </div>
    <div style="border-radius: 5px;">
<div class="font-rubik b list-group-item ">
Inserare:
<select class="list-group-input" type="text" name="tip" onchange="window.location=this.value">

<option value ="inserare_tablouri.php">Tablou 
</option>


<option value ="inserare_categorii.php">Categorie 
</option>

</select>
</div>

<div class="font-rubik b list-group-item">
Imagine principală:
<input class="list-group-input" type="file" name="imagine">
</div>

<div class="font-rubik b list-group-item">
Imagine cu ramă albă 1:
<input class="list-group-input" type="file" name="imagine2">
</div>

<div class="font-rubik b list-group-item">
Imagine cu ramă neagră 1:
<input class="list-group-input" type="file" name="imagine3">
</div>

<div class="font-rubik b list-group-item">
Imagine fără ramă:
<input class="list-group-input" type="file" name="imagine4">
</div>

<div class="font-rubik b list-group-item">
Imagine cu ramă albă 2:
<input class="list-group-input" type="file" name="imagine5">
</div>

<div class="font-rubik b list-group-item">
Imagine cu ramă neagră 2:
<input class="list-group-input" type="file" name="imagine6">
</div>

<div class="font-rubik b list-group-item">
Nume:
  <input class="list-group-input" type="text" name="titlu" placeholder="Nume imagine...">
</div>


<div class="font-rubik b list-group-item">
Descriere:
  <textarea class="descriere" type="text" name="descriere"></textarea>
</div>

<div class="font-rubik b list-group-item">

Autor:
  <input id="autor" class="list-group-input"
  type="text" name="autor" value="Royalty-free">



</div>


<div id="adaos" class="font-rubik b list-group-item">

Adaos preț:
  <input class="list-group-input" oninput="this.value=this.value.replace(/(?![0-9])./gmi,'')" 
  type="number" name="adaos" value="0">
</div>


<div class="font-rubik b list-group-item">
Categorie:
<br>
<?php

$categorie=getAllOrdered($connection, "tablou_categorie","categNume"); 
if(mysqli_num_rows($categorie)>0){
  foreach($categorie as $obiect){

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
else
{
  echo '<span style="color:#AAA;text-align:center;">Nici categorie disponobilă</span>';
}

?>
</div>





  <li class="list-group-item d-flex" >
  <a href="admin_index.php">
  <button type=button class="fa fa-arrow-left">
  </button>
</a>  


    <button class="fa fa-upload lm" type="submit" name="submit" value="Upload">
     
        
    </button>
    
</li>
        
    </div>
    </form>
  
</div>
    
   
</section>



<?php

include_once 'footer.php';
?>




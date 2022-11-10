<?php
include_once 'navbar_admin.php';
?>


<?php 
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';



if(isset($_GET['id'])){



$id=$_GET["id"];

$categorie=getTabelWhereId($connection,"tablou_categorie","categId",$id);

$obiect=mysqli_fetch_array($categorie);

}
else
{
header("editare_stergere_categorie.php");
exit();

}

?>
<section class="_insert">
<div class="d-flex justify-content-center insert">

<form autocomplete="off" action="INC/categorie_update.inc.php" method="post" enctype="multipart/form-data" class="list-group">
    
<div class="d-flex justify-content-center">

<?php
if(isset($_GET["error"])){
if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="noinput"){
  echo "<p class='error'> Inserați noul nume pentru categora dorită! </p>";
}
else if($_GET["error"]=="categorietaken"){
    echo "<p class='error'> Categoria există deja! </p>";
  }

else if($_GET["error"]=="none"){
  echo "<p class='success'> Ați schimbat cu succes numele categoriei! </p>";
}
}
?>
    </div>
    <div style="border-radius: 5px;">

<div class="font-rubik b list-group-item">
    <span class="overflow-none">
Editare categoria "<?php echo $obiect['categNume'];?>":
    </span>
  <input class="list-group-input" type="text" name="categorie" value="<?= $obiect['categNume'];?>">
</div>

  <li class="list-group-item d-flex" >
  <a href="editare_stergere_categorie.php">
  <button type=button class="fa fa-arrow-left">
  </button>
</a>  

    <button class="fa fa-upload lm" type="submit" name="submit" value="<?= $id ?>">   
     
        
    </button>
    
</li>
        
    </div>
    </form>
  
</div>
    
   
</section>



<?php



include_once 'footer.php';
?>
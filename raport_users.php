<?php
include_once 'navbar_admin.php';
?>


<div class="d-flex d-column justify-content-center  mt">
<div class="filter">
<p class="white px-3 text-center">Filters</p>
<div class="font-rubik b ">
<select class="list-group-input" type="text" name="tip" onchange="window.location=this.value">
<option value ="raport_users.php">Utilizatori
</option>
<option value ="raport_comenzi.php">Comenzi
</option>


</select>
<form autocomplete="off" action="INC/raport_filter2.inc.php" method="post" enctype="multipart/form-data" class="list-group white position-relative">


<div>



</br>
<input class="mx-2 mb-2" type="text" name="Name" placeholder="nume, oraș sau adresă...">

</input>

</div>


<button class="text-center" type="submit" name="submit_filter" value="Upload">
        Caută
</button>
</form>
</div>
</div>


<div class="wrapper_tablouri d-flex flex-wrap container my-3 mx-3 px-3">

<table class="table position-relative white text-center align-middle"> 
<thead class="position-relative white">
        <tr>
        <th scope="col">ID</th>
      <th scope="col">Nume</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
      <th scope="col">Telefon</th>
      <th scope="col">Oraș</th>
      <th scope="col">Adresă</th>
      <th scope="col">Ștergere</th>
    </tr>
</thead>
<tbody class="position-relative white">
<?php

require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
$name=false;

if(isset($_GET["name"])){
    if($_GET["name"]=="")
    {

    }
    else{
            $name=true;
            $Name=$_GET["name"];
            $users=getUsersName($connection,$Name);
            
    }
}
if($name==false){
    $users=getUsers($connection);
}

if(mysqli_num_rows($users)>0){
        
  foreach($users as $obiect){
       
?>

<tr>

<th class="white" scope="row"><?= $obiect['userId'];?></th>

<td>
     <?= $obiect['userName'];?>
</td>

<td>
     <?= $obiect['userEmail'];?>
</td>
<td>
     <?= $obiect['userUid'];?>
</td>
<td>
<?= $obiect['userPhone'];?>
</td>
<td>

<?= $obiect['userCity'];?>
</td>
<td>

<?= $obiect['userAddress'];?>
</td>
<td>
<a href="INC/delete_user.inc.php?id=<?=$obiect['userId']?>">
<button class="fa fa-trash text-center mx-auto bg-danger"></button>
  </a>
</td>


</th>
</tr>

           
   
        


    
<?php 
    }
    
}
else{
    echo '<span style="color:#AAA;text-align:center;">Nu există utilizatori momentan!</span>';
}

?>
</tbody>
</table>
</div>
</div>

<?php
include_once 'footer.php';
?>
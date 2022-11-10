<?php
include_once 'navbar.php';
?>

<div class="wrapper_tablouri container">
<div class="filter">
<p class="white px-3">Filters</p>

</div>
<tbody>
<?php
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';





$rollup=getAll($connection, "roll_up");

if(mysqli_num_rows($rollup)>0){
    foreach($rollup as $obiect){
?>
<tr>
    <td> <?= $obiect['rollupName']; ?> </td>
    <td> <?= $obiect['rollupDesc']; ?> </td>
    <td> <img src ="../Licenta/uploads/<?= $obiect['rollupImage']; ?>" width="100 px" height="100 px">
    </td>
</tr>
<?php 
    }
    
}
else{
    echo ("Nu există produse momentan!");
}

?>
</div>

<?php
include_once 'footer.php';
?>
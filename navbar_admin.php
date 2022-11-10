<?php
if(!isset($_SESSION["userid"])){
  session_start();
}

//verificare intrare frauduloasa
if ($_SESSION["isadmin"]==NULL){
    header("location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amedesign</title>
    <link rel="stylesheet" href="assets/css/Style_25/style.css">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- SCRIPTS -->
    <script src="../Licenta/Jquery/jquery-3.6.0.min.js";></script>
    <script src="../Licenta/Jquery/trash_tablou.js";></script>
    <script src="../Licenta/Jquery/trash_categorie.js";></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="bg-img" style="background-image: url('images/background3.jpg');">
    
    <!-- SECȚIUNE NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
        <div class="container">
          <a class="image" href="admin_index.php">
               <img src="images/logo_2.png" width="180" height="56.7" alt="logo"></a>

               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
              
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="inserare_tablouri.php"><span class="font-rubik">INSERARE </span></i></a>
                    
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="editare_stergere_tablou.php"><span class="font-rubik">EDITARE/STERGERE </span></i></a>
                    
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="raport_comenzi.php"><span class="font-rubik">RAPOARTE</span></a>
                </li>  
                
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><span class="font-rubik">VIZUALIZARE CA UTILIZATOR </span></i></a>
                    
                  </li>
                  
           
 

<div class="margin-left">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="font-roboto fw-bold"> <?php
                             echo $_SESSION["useruid"];
                              ?></span>
                        </a>
                        <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                       
                          <li><a class="dropdown-item" href="INC/logout.inc.php">log out</a></li>
                          
                        </ul>
                      </li>
            </ul>
            </div>
            </div>
            
          </div>
          
        </div>
      </nav>
          
        

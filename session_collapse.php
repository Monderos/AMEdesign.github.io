<div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="font-roboto fw-bold"> <?php
                             echo $_SESSION["useruid"];
                              ?></span>
                        </a>
                        <ul class="dropdown-menu menu" aria-labelledby="navbarDropdownMenuLink">   
                        <li>
                        <?php
                        if($_SESSION["isadmin"]!=NULL){
                          echo('<a class="dropdown-item" href="admin_index.php">Admin Panel</a>');
                        }
                        else{
                          echo('<a class="dropdown-item" href="profile.php">Profil</a>');
                        }
                        ?>
                        </li>
                        <li><a class="dropdown-item" href="comenzile_mele.php">comenzi</a></li>
                          <li><a class="dropdown-item" href="INC/logout.inc.php">log out</a></li>
                          
                        </ul>
                      </li>
            </ul>
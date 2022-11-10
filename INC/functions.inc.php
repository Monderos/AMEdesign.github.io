

<?php
//definirea functilor

//SIGNUP

//de adaugat functie pt limitarea caracterelor userului

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    //$mistake;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
    $mistake=true;    

    }
    else{
        $mistake=false;
    }
    return $mistake;
}

function tooLong($any){
            
    if(strlen($any) >=50){
    $mistake=true;    

    }
    else{
        $mistake=false;
    }
    return $mistake;
}

function invalidUid($username){
   // $mistake;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    $mistake=true;    

    }
    else{
        $mistake=false;
    }
    return $mistake;
}
function invalidEmail($email){
       // $mistake;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $mistake=true;    
    
        }
        else{
            $mistake=false;
        }
        return $mistake;    
}
function pwdMatch($pwd, $pwdRepeat){
   // $mistake;
    if($pwd!==$pwdRepeat){
    $mistake=true;    
    }
    else{
        $mistake=false;
    }
    return $mistake;
}
function uidExists($connection, $username, $email){
  $sql="SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
  //prepared statement pentru SQL injection
  $stmt =mysqli_stmt_init($connection);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=failure");
    exit();
}

mysqli_stmt_bind_param($stmt, "ss", $username, $email);
mysqli_stmt_execute($stmt);
$rst=mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($rst)){
return $row;
}
else{
    $mistake=false;
    return $mistake;
}

mysqli_stmt_close($stmt);
}


function createUser($connection, $name, $email, $username, $pwd){
    $sql="INSERT INTO users (userName, userEmail, userUid, userPwd) VALUES (?, ?, ?, ?);";
    //prepared statement anti SQL injection
    //initializarea stmt
    $stmt =mysqli_stmt_init($connection);
    //prepararea stmt
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../signup.php?error=failure");
      exit();
  }
  //hashing prin metoda default a php-ului
  $hashPwd=password_hash($pwd, PASSWORD_DEFAULT,);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();
  }







  //LOGIN

  function emptyInputLogin($username, $pwd){
    //$mistake;
    if(empty($username) || empty($pwd)){
    $mistake=true;    

    }
    else{
        $mistake=false;
    }
    return $mistake;
}

function loginUser($connection,$username,$pwd){
    $uidExists = uidExists($connection, $username, $username);

    if($uidExists===false){
header("location: ../login.php?error=incorrectUser");
exit();
    }


    //Cautarea coloanei unde exista parola
$pwdHash=$uidExists["userPwd"];
$pwdChecker=password_verify($pwd,$pwdHash);

if($pwdChecker===false){
    header("location:../login.php?error=incorrectPwd");
    exit();
}
else if($pwdChecker===true){

//pornire sesiuni
session_start();
$_SESSION["userid"]=$uidExists["userId"];
$_SESSION["useruid"]=$uidExists["userUid"];
$_SESSION["username"]=$uidExists["userName"];
$_SESSION["useremail"]=$uidExists["userEmail"];
$_SESSION["userphone"]=$uidExists["userPhone"];
$_SESSION["usercity"]=$uidExists["userCity"];
$_SESSION["useraddress"]=$uidExists["userAddress"];
$_SESSION["userpwd"]=$uidExists["userPwd"];
$_SESSION["isadmin"]=$uidExists["isAdmin"];


$_SESSION["auth"]=true;

    if($_SESSION["isadmin"]!=NULL){
        header("location:../admin_index.php");
    }
else
{
header("location:../index.php");
}
exit();
}
}

//UPDATES


//PROFILE UPDATE


function updateUser($connection,$name,$email,$username,$pwd,$phone,$city,$address){
    
    
    $sql="UPDATE users SET userName='$name',userEmail='$email', userUid='$username', userPwd='$pwd',
     userPhone='$phone', userCity='$city', userAddress='$address' WHERE userId='{$_SESSION["userid"]}'";
    $stmt =mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile_update.php?error=failure");
        exit();
    }
  
    mysqli_stmt_bind_param($stmt,"sssssss", $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile_update.php?error=none");
    clearstatcache();
    exit();

    }

    //CATEGORIE UPDATE

function updateCategorie($connection, $categNume, $categId){
    $sql="UPDATE tablou_categorie SET categNume='$categNume' WHERE categId='$categId'";
    $stmt =mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../editare_categorie.php?error=failure&id=$categId");
        exit();
    }
  
    mysqli_stmt_bind_param($stmt,"s", $categNume);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../editare_categorie.php?error=none&id=$categId");
    exit();

    }

    
function updateImagine($connection, $test, $filename,$id){
    $sql="UPDATE tablou SET $test='$filename' WHERE tablouId='$id'";
    $stmt =mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../editare_tablou.php?error=failure&id=$id");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s", $filename);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    }

       function updateTablou($connection, $tablouName, $tablouDesc, $tablouAdaos, $tablouAutor, $tablouId){
        $sql="UPDATE tablou SET tablouName='$tablouName', tablouDesc='$tablouDesc', tablouAdaos='$tablouAdaos',
        tablouAutor='$tablouAutor' WHERE tablouId='$tablouId'";
        $stmt =mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../editare_tablou.php?error=failure&id=$tablouId");
            exit();
        }
      
        mysqli_stmt_bind_param($stmt,"ssss", $tablouName, $tablouDesc, $tablouAdaos, $tablouAutor);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    
        }

    function uidExistsUpdate($connection, $username){
        $sql="SELECT * FROM users WHERE userUid = ?;";
        //prepared statement pentru SQL injection
        $stmt =mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../profile_update.php?error=failure");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $rst=mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($rst)){
        return $row;
        }
        else{
            $mistake=false;
            return $mistake;
        }
        
        mysqli_stmt_close($stmt);
        }

    function emailExistsUpdate($connection, $email){
        $sql="SELECT * FROM users WHERE userEmail = ?;";
        //prepared statement pentru SQL injection
        $stmt =mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../profile_update.php?error=failure");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $rst=mysqli_stmt_get_result($stmt);
        
        if($row = mysqli_fetch_assoc($rst)){
        return $row;
        }
        else{
            $mistake=false;
            return $mistake;
        }
        
        mysqli_stmt_close($stmt);
        }

        function invalidPhone($phone){
            
            if(!is_numeric($phone) || strlen($phone) !==10){
            $mistake=true;    
        
            }
            else{
                $mistake=false;
            }
            return $mistake;
        }

        

       
        //Phone verificator
        //Name and user maximum char





        //INSERARE PRODUSE
        function insertTablou($connection, $path, $filename, $titlu, $descriere, $adaos, $filename2, $filename3, $filename4, $filename5, $filename6, $autor, $categorie){
            $sql="INSERT INTO tablou (tablouImage, tablouName, tablouDesc, tablouAdaos, tablouImage2, tablouImage3, tablouImage4, tablouImage5, tablouImage6,tablouAutor, tablouCateg) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?,?);";
            //prepared statement anti SQL injection
            //initializarea stmt
            $stmt =mysqli_stmt_init($connection);
            //prepararea stmt
          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: ../inserare_tablou.php?error=failure");
              exit();
          }
          mysqli_stmt_bind_param($stmt, "sssssssssss", $filename, $titlu, $descriere, $adaos, $filename2, $filename3, $filename4,$filename5,$filename6, $autor, $categorie);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          move_uploaded_file($_FILES['imagine']['tmp_name'], $path.'/'.$filename);
          move_uploaded_file($_FILES['imagine2']['tmp_name'], $path.'/'.$filename2);
          move_uploaded_file($_FILES['imagine3']['tmp_name'], $path.'/'.$filename3);
          move_uploaded_file($_FILES['imagine4']['tmp_name'], $path.'/'.$filename4);
          move_uploaded_file($_FILES['imagine5']['tmp_name'], $path.'/'.$filename5);
          move_uploaded_file($_FILES['imagine6']['tmp_name'], $path.'/'.$filename6);
          
          header("location: ../inserare_tablouri.php?error=none");
          }

          function insertRollup($connection, $path, $filename, $titlu, $descriere){
            $sql="INSERT INTO roll_up (rollupImage, rollupName, rollupDesc) VALUES (?, ?, ?);";
            //prepared statement anti SQL injection
            //initializarea stmt
            $stmt =mysqli_stmt_init($connection);
            //prepararea stmt
          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: ../inserare_tablouri.php?error=failure");
              exit();
          }
          mysqli_stmt_bind_param($stmt, "sss", $filename, $titlu, $descriere);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);
          move_uploaded_file($_FILES['imagine']['tmp_name'], $path.'/'.$filename);
          
          header("location: ../inserare_tablouri.php?error=none");
          exit();
          }


//INSERARE CATEGORIE
function insertCateg($connection, $numeCateg){
    $sql="INSERT INTO tablou_categorie (categNume) VALUES (?);";
    //prepared statement anti SQL injection
    //initializarea stmt
    $stmt =mysqli_stmt_init($connection);
    //prepararea stmt
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../inserare_categorii.php?error=failure");
      exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $numeCateg);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../inserare_categorii.php?error=none");
  exit();
  }



  //Insert intro tablouANDcategorie
  function insertTablouAndCategorie($connection, $idCateg, $idTablou){
    $sql="INSERT INTO tablousicategorie (categId, tablouId) VALUES (?, ?);";
    //prepared statement anti SQL injection
    //initializarea stmt
    $stmt =mysqli_stmt_init($connection);
    //prepararea stmt
  if (!mysqli_stmt_prepare($stmt, $sql)) {
   
  }
  mysqli_stmt_bind_param($stmt, "ss", $idCateg, $idTablou);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);


  }


// GET FUNCTIONS
  

    //GET IDprodus function
    function getIdProdus($connection){
        $sql="SELECT MAX(tablouId) FROM tablou";
        return $sql_run =mysqli_query($connection, $sql);
    }



  
  function categExists($connection, $numeCateg){
    $sql="SELECT * FROM tablou_categorie WHERE categNume = ?;";
    //prepared statement pentru SQL injection
    $stmt =mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../inserare_categorii.php?error=failure");
      exit();
  }
  
  mysqli_stmt_bind_param($stmt, "s", $numeCateg);
  mysqli_stmt_execute($stmt);
  $rst=mysqli_stmt_get_result($stmt);
  
  if($row = mysqli_fetch_assoc($rst)){
  return $row;
  }
  else{
      $mistake=false;
      return $mistake;
  }
  
  mysqli_stmt_close($stmt);
  }
  



function getAll($connection,$tabel){
    $sql="SELECT * FROM $tabel";
    return $sql_run=mysqli_query($connection,$sql);
    
}
          //GET ALL function
          function getAllOrdered($connection, $tabel, $orderby){
         
                $sql="SELECT * FROM $tabel order by $orderby";
                return $sql_run =mysqli_query($connection, $sql);

              
          }

          function getTabelWhereId($connection, $tabel, $idtabel, $id){
              $sql="SELECT * FROM $tabel WHERE $idtabel='$id'";
              return $sql_run =mysqli_query($connection, $sql);
              
          }

          function getTabelWhereLikeId($connection, $tabel, $idtabel, $id){
            $sql="SELECT * FROM $tabel WHERE $idtabel LIKE '%".$id."%'";
            return $sql_run =mysqli_query($connection, $sql);
            
        }


function getUnique($connection, $coloana, $tabel){
    $sql="SELECT DISTINCT $coloana FROM $tabel";
    // $sql="SELECT tablouAutor FROM tablou GROUP  BY tablouAutor HAVING COUNT(tablouAutor)=1";
    return $sql_run=mysqli_query($connection,$sql);
    
}




//cart




function getCart($connection){
    $userid=$_SESSION['userid'];
    $sql="SELECT c.cartId as cid, c.tablouId, c.qty, c.materialId, c.dimensiuneId, c.ramaId, c.pret_qty1,
    t.tablouId as tid, t.tablouImage, t.tablouName, t.tablouAutor,
     m.materialId, m.materialName,
     d.dimensiuneId, d.dimensiuneName,
     r.ramaId, r.ramaName
      FROM cart c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r
     WHERE c.tablouId=t.tablouId AND c.materialId=m.materialId AND c.dimensiuneID=d.dimensiuneID AND c.ramaId=r.ramaId
     AND c.userId='$userid' ORDER BY c.cartId DESC";
    return $sql_run=mysqli_query($connection,$sql);
}


function getCartandUser($connection){
    $userid=$_SESSION['userid'];
    $sql="SELECT c.cartId as cid, c.tablouId, c.materialId, c.dimensiuneId, c.ramaId, c.qty,
     u.userName, u.userEmail, u.userPhone, u.userCity, u.userAddress
      FROM cart c, users u
     WHERE c.userId='$userid')";
    return $sql_run=mysqli_query($connection,$sql);

}




function countCart($connection){
   
    if(isset($_SESSION['auth']))
    {
$Id=$_SESSION['userid'];
    }
else
{
$Id=NULL;
}
$sql="SELECT SUM(qty) AS qty
FROM cart
WHERE userId='$Id'";
return $sql_run=mysqli_query($connection,$sql);
}


//FILTRE

  //GET COMANDA functions

  function getComanda($connection){
         
    $sql="SELECT c.userId,c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda, c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId
    AND c.comandaFinalizata='nu'
    GROUP BY c.facturaAID
     order by dateComanda DESC";
     
     return $sql_run =mysqli_query($connection, $sql);

  
}

function getComandaAll($connection){
         
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId
    GROUP BY c.facturaAID
    order by fin, c.dateComanda";
     
     return $sql_run =mysqli_query($connection, $sql);

  
}
function getComandaAllName($connection, $Name){
         
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId
    AND (c.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR t.tablouName LIKE '%".$Name."%' OR c.facturaAID='$Name')
   GROUP BY c.facturaAID
   order by fin";
     
     return $sql_run =mysqli_query($connection, $sql);

  
}
function getComandaName($connection, $Name){
         
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId
    AND (c.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR t.tablouName LIKE '%".$Name."%' OR c.facturaAID='$Name') AND c.comandaFinalizata='nu'
    GROUP BY c.facturaAID
    order by dateComanda DESC";
     
     return $sql_run =mysqli_query($connection, $sql);

  
}


function getComandaDate($connection, $Date, $Date2){

    if($Date2==""){
        $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
        c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
         t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
         m.materialId, m.materialName,
         r.ramaId,  r.ramaName,
         d.dimensiuneId, d.dimensiuneName,
         u.userCity, u.userId
        FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
        WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId
     AND c.comandaFinalizata='Nu' AND c.dateComanda LIKE '%" .$Date."%'
     GROUP BY c.facturaAID
         order by dateComanda DESC";
         
         return $sql_run =mysqli_query($connection, $sql);
    }
   else{
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d,tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId 
    AND c.comandaFinalizata='Nu' AND c.dateComanda BETWEEN '".$Date."' and '".$Date2."'
    GROUP BY c.facturaAID
     order by dateComanda DESC";
     
     return $sql_run =mysqli_query($connection, $sql);
   }

  
}

function getComandaAllDate($connection, $Date, $Date2){
         
    if($Date2==""){
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
    c.dateComanda LIKE '%" .$Date."%'
    GROUP BY c.facturaAID
    order by fin";
     
     return $sql_run =mysqli_query($connection, $sql);
    }
    else{
        $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
        c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
         t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
         m.materialId, m.materialName,
         r.ramaId,  r.ramaName,
         d.dimensiuneId, d.dimensiuneName,
         u.userCity, u.userId
        FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
        WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
        c.dateComanda BETWEEN '".$Date."' and '".$Date2."' 
        GROUP BY c.facturaAID
        order by fin";
         return $sql_run =mysqli_query($connection, $sql);
    }

  
}
function getComandaAllNameDate($connection, $Date, $Name, $Date2){
    if($Date2==""){
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
    c.dateComanda LIKE '%" .$Date."%' AND (c.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR t.tablouName LIKE '%".$Name."%' OR c.facturaAID='$Name')
    GROUP BY c.facturaAID
    order by fin";
     
     return $sql_run =mysqli_query($connection, $sql);
    }
    else{
        $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId,  SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
        c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
         t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
         m.materialId, m.materialName,
         r.ramaId,  r.ramaName,
         d.dimensiuneId, d.dimensiuneName,
         u.userCity, u.userId
        FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
        WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
        c.dateComanda BETWEEN '".$Date."' and '".$Date2."' AND (c.userName LIKE '%".$Name."%' OR u.userCity LIKE '%".$Name."%' OR t.tablouName='$Name' OR c.facturaAID='$Name')
    GROUP BY c.facturaAID
    order by fin";
         
         return $sql_run =mysqli_query($connection, $sql);
    }
  
}

function getComandaNameDate($connection, $Date, $Name,$Date2){
    if($Date2==""){
    $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId, SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
    c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
     t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName,
     u.userCity, u.userId
    FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
    WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
    c.dateComanda LIKE '%" .$Date."%' AND (c.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR t.tablouName LIKE '%".$Name."%' OR c.facturaAID='$Name') AND c.comandaFinalizata='Nu'
   GROUP BY c.facturaAID
   order by fin";
     
     return $sql_run =mysqli_query($connection, $sql);
    }
    else{
        $sql="SELECT c.userId, c.comandaId, c.userName, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId, SUM(c.qty) as qty, SUM(c.pretComanda) as pretComanda,
        c.comandaFinalizata as fin, c.facturaComanda,c.facturaAID as AID,
         t.tablouId, GROUP_CONCAT(t.tablouName) as tablouName,
         m.materialId, m.materialName,
         r.ramaId,  r.ramaName,
         d.dimensiuneId, d.dimensiuneName,
         u.userCity, u.userId
        FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r, users u
        WHERE t.tablouId=c.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId AND u.userId=c.userId AND
        c.dateComanda BETWEEN '".$Date."' and '".$Date2."' AND (c.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR t.tablouName LIKE '%".$Name."%' OR c.facturaAID='$Name') AND c.comandaFinalizata='Nu'
     GROUP BY c.facturaAID
     order by fin";
         
         return $sql_run =mysqli_query($connection, $sql);
    }
}


//get users

function getUsers($connection){
    $sql="SELECT u.userId, u.userName, u.userEmail, u.userUid, u.userPhone, u.userCity, u.userAddress
    FROM users u";
     return $sql_run =mysqli_query($connection, $sql);
}

function getUsersName($connection, $Name){
    $sql="SELECT u.userId, u.userName, u.userEmail, u.userUid, u.userPhone, u.userCity, u.userAddress
    FROM users u
    WHERE u.userName LIKE '%".$Name."%' OR u.userCity='$Name' OR u.userAddress LIKE '%".$Name."%'";
     return $sql_run =mysqli_query($connection, $sql);
}



//comenzile_mele

function getComenzile_Mele($connection, $userid){
$sql="SELECT c.comandaId, c.userId, c.tablouId, c.dateComanda, c.materialId, c.dimensiuneId, c.ramaId, c.qty, c.pretComanda,
c.comandaFinalizata as fin, c.facturaComanda,
     t.tablouId, t.tablouName, t.tablouImage,
     m.materialId, m.materialName,
     r.ramaId,  r.ramaName,
     d.dimensiuneId, d.dimensiuneName
FROM comanda c, tablou t, tablou_material m, tablou_dimensiune d, tablou_rama r
WHERE c.userId='$userid' AND c.tablouId=t.tablouId AND c.materialId=m.materialId AND c.dimensiuneId=d.dimensiuneId AND c.ramaId=r.ramaId
order by fin DESC";
return $sql_run=mysqli_query($connection,$sql);
}


//filter tablouri

//cautare dupa nume
function getTablouName($connection, $filter){
    
$sql="SELECT * FROM tablou
WHERE tablouName LIKE '%".$filter."%' ";
$sql_run =mysqli_query($connection, $sql);
}

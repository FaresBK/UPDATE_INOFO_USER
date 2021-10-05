<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="../image/tele.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../image/tele.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Bootstrap
    </a>
  </div>
</nav>
<?php
session_start();
if(isset($_SESSION['role'])){
if($_SESSION['role']->ROLE==="admin"){
    echo "<div class='container'><form mathod='POST' class ><button class='btn btn-dark mt-3' type='submit' name='click'>Logout</button> </form></div>"; 
    echo "<div class='container'><a class='btn btn-outline-info mt-3'  href='http://localhost:1313/serveur/ADMIN/profil.php'>modifier-تعديل</a></div>"; 
}else{
    header("location:http://localhost:1313/serveur/login.php",true);
    die("");
}

}else{
    header("location:http://localhost:1313/serveur/login.php",true);
    die("");
}
if(isset($_GET['click'])){
 session_unset();
 session_destroy();
 header("location:http://localhost:1313/serveur/login.php",true);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>


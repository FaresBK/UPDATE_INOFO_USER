<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
 <?php require_once "navbar.php" ?> 
<body><div class="container">
<form method="POST">
  <section class="mt-3">email : <input class="form-control " type="email" name="email" id="email" require></section> <br> 
  password :<input  class="form-control" type="password" name="password" id="password" require><br>
  <button type="submit" class="btn btn-success mt-3" onclick="clicke()"; name="test">Connexion</button>
  <a class="btn btn-dark mt-3"  href="test.php">Inscription</a>
</form>
</div>  
<script src="scripte/login.js"></script>
</body>
</html>
<?php
if(isset($_POST['test'])){
 $username="root";
 $password="";
 $database=new PDO("mysql:host=localhost;dbname=users;charset=utf8",$username,$password);
 $email=$_POST['email'];
 $password=$_POST['password'];
 $verifi=$database->prepare("SELECT * FROM user WHERE email=:EMAIL AND password=:PASSOWRD");
 $verifi->bindParam("EMAIL",$email);
 $verifi->bindParam("PASSOWRD",$password);
 $verifi->execute();
  if($verifi->rowCount()===1){
     $objet=$verifi->fetchObject();
     if($objet->activeted ==="1"){
      echo '<br><div class="container">
            <div class="alert alert-success container">
            <strong>Logine Success!</strong> Inscription Avec Success.
            </div>
            </div>'; 
            session_start();
            $_SESSION['role']=$objet;
          if($objet->ROLE==='user'){
               header("location:USER/indx.php",true);
          }else if($objet->ROLE==='admin'){
          header("location:ADMIN/indx.php",true);
          }else if($objet->ROLE==='superadmin'){
          header("location:SUPER_ADMIN/indx.php",true);
          }     
            
     }else{
        '<br><div class="container mt-3" >
         <div class="alert alert-warning container">
         <strong>erour!</strong> Activer Votre  Compte .
         </div>
         </div>' ;
    }
  }else{
    echo '<br><div class="container mt-3" >
          <div class="alert alert-warning container">
          <strong>erour!</strong> viréfier votre email ou mot de pass.
          </div>
          </div>';

  }
}

?>
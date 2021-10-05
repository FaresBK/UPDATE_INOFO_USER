<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<?php
if(isset($_GET['code'])){
    $user="root";
    $password="";
    $database=new PDO("mysql:host=localhost;dbname=users;charset=utf8",$user,$password);
    $checkCode = $database->prepare("SELECT security FROM user WHERE security = :SECURITY_CODE");
    $checkCode->bindParam("SECURITY_CODE",$_GET['code']);
    $checkCode->execute();
if($checkCode->rowCount()>0){
       $update = $database->prepare("UPDATE user SET security = :NEWSECURITY_CODE ,
             activeted=true WHERE security = :SECURITY_CODE");
        $securityCode = md5(date("h:i:s"));
        $update->bindParam("NEWSECURITY_CODE",$securityCode);
        $update->bindParam("SECURITY_CODE",$_GET['code']);
        if($update->execute()){
            echo '<div class="container">
            <div class="alert alert-success container mt-3">
            <strong>Success!</strong> Inscription Avec Success.
          </div>
          </div><br>';
          echo '<a class="btn  btn-primary" href="login.php">Connexion</a>';
        }
      }else{
            echo '<br> <div class="container">
            <div class="alert alert-warning container mt-3">
            <strong>euror!</strong> this code is not valibel .
          </div>
          </div>';
        }
        


} 
?>

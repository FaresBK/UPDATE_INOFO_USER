<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="../image/tele.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<?php
      session_start();
      if(isset($_SESSION['role'])){
          if($_SESSION['role']->ROLE === "superadmin"){
       echo '<main class="container mt-3">
       <form method="POST">
       <div>Nom:</div>    
       <input type="text"  class="form-control" name="name" value="'.$_SESSION['role']->nom.'" require>
       <div>Prenom:</div>
       <input type="text" class="form-control" name="prenom" value="'.$_SESSION['role']->prenom.'" require>
       <div>Age:</div>
       <input type="date" class="form-control" name="datee" value="'.$_SESSION['role']->age.'" require>
       <div>email:</div>
       <input type="email" class="form-control" name="email" value="'.$_SESSION['role']->email.'" require>
       <div>password:</div>
       <input type="text" class="form-control" name="password" value="'.$_SESSION['role']->password.'" require><br>
       <Button type="submit" class="btn btn-outline-info mt-3" name="click" value="'.$_SESSION['role']->id.'">Update-تعديل</Button><br>
       <a class="btn btn-outline-dark mt-3"  href="indx.php" >Roturn-رجوع</a>
       </form>
       </main>';
       
       if(isset($_POST['click'])){
       $username="root";
       $password="";
       $database=new PDO("mysql:host=localhost;dbname=users;charset=utf8",$username,$password);
       $update=$database->prepare("UPDATE user SET nom =:name ,prenom=:prenom , age=:Age ,email=:email,password=:pass WHERE id=:id");
       $update->bindParam("name",$_POST['name']);
       $update->bindParam("prenom",$_POST['prenom']);
       $update->bindParam("Age",$_POST['datee']);
       $update->bindParam("email",$_POST['email']);
       $update->bindParam("pass",$_POST['password']);
       $update->bindParam("id",$_POST['click']);
       if($update->execute()){
          echo '<script language="javascript"> alert("تم التعديل بنجاح ");</script>';
              $inscri=$database->prepare("SELECT * FROM user WHERE id=:id");
              $inscri->bindParam("id",$_POST['click']);
              $inscri->execute();
              $_SESSION['role']=$inscri->fetchObject();
              header("refresh:1;");
          }else{
          echo '<script language="javascript"> alert("لم يتم التعدثل بنجاح ");</script>';
          }
      }
     }else{
        session_unset();
        session_destroy();
        header("location:http://localhost:1313/serveur/login.php",true);
        die("");
    }
}else{
    session_unset();
    session_destroy();
    header("location:http://localhost:1313/serveur/login.php",true);
    die("");
} 
    ?>
</body>
</html>

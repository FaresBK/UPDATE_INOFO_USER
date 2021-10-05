<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<?php require_once "navbar.php" ?> 
    <div class="container">
    <form method="POST">
     Non :<input class="form-control" type="text" name="nom" id="name" required><br>
     Prenom :<input type="text" class="form-control" name="prenom" id="prenom" required ><br>
     Age :<input type="date" class="form-control" name="age" id="date" required ><br>
     Email :<input type="email" class="form-control" name="email" id="email" required ><br>
     Pasword:<input type="password" class="form-control" name="Pasword"  id="password" required ><br>
     Confirem Pasword:<input type="password" class="form-control"  name="confpassword"  id="confpassword" required ><br>
    <button class="btn  btn-primary mt-3" tupe="submit" name="registr" onclick="clicki()" required>Inscription</button>
    <a class="btn btn-dark mt-3" href="login.php">Connexion</a>  
    </form>
</div>
<script src="scripte/javascripte.js"></script>
</body>
</html>

<?php
$user="root";
$password="";
$database=new PDO("mysql:host=localhost;dbname=users;charset=utf8",$user,$password);
if(isset($_POST['registr'])){
$name=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['age'];
$email=$_POST['email'];
$password=$_POST['Pasword'];
$confpassword=$_POST['confpassword'];
$chickemail=$database->prepare("SELECT * FROM user WHERE email =:EMAIL");
$chickemail->bindParam("EMAIL",$email);
$chickemail->execute();

if($password !== $confpassword){
    echo '<br><div class="container">
    <div class="alert alert-warning container">
    <strong>Warning!</strong> Password inccorect.
  </div>
  </div>';
}else if($chickemail->rowCount()>0){
    echo '<br><div class="container">
    <div class="alert alert-warning container">
    <strong>Warning!</strong> votre email est existe.
  </div>
  </div>';
}else{
$data=$database->prepare("INSERT INTO user(nom,prenom,age,email,password,activeted,security,ROLE) VALUES (:nam,:prenome,:age,:email,:motdepass,false,:secritycode,'user')");
$data->bindParam("nam",$name);
$data->bindParam("prenome",$prenom);
$data->bindParam("age",$date);
$data->bindParam("email",$email);
$data->bindParam("motdepass",$password);
$secrycode = md5(date("h:i:s"));
$data->bindParam("secritycode",$secrycode);
if($data->execute()){
    echo '<br><div class="container">
    <div class="alert alert-success container">
    <strong>Success!</strong> Inscription Avec Success.
  </div>
  </div>';
  
  require_once "mail.php";
  require_once "mail.php";
  $mail->SetFrom('faresoz122@gmail.com','dz موقع شوبي ');
  $mail->AddAddress($email);     // Add a recipient

  $mail->Subject = 'تأكيد التسجيل ';
  $mail->Body  =  '<h1> شكرا لتسجيلك في موقعنا</h1>'
  . "<div> رابط تحقق من حساب" . "<div>" . 
  "<a href='http://localhost:1313/serveur/active.php?code=".$secrycode  . "'>
   " . "http://localhost:1313/serveur/active.php?code=" .$secrycode . "</a>";
  ;
  $mail->Send();
}
}
}
?>
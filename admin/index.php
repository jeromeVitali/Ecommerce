<?php

session_start();


$user='jerome.vitali';
$password_definit='azerty';


if(isset($_POST['submit'])){ 

$username=$_POST['username'];
$password=$_POST['password'];
// test si les 2 champs sont remplis

if($username&&$password){ 

if($username==$user&&$password==$password_definit){ //test


$_SESSION['username']=$username; //pour que la session soit valable sur ttes les pages 
header('Location:admin.php');

}else{

echo "Identifiants incorrects." ;

}

}else{

echo "Veuillez remplir tous les champs." ;
}
}

?>

<link rel="stylesheet" type="text/css" media="screen" href="../style/bootstrap.css">
<link rel="stylesheet" type="text/css" media="screen" href="../style/perso.css">

<h1>Administration - Connection</h1>
<form action="" method="POST">
<h3>Pseudo :</h3><input type="text" name="username"/>
<h3>Mot de passe:</h3><input type="password" name="password"/>
<input type="submit" name="submit"/>
</form>
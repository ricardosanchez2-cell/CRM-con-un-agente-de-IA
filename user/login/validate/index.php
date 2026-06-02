<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/');
    exit();
}

else{
 
$formUsername = $_POST['username'];
$formPassword = $_POST['password'];

$user = 'r@mail.cl';
$pass = '123';


if ($user == $formUsername  &&  $pass ==$formPassword) {
    $_SESSION['user_id'] = 1; 
    $_SESSION['username'] = 'rick';
    header("Location: ../../../admin/");
    exit();
} else {
    echo "user y pass malos ";
}
}

$_SESSION["error"] = ['login' => 'Usuario y/o contraseña incorrectos'];
header("Location: ../../../admin/");

?>

<?php

session_start();

if(isset($_SESSION['user_id'])){
    //usuario logeado
    header("Location: ../../../dashboard/");
    exit(); //siempre que haya un redireccionamiento
}
   
   $FromUsername = $_POST['username'];
   $FromPassword = $_POST['password'];
   
   
   $user = 'proyecto@web.cl';
   $pass = 'holaMundo';

   if($user == $FromUsername && $pass == $FromPassword){
       $_SESSION['user_id'] = 1;
       $_SESSION['user_name'] = 'Alumno';
       header("Location: ../../../dashboard/");
    exit(); //siempre que haya un redireccionamiento
}
       echo' usuario y contraseña malos';
?>
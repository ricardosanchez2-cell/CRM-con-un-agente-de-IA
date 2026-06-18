<?php

//iniciar o reanudar la sesion del usurio actual
session_start();

//var_dump($_SESSION[""]);
//echo'<pre>';
//var_dump($_SERVER);
//echo'<pre>';

if(isset($_SESSION['user_id'])){
    //usuario logeado
    header("Location: public/");
    exit(); //siempre que haya un redireccionamiento
}
else{
    //usuario no logeado
    header("Location: public/user/");
    exit(); //siempre que haya un redireccionamiento
}
?>
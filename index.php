<?php

session_start();
session_unset();
session_destroy();

if (isset($_SESSION['user_id'])) 
{
    header('Location: ../../admin/');
    exit();

} 
else 
{
    header('Location: ../user/login/');
    exit();
}
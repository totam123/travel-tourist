<?php
    require_once __DIR__. '/autoload.php';

    if (isset($_SESSION['id_user']))
    {
        unset($_SESSION['id_user']);
        unset($_SESSION['email_user']);
    }
    header("Location: ".redirectUrl().$_SERVER["HTTP_REFERER"]);exit(); 
?>
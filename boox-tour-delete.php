<?php
    require_once __DIR__. '/autoload.php';

    if( isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if (!isset($_SESSION['url_redirect']))
    {
        $_SESSION['url_redirect'] = $_SERVER["HTTP_REFERER"];
    }
    if(isset($_SESSION['cart']))
    {
        if(isset($_SESSION['cart'][$id]))
        {
            unset($_SESSION['cart'][$id]);
        }
    }

    unset($_SESSION['cart']);

    $url = $_SESSION['url_redirect'];
    unset($_SESSION['url_redirect']) ;

    header("Location: ".redirectUrl().$url);exit();
?>




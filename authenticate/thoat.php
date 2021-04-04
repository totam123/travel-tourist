<?php
    require_once __DIR__. '/../autoload.php';
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_level']);
    unset($_SESSION['admin_id']);
    $_SESSION['success'] = ' Đăng xuất thành công ! Cảm ơn bạn đã quan tâm tới website ';
    header("Location: ".path_url().'/authenticate/login.php');exit();
?>
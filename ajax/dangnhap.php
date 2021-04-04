<?php
    require_once __DIR__. '/../autoload.php';
    $email    = Input::get('email');
    $password = Input::get('password');
    $user = DB::fetchOne('users', ' u_email = "'.$email.'" and u_password = "'.md5($password).'" and u_active = 1 LIMIT 1');    if(count($user )> 0)
    {
        $_SESSION['id_user']    = $user['id'];
        $_SESSION['image_user'] = $user['u_avatar'];
        $code = 1;
    }else
    {
        $code = 0;
    }
    echo $code;
?>
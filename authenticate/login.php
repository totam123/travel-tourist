<?php
    session_start();
    @ob_start();
    require_once __DIR__ .'/../vendor/init.php';
    require_once __DIR__ .'/../config.php';
    if (  isset($_SESSION['admin_name']))
    {
        header("Location: ".path_url().'/admin');exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $email    = Input::get("email");
        $password = Input::get("password");
        if($email == '')
        {
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($password == '')
        {
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if(empty($errors))
        {
            $admins = DB::fetchOne('admins', ' email = "'.$email.'" and password = "'.md5($password).'" and status = 1  LIMIT 1');
            if ($admins)
            {
                $_SESSION['success'] = " Xin chào " .$admins['name'] . " đã đăng nhập vào hệ thống thành công ";
                $_SESSION['admin_name']  = $admins['name'];
                $_SESSION['admin_level'] = $admins['level'];
                $_SESSION['admin_id']    = $admins['id'];
                header("Location: ".path_url().'/admin');exit();
            }
            
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Đăng nhập hệ thống website </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/public/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/admin/css/ionicons.min.css">
    <link rel="stylesheet" href="/public/admin/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/public/admin/css/_all-skins.min.css">
    <link rel="stylesheet" href="/public/admin/css/custome.css">
    <link rel="stylesheet" href="/public/app/css/base.css">
</head>
<body class="hold-transition login-page" style="background:#FFEBCD">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Admin</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg" style="color: red;">Đăng nhập để bắt đầu phiên làm việc</p>
        <form action="" method="post">
            <input type="hidden" name="_token" value="WkxU2rRfT9DZyMi1u9iOvmSTCdSEgpJ7eaiSDlYq">
            <div class="form-group has-feedback">
                <!--admin@gmail.com || admin12345-->
                <input type="email" class="form-control" name="email" placeholder="" autocomplete="off" value="admin@gmail.com">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                <?php if(isset($errors['email'])) :?>
                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['email'] ?></span>
                <?php endif ;?>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="********" autocomplete="off" value="12345678">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if(isset($errors['password'])) :?>
                    <span class="color-red"><i class="fa fa-bug"></i><?= $errors['password'] ?></span>
                <?php endif ;?>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="background:#4682B4">Đăng nhập</button>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
</div>
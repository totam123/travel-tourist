<?php
    require_once __DIR__. '/autoload.php';
    $active = "user";

    if (!isset($_SESSION['url_redirect']))
    {
        $_SESSION['url_redirect'] = $_SERVER["HTTP_REFERER"];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $email    = Input::get("email");
        $password = Input::get("password");
        

        // kiểm tra lỗi
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }
        
        
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if(empty($errors))
        {
           
            //tiến hành insert 
            $checkLogin = DB::fetchOne('users',' u_email = "'.$email.'" and u_password = "'.md5($password).'"');
        
            if($checkLogin)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                
                $_SESSION['id_user']  = $checkLogin['id'];
                $_SESSION['email_user']  = $email;

                $url = $_SESSION['url_redirect'];
                unset($_SESSION['url_redirect']) ;
                $_SESSION['success'] = ' Đăng nhập thành công ';
                header("Location: ".redirectUrl().$url);exit();
            }
            else 
            {
                $errors['saitt'] = 'Sai thông tin đăng nhập';
            }
            
        }   
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>


<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-5 col-md-offset-1 mg-t-40 mg-bt-40">
            <!-- NEW -->
            <div class="box">
                <form method="POST" action="">
                    <div class="box-body">
                        
                            <h3 class="title"><b>Đăng nhập</b></h3>
                            <?php if (isset($errors['saitt'])) :?>
                                <span><?= $errors['saitt'] ?></span>
                            <?php endif ; ?>
                            <div class="form-group">
                                <label>
                                    Email<small class="red">*</small>
                                </label>
                                <input type="text" class="ip-email form-control" name="email" value="">
                                <?php if (isset($errors['password'])) :?>
                                    <span><?= $errors['password'] ?></span>
                                <?php endif ; ?>
                            </div>

                            <div class="form-group">
                                <label>
                                    Mật khẩu<small class="red">*</small>
                                </label>
                                <input type="password" class="form-control" name="password">
                                <?php if (isset($errors['password'])) :?>
                                    <span><?= $errors['password'] ?></span>
                                <?php endif ; ?>
                            </div>

                        

                        <div class="title-lg mg-bt-20" style="padding-bottom: 0">
                        </div>

                        <div class="sign-up-footer">
                            <p><b>Đã có tài khoản TAM Travel?</b></p>
                                <a href="/forgot_pass.php">Quêm mật khẩu</a>
                            <button type="submit" class="btn">Đăng nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5 col-md-offset-1 mg-t-40 mg-bt-40">
            <div class="box benefit">
                <p class="special" style="color:green;font-size:30px;"><b>Lợi ích khi tạo tài khoản</b></p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Đặt phòng với giá giảm đến 20%.</p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Tích lũy điểm thưởng với mỗi đơn tour.</p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Nhận ưu đãi đặc biệt chỉ dành cho thành viên.</p>
            </div>
        </div>
    </div>
</div>
<?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
</body>
    </html>
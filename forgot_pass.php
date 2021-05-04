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
       
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        $checkLogin = DB::fetchOne('users',' u_email = "'.$email.'"');

        if(empty($checkLogin)) {
            $errors['email'] = ' Email không phù hợp với bất kỳ tài khoản nào';
        }

        if(empty($errors))
        {

            $title ="Đặt lại mật khẩu";
            $content = "Có vẻ như bạn đã quên mật khẩu của mình nhưng không sao. Bạn vui lòng kích vào link dưới đây để thực hiện đặt lại mật khẩu của mình <a href='".path_url('/reset_pass.php?id='.$checkLogin['id'])."'>Đặt lại mật khẩu </a>";
            $mTo = $email;
            $nTo = !empty($checkLogin['u_name']) ? $checkLogin['u_name'] : '' ;
            sendMail($title, $content, $nTo, $mTo, $diachicc='');

            $_SESSION['success'] = 'Bạn đã thực hiện đổi mật khẩu vui lòng check mail để thay đổi mật khẩu mới';
        }   
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên mật khẩu</title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
    <!-- mytour:css -->
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
                        
                            <h3 class="title"><b>Nhập email để đổi mật khẩu</b></h3>
                            <?php if (isset($errors['saitt'])) :?>
                                <span><?= $errors['saitt'] ?></span>
                            <?php endif ; ?>
                            <div class="form-group">
                                <label>
                                    Email<small class="red">*</small>
                                </label>
                                <input type="text" class="ip-email form-control" name="email" value="">
                                <?php if (isset($errors['email'])) :?>
                                    <span><?= $errors['email'] ?></span>
                                <?php endif ; ?>
                            </div>
                        <div class="sign-up-footer">
                            <button type="submit" class="btn">Gửi mail</button>
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
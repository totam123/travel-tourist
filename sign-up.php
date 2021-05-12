<?php
    require_once __DIR__. '/autoload.php';
    $active = "user";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $email    = Input::get("email"); 
        $password = Input::get("password");
        $re_password = Input::get("re_password");
        // kiểm tra lỗi
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($re_password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['re_password'] = ' Mời bạn điền đầy đủ thông tin';
        }
        
        if($email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "E-mail không hợp lệ"; 
        }
        else
        {
            // check xem email da trung chua
            $emailCheck = DB::fetchOne('users',' u_email = "'.$email.'"');
            if(count($emailCheck))
            {
                // email trung gan vao error
                $errors['email'] = ' Email đã tồn tại ! ';
            }
        }

        if ($password && $re_password )
        {
            if ( $password != $re_password )
            {
                $errors['re_password'] = 'Mật khẩu xác nhận không đúng';   
            }
        }
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'u_email'    => $email,
                'u_password' => md5($password)
            ];
            //tiến hành insert 
            $id_insert = DB::insert('users',$data);

            if($id_insert > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục users
                $_SESSION['success'] = "Thêm mới thành công ";
                $_SESSION['id_user']  = $id_insert;
                $_SESSION['email_user']  = $email;
                header("Location: ".redirectUrl().'/');exit();
            }
            
        }   
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký</title>
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
                <div class="box-body">
                    <form method="POST" action="">
                        <h3 class="title"><b>đăng ký bằng email</b></h3>
                        <div class="form-group">
                            <label>
                                Email<small class="red">*</small>
                            </label>
                            <input type="text" class="ip-email form-control" name="email" value="">
                            <?php if (isset($errors['email'])) :?>
                                <span><?= $errors['email'] ?></span>
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

                        <div class="form-group">
                            <label>
                                Xác nhận lại mật khẩu<small class="red">*</small>
                            </label>
                            <input type="password" class="form-control" name="re_password">
                            <?php if (isset($errors['re_password'])) :?>
                                <span><?= $errors['re_password'] ?></span>
                            <?php endif ; ?>
                        </div>
                        <div class="form-group text-center mg-bt-20">
                            <p class="help-block" style="font-size: 16px">Chọn đăng ký là bạn đã đồng ý với các <a href="">Điều khoản dịch vụ</a> của TAM Travel</p>
                            <button type="submit" class="events-tracking btn btn-block-center btn-blue" data-category="Sign up" data-action="Signup" data-label="">Đăng ký</button>
                        </div>
                    </form>

                    <div class="title-lg mg-bt-20" style="padding-bottom: 0">
                    </div>

                    <div class="sign-up-footer">
                        <p><b>Đã có tài khoản?</b></p>
                        <a class="btn" href="login.php">Đăng nhập</a>
                    </div>
                </div>
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
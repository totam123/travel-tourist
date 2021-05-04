<?php
    require_once __DIR__. '/autoload.php';
    $active = "contact";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    	$name    = Input::get("name");
    	if($name == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        $email    = Input::get("email");
        if($email == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
        }

        $title    = Input::get("title");
        if($title == '') {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['title'] = ' Mời bạn điền đầy đủ thông tin';
        }

        $content    = Input::get("content");

        if(empty($errors)) {

        	// gán vào 1 mảng giá trị để insertt 
            $data = 
            [
                'c_name'    => $name,
                'c_email'    => $email,
                'c_title'    => $title,
                'c_content'    => $content,
                
            ];

			//tiến hành insert 
            $id_insert = DB::insert('contact',$data);

            if($id_insert > 0) {
            	
            	//chuyển về trang index trong thư mục users
                $_SESSION['success'] = "Gửi liên hệ thành công!!!";
            }
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liên hệ</title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
<div class="slider-lg" style="background:#FFEBCD">
    <div class="slider-content"style="background:#FFEBCD">
        <div class="bg-full" style="background:url(<?= path_url() ?>/public/images/logo/li.jpg) center top">
        </div>
    </div>
</div>

<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-5 col-md-offset-1 mg-t-40 mg-bt-40">
            <div class="box">
                <div class="box-body" style="background:#FFEBCD;font: size 20px;">
                    <form method="POST" action="">
                        <h3 class="title"><b>Gửi Ý kiến phản hồi cho chúng tôi</b></h3>
                        <div class="form-group">
                            <label>
                                Họ và tên
                            </label>
                            <input type="text" class="ip-email form-control" name="name" value="">
                        	<?php if (isset($errors['name'])) :?>
                                <span><?= $errors['name'] ?></span>
                            <?php endif ; ?>
                        </div>

                        <div class="form-group">
                            <label>
                                Email của bạn
                            </label>
                            <input type="text" class="form-control" name="email">
                            <?php if (isset($errors['email'])) :?>
                                <span><?= $errors['email'] ?></span>
                            <?php endif ; ?>
                        </div>

                        <div class="form-group">
                            <label>
                                Tiêu đề
                            </label>
                            <input type="text" class="form-control" name="title">
                            <?php if (isset($errors['title'])) :?>
                                <span><?= $errors['title'] ?></span>
                            <?php endif ; ?>
                        </div>
                        <div class="form-group">
                            <label>
                                Nội dung
                            </label>
                            <textarea name="content" class="form-control" cols="" rows="10"></textarea>
                        </div>
                        <div class="form-group text-center mg-bt-20">
                         
                            <button type="submit" class="events-tracking btn btn-block-center btn-yellow" data-category="Sign up" data-action="Signup" data-label="">Gửi</button>
                        </div>
                    </form>
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
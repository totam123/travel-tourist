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
                <div class="box-body" style="background:#FFEBCD">
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
                <p class="special"><b>Lợi ích khi tạo tài khoản</b></p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Đặt phòng với giá giảm đến 40%.</p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Tích lũy điểm thưởng Vpoint với mỗi đơn phòng.</p>
                <p><i class="fa fa-check-circle green-dark-1"></i>Nhận ưu đãi đặc biệt chỉ dành cho thành viên.</p>

            </div>
        </div>
    </div>
</div>

<div class="modal modal-blue fade" id="getGoodPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class="modal-title" id="exampleModalLabel">XEM BÁO GIÁ QUA EMAIL</p>
            </div>
            <div class="modal-body">
                <div class="show_error alert alert-info">
                    <strong>Giá tốt nhất</strong> sẽ thay đổi theo ngày nhận phòng của bạn.
                </div>
                <form class="form-search form-search-date" data-toggle="validator" role="form" id="requesPrice">
                    <div class="form-group">
                        <div class="box-search box_js_arrow">
                            <div class="form-search ">
                                <div class="mt-datepicker t-datepicker js_arrow datepicker-modal">
                                    <div class="t-check-in"></div>
                                    <div class="t-check-out"></div>
                                </div>
                            </div>
                        </div>
                        <input id="good_price_checkin" type="hidden" class="form-control datepicker-df check-in"
                               value="04/07/2018" name="check-in"/>
                        <input id="good_price_checkout" type="hidden" class="form-control datepicker-df check-out"
                               value="05/07/2018" name="check-out"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tên khách hàng<small class="red">*</small></label>
                        <input type="text" name="name" required class="form-control cus_name" tabindex="1" data-error="Tên khách hàng không chính xác!" value="">
                        <p class="help-block red with-errors"></p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email<small class="red">*</small></label>
                        <input type="email" name="email" required class="form-control cus_email" tabindex="2" placeholder="example@gmail.com" data-error="Email không hợp lệ!" value="">
                        <p class="help-block red with-errors"></p>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Số điện thoại<small class="red">*</small></label>
                        <input type="tel" data-minlength="9" name="phone" required class="form-control cus_phone" tabindex="3" data-error="Số điện thoại không chính xác!" value="">
                        <p class="help-block red with-errors"></p>
                    </div>
                    <input type="hidden" class="hot_id get_good_price" name="hot_id" value=""/>
                    <input type="hidden" class="cus_type cus_good_price" name="cus_type" value="">
                    <input type="hidden" class="room_id room_info_price" name="room_id" value=""/>
                    <input type="hidden" class="rate_id rate_info_price" name="rate_id" value="" />
                    <input type="hidden" class="events-tracking" data-category="Request_price_Submit" data-route="home" data-action="Listing" data-label="non member">
                </form>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="button" class="btn btn-gray" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-blue cl-request-price">Gửi yêu cầu</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
</body>

<div class="modal modal-blue fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    </div>
    </div>
    </div>
    </html>
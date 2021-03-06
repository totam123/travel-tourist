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
        $id = $_GET['id'];
        $password = Input::get("password");
        $rpassword = Input::get("rpassword"); 
        

        // kiểm tra lỗi
        if($password == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['password'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if($rpassword == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi 
            $errors['rpassword'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if($password != $rpassword) {
            $errors['password'] = ' Mật khẩu bạn nhập không khớp nhau ';
        }
        

        if(empty($errors))
        {
            $data = 
            [
                'u_password' => md5($password)
            ];
           DB::update('users',$data, array('id' => $id));
           $_SESSION['success'] = 'Bạn đã thực hiện đổi mật khẩu thành công vui lòng đăng nhập để sử dụng dịch vụ';
           
        }   
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đổi mật khẩu</title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>


<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-5 col-md-offset-1 mg-t-40 mg-bt-40">
            <div class="box">
                <form method="POST" action="">
                    <div class="box-body">
                        
                            <h3 class="title"><b>Đổi mật khẩu</b></h3>
                            <?php if (isset($errors['saitt'])) :?>
                                <span><?= $errors['saitt'] ?></span>
                            <?php endif ; ?>
                            <div class="form-group">
                                <label>
                                    Mật khẩu mới<small class="red">*</small>
                                </label>
                                <input type="password" class="form-control" name="password">
                                <?php if (isset($errors['password'])) :?>
                                    <span><?= $errors['password'] ?></span>
                                <?php endif ; ?>
                            </div>

                            <div class="form-group">
                                <label>
                                   Nhập lại mật khẩu<small class="red">*</small>
                                </label>
                                <input type="password" class="form-control" name="rpassword">
                                <?php if (isset($errors['rpassword'])) :?>
                                    <span><?= $errors['rpassword'] ?></span>
                                <?php endif ; ?>
                            </div>

                        

                        <div class="title-lg mg-bt-20" style="padding-bottom: 0">
                        </div>

                        <div class="sign-up-footer">
                            <button type="submit" class="btn">Đặt lại</button>
                        </div>
                    </div>
                </form>
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
<?php
    require_once __DIR__. '/autoload.php';
    $active = 'tours';
    if (!isset($_SESSION['cart']))
    {
        header("Location: ".redirectUrl());exit();
    }
    $userLogin = '';
    if ( isset($_SESSION['id_user']))
    {
        $userLogin = DB::fetchOne('users' ,' id = '.$_SESSION['id_user']);

    }
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $customer_name    = Input::get("customer_name");
        $customer_phone   = Input::get("customer_phone");
        $customer_email   = Input::get("customer_email");
        $customer_address = Input::get("customer_address");
        $b_start_date     = Input::get("b_start_date");
        $b_end_date       = Input::get("b_end_date");


        // kiểm tra lỗi
        if($customer_name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['customer_name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        if($customer_phone == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['customer_phone'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if($customer_email == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['customer_email'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $customer_email)) {
            $errors['customer_email'] = 'Định dạng email không đúng';
        }


        if ($customer_address =='')
        {
            $errors['customer_address'] = ' Mời bạn điền đầy đủ thông tin';
        }

        if ($b_start_date =='')
        {
            $errors['b_start_date'] = 'Bạn cần chọn ngày đi';
        }

        if ($b_end_date =='')
        {
            $errors['b_end_date'] = 'Bạn cần chọn ngày về';
        }

    
        if(empty($errors))
        {

            $check = DB::fetchOne('users',' u_email = "'.$customer_email.'" LIMIT 1');

            if (!$check)
            {
                $data_user = [
                    'u_name' => $customer_name,
                    'u_email' => $customer_email,
                    'u_phone' => $customer_phone,
                    'u_address' => $customer_address,
                    'u_password' => md5(12345678)
                ];

                $id_insert = DB::insert('users', $data_user);

                if ($id_insert > 0)
                {
                    $flag = 1;
                }

                $data_book_tour = [
                    'b_tour_id' => $_SESSION['cart']['id'],
                    'b_user_id' => $id_insert,
                    'b_number_guests' => $_SESSION['cart']['number'],
                    'b_price'   => $_SESSION['cart']['price'] * $_SESSION['cart']['sale'],
                    'b_total'   => $_SESSION['cart']['price'] * $_SESSION['cart']['number'],
                    'b_start_date'    => $b_start_date,
                    'b_end_date'      =>$b_end_date,
                ];

                $book_check = DB::insert('book_tours',$data_book_tour);

                if ($book_check)
                {
                    $_SESSION['success'] = ' Cảm ơn bạn , chúng tôi sẽ sớm liên hệ với bạn ! Tài khoản của bạn đã đc lưu trên hê thống ! ID đăng nhập là : '.$customer_email. ' ' . ' và mật khẩu 12345678 ! hãy cập nhật thông tin ngay nhé ';
                    unset($_SESSION['cart']);
                }else
                {
                    $_SESSION['danger'] = 'Xử lý thất bại mời bạn dặt lại';
                }

                header("Location: ".redirectUrl('/alert.php'));exit();
            }else
            {
                if ( $userLogin)
                {
                    $data_user = [
                        'u_name' => $customer_name,
                        'u_email' => $customer_email,
                        'u_phone' => $customer_phone,
                        'u_address' => $customer_address,
                    ];

                    $id_update = DB::update('users',$data_user, 'id =' . $userLogin['id']);
                    $data_book_tour = [
                        'b_tour_id'       => $_SESSION['cart']['id'],
                        'b_user_id'       => $userLogin['id'],
                        'b_number_guests' => $_SESSION['cart']['number'],
                        'b_price'         => $_SESSION['cart']['price'],
                        'b_total'         => $_SESSION['cart']['price'] * $_SESSION['cart']['number'],
                        
                        'b_start_date'    => $b_start_date,
                        'b_end_date'      =>$b_end_date,
                    ];
                    
                    $book_check = DB::insert('book_tours',$data_book_tour);

                    if ($book_check)
                    {
                        $_SESSION['success'] = ' Cảm ơn bạn , chúng tôi sẽ sớm liên hệ với bạn ! ';
                        unset($_SESSION['cart']);
                    }else
                    {
                        $_SESSION['danger'] = 'Xử lý thất bại mời bạn dặt lại';
                    }
                    header("Location: ".redirectUrl('/'));exit();
                }
                else
                {
                    $_SESSION['danger'] = 'Email này đã tồn tại trên hệ thống mời bạn đăng nhập để đặt tour ';
                    header("Location: ".redirectUrl('/login.php'));exit();
                }


            }
        }

        $qty = Input::get("qty");

        if ($qty)
        {
            $_SESSION['cart']['number'] = $qty;
        }
    }

    $tour = DB::fetchOne('tours',' id = "'.$_SESSION['cart']['id'].'" LIMIT 1');
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt phòng khách sạn, hotel trực tuyến hàng đầu Việt Nam</title>
    <meta name="description" content="">
    <link rel="canonical" href="/" />
    <!-- mytour:css -->
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>

<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-12 mg-t-40 mg-bt-40">
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Tour</th>
                            <th>Số Người</th>
                            <th>Số Tiền</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action="" method="POST">
                            <tr>
                                <td><?= $_SESSION['cart']['id'] ?></td>
                                <td><?= $_SESSION['cart']['name'] ?></td>
                                <td><input type="number" min="1" value="<?= $_SESSION['cart']['number'] ?>" name="qty"></td>
                                <td><?= formatPrice($_SESSION['cart']['price']) ?>đ</td>
                                <td><?= formatPrice($_SESSION['cart']['price'] * $_SESSION['cart']['number']) ?>đ</td>
                                <td>
                                    <a href="/boox-tour-delete.php?id=<?= $_SESSION['cart']['id'] ?>">Huỷ</a>
                                    <button type="submit" class="btn">Cập nhật</button>
                                </td>
                            </tr>

                    </form>

                    </tbody>
                </table>

            </div>
            
        </div>

    </div>
</div>

<div class="container booking">
    <form id="booking-form" method="POST" action="">
        <input type="hidden" name="_token" value="y4nM38o9kjAqBv5ywCIgUmeQqqkOyQl2oP6rq7XI">
        <div class="row">
            <!-- booking -->
            <div class="booking-info text-header-margin">
                <div class="col-sm-12 col-md-4">
                    <div class="box box-blue " style="height: 650px;">
                        <div class="box-header">
                            <h3 class="box-title">
                                <span class="rounded">1</span>
                                Thông tin liên hệ
                            </h3>
                        </div>
                        <div class="box-body">
                            <?php if( isset($_SESSION['id_user'])) :?>
                                <div class="form-group">
                                    <label>Họ và tên <small class="red">*</small></label>
                                    <input type="text" id="customer_name" class="form-control info_customer_book" name="customer_name" value="<?= $userLogin['u_name'] ?>">

                                    <?php if (isset($errors['customer_name'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_name'] ?></p>
                                    <?php endif ; ?>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại <small class="red">*</small></label>
                                    <input type="text" id="customer_phone" class="form-control info_customer_book" name="customer_phone" value="<?= $userLogin['u_phone'] ?>">
                                    <?php if (isset($errors['customer_phone'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_phone'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Email <small class="red">*</small></label>
                                    <input type="text" id="customer_email" class="form-control info_customer_book" name="customer_email" value="<?= $userLogin['u_email'] ?>">
                                    <?php if (isset($errors['customer_email'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_email'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" id="customer_address" class="form-control info_customer_book" name="customer_address" value="<?= $userLogin['u_address'] ?>">
                                    <?php if (isset($errors['customer_address'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_address'] ?></p>
                                    <?php endif ; ?>
                                </div>

                                <div class="form-group">
                                    <label>Ngày đi</label>
                                    <input type="date" id="b_start_date" class="form-control info_customer_book" name="b_start_date" value="">
                                    <?php if (isset($errors['b_start_date'])) :?>
                                        <p class="help-block red"><?php echo $errors['b_start_date'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Ngày Về</label>
                                    <input type="date" id="b_end_date" class="form-control info_customer_book" name="b_end_date" value="">
                                    <?php if (isset($errors['b_end_date'])) :?>
                                        <p class="help-block red"><?php echo $errors['b_end_date'] ?></p>
                                    <?php endif ; ?>
                                </div>
                            <?php else :?>
                                <div class="form-group">
                                    <label>Họ và tên <small class="red">*</small></label>
                                    <input type="text" id="customer_name" class="form-control info_customer_book" name="customer_name" value="">
                                    <?php if (isset($errors['customer_name'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_name'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại <small class="red">*</small></label>
                                    <input type="text" id="customer_phone" class="form-control info_customer_book" name="customer_phone" value="">
                                    <?php if (isset($errors['customer_phone'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_phone'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Email <small class="red">*</small></label>
                                    <input type="text" id="customer_email" class="form-control info_customer_book" name="customer_email" value="">
                                    <?php if (isset($errors['customer_email'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_email'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" id="customer_address" class="form-control info_customer_book" name="customer_address" value="">
                                    <?php if (isset($errors['customer_address'])) :?>
                                        <p class="help-block red"><?php echo $errors['customer_address'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Ngày đi</label>
                                    <input type="date" id="b_start_date" class="form-control info_customer_book" name="b_start_date" value="">
                                    <?php if (isset($errors['b_start_date'])) :?>
                                        <p class="help-block red"><?php echo $errors['b_start_date'] ?></p>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-group">
                                    <label>Ngày Về</label>
                                    <input type="date" id="b_end_date" class="form-control info_customer_book" name="b_end_date" value="">
                                    <?php if (isset($errors['b_end_date'])) :?>
                                        <p class="help-block red"><?php echo $errors['b_end_date'] ?></p>
                                    <?php endif ; ?>
                                </div>
                            <?php endif ;?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="box box-blue" style="height: 650px;">
                        <div class="box-header">
                            <h3 class="box-title">
                                <span class="rounded">2</span>
                                Thông tin đặt tour
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="product-image">
                                
                                <a href="/tour/<?= str_slug($tour['t_name']) ?>-<?= $tour['id'] ?>.html">
                                        <img  data-src="<?php echo path_url() ?>/uploads/tours/<?= $tour['t_images'] ?>" src="<?php echo path_url() ?>/uploads/tours/<?= $tour['t_images'] ?>" alt="" class="img-responsive">
                                </a>
                            </div>
                            <h3 class="title-sm">
                                <?php echo $tour['t_name'] ?>
                            </h3>
                        
                            <dl class="nav-dl-list"  style="margin-top: 90px;">
                                <button id="submit_booking" type="submit" class="btn btn-lg btn-block btn-yellow mg-bt-15">Hoàn thành</button>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="box box-blue">
                        <div class="box-header">
                            <h3 class="box-title">
                                <span class="rounded">3</span>
                                Gửi đơn đặt tour
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-8 col-xs-offset-2 text-center">
                                    <a id="back_to_detai_tour" class="change-info-room customize-button-change-tour" data-href="/tour/9132-tour-du-lich-ha-noi-ha-long-ninh-binh-trong-4-ngay-3-dem.html" data-toggle="modal" data-target="#ModalAlertBackDetail">
                                        Bạn muốn tìm tour khác?
                                    </a>
                                </div>
                            </div>
                            <div class="red mg-bt-10">
                                <strong>Lưu ý:</strong>
                            </div>
                            <ul class="nav-list">
                                <li>
                                    Quý khách có thể thanh toán trước bằng thẻ <a href="#" data-toggle="modal" data-target="#ModalPayOnline"> tại đây.</a>
                                </li>
                                <li>
                                    Mytour sẽ liên hệ với quý khách (qua email hoặc điện thoại) trong vòng <strong class="green text-sm"> 30 phút </strong> (T2-CN: 08:00 - 23:00) để xác nhận tour và thời hạn thanh toán.
                                </li>
                                <li>
                                    Quý khách sẽ thanh toán (tại nhà, tại Mytour, chuyển khoản hay thẻ) sau khi có xác nhận còn tour từ Mytour.
                                </li>
                                <li>
                                    Trường hợp Quý khách muốn xác nhận ngay, vui lòng liên hệ với Mytour theo Hotline:
                                    <br>
                                    <strong>Hà Nội: 0913767674</strong>
                                    <br>
                                    <strong>Hồ Chí Minh: 0564841529</strong>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.booking -->
        </div>
        <input type="hidden" name="payment_type" id="payment_type" value="0">
        <input type="hidden" name="payment_method" id="payment_method" value="1">
        <input type="hidden" name="payment_bank" id="payment_bank" value="0">
    </form>
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
<?php
require_once __DIR__. '/autoload.php';
$active = 'user';
$userLogin = '';
if ( isset($_SESSION['id_user']))
{
    $userLogin = DB::fetchOne('users' ,' id = '.$_SESSION['id_user']);
}


if (!isset($_SESSION['url_redirect']))
{ 
    $_SESSION['url_redirect'] = $_SERVER["HTTP_REFERER"];
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $phone = Input::get("u_phone");
    $name = Input::get("u_name");
    $address = Input::get("u_address");
    $password = Input::get("u_password");

    $data = [
        'u_phone' => $phone,
        'u_name'  => $name,
        'u_address' => $address,
        'u_password' =>$password
    ];
    if ($password)
    {
        $data['u_password'] = md5($password);
    }
   
    $insert = DB::update('users',$data, array('id' => $userLogin['id']));
    if ($insert>0) {
        $_SESSION['success'] = 'Cập nhật thông tin thành công';
        header("Location: ".redirectUrl('/profile.php'));exit();
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Cập nhật thông tin </title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>


<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mg-t-40 mg-bt-40">
            <div class="box">
                <form method="POST" action="">
                    <div class="box-body">

                        <h3 class="title"><b>Cập nhật thông tin</b></h3>
                        <?php if (isset($errors['saitt'])) :?>
                            <span><?= $errors['saitt'] ?></span>
                        <?php endif ; ?>
                        <div class="form-group">
                            <label>
                                Email<small class="red">*</small>
                            </label>
                            <input type="text" class="ip-email form-control" name="email" value="<?= $userLogin['u_email'] ?>" readonly>
                            <?php if (isset($errors['password'])) :?>
                                <span><?= $errors['password'] ?></span>
                            <?php endif ; ?>
                        </div>

                        <div class="form-group">
                            <label>
                                Họ tên<small class="red">*</small>
                            </label>
                            <input type="text" class="form-control" name="u_name" value="<?= isset($userLogin['u_name']) ? $userLogin['u_name'] : '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>
                                Số điện thoại<small class="red">*</small>
                            </label>
                            <input type="number" class="form-control" name="u_phone" required value="<?= isset($userLogin['u_phone']) ? $userLogin['u_phone'] : '' ?>">
                        </div>


                        <div class="form-group">
                            <label>
                         Địa chỉ<small class="red">*</small>
                            </label>
                            <input type="text" class="form-control" name="u_address" required value="<?= isset($userLogin['u_address']) ? $userLogin['u_address'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label>
                                Mật khẩu
                            </label>
                            <input type="text" class="form-control" name="u_password" 
                            value="" 
                            required>
                        </div>



                        <div class="title-lg mg-bt-20" style="padding-bottom: 0">
                        </div>

                        <div class="sign-up-footer">
                            <p><b>Đã có tài khoản </b></p>
                            <button type="submit" class="btn">Cập nhật</button>
                        </div>
                    </div>
                </form>
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
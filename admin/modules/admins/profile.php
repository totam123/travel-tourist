<?php
@ob_start();
$modules = 'admins';
$title_global = 'Cập nhật admin';
require_once __DIR__ .'/../../autoload.php';

    $id = (int)$_SESSION['admin_id'];

$admin = DB::fetchOne('admins',' id = '.$id);

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    /**
     *  lay giá trị từ input
     */
    $hoten           = Input::get("hoten");
    $email           = Input::get("email");
    $sodienthoai     = Input::get("sodienthoai");
    $level           = Input::get("level");
    $matkhau         = Input::get('matkhau');

    // kiểm tra lỗi
    if($hoten == '')
    {
        // nếu giá trị trống thì gán vào 1 mảng lỗi
        $errors['hoten'] = ' Mời bạn điền đầy đủ thông tin';
    }

    if($email == '')
    {
        $errors['email'] = ' Mời bạn điền đầy đủ thông tin';
    }
    if($sodienthoai == '')
    {
        $errors['sodienthoai'] = ' Mời bạn điền đầy đủ thông tin';
    }

    if($level == '')
    {
        $errors['level'] = ' Mời bạn điền đầy đủ thông tin';
    }


    // nếu mảng errors trống => Ko có lỗi  tiến hành insert
    if(empty($errors))
    {
        // gán vào 1 mảng giá trị để insertt
        $data = [
            'name'  => $hoten ,
            'email' => $email ,
            'phone' => $sodienthoai ,
            'level' => $level ,
        ];

        if ($matkhau)
        {
            $data['password'] = md5($matkhau);
        }

        //tiến hành insert

        $id_update = DB::update('admins',$data , ' id = '.$id);

        if($id_update > 0)
        {
            // update thanh cong
            // gán session thông báo thành công
            //chuyển về trang index trong thư mục category_products
            $_SESSION['success'] = "Cập nhật thành công ";

        }else {
            $_SESSION['success'] = " Dữ liệu không thay đổi ";
        }

        header("Location: ".path_url().'/admin/modules/admins');exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
	<div class="wrapper">

    	<?php require_once __DIR__ .'/../../layouts/inc_header.php'; ?>
		<?php require_once __DIR__ .'/../../layouts/inc_sidebar.php'; ?>
		<div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?= isset($title_global) ? $title_global : '' ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#"> Quản lý</a></li>
                    <li class="active">Thêm mới</li>
                </ol>
            </section>
          	<section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="col-md-10 col-sm-offset-1">
                    <div class="box box-primary">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Họ tên </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="hoten" id="inputEmail3" placeholder="Nguyen Van A" autocomplete="off" value="<?= isset($admin) ? $admin['name'] : $hoten?>">
                                            <?php if(isset($errors['name'])) :?>
                                                <span class="color-red"><?= $errors['hoten'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">  Email </label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="admin@gmail." autocomplete="off" value="<?= isset($admin) ? $admin['email'] : $email?>">
                                            <?php if(isset($errors['email'])) :?>
                                                <span class="color-red"><?= $errors['email'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">  Số điện thoại </label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="sodienthoai" id="inputEmail3" placeholder="0987654321" autocomplete="off" value="<?= isset($admin) ? $admin['phone'] : $phone?>">
                                            <?php if(isset($errors['sodienthoai'])) :?>
                                                <span class="color-red"><?= $errors['sodienthoai'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">  Mật khẩu </label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="matkhau" id="inputEmail3" placeholder="******" autocomplete="off" value="<?= isset($password) ? $password : ''?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"> Cấp độ </label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="level">
                                                <option value="1" <?= $admin['level'] == 1 ? "selected='selected'" : "" ?>>Cộng tác viên</option>
                                                <option value="2" <?= $admin['level'] == 2 ? "selected='selected'" : "" ?>> Quản lý</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary btn-xs"> Cập nhật  </button>
                                    <a href="index.php" class="btn btn-danger btn-xs"> Huỷ bỏ </a>
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
             </div>
          </section>
    </div>
    <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
</div>
<?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
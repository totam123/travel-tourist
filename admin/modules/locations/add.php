<?php
    $modules = 'locations';
    $title_global = 'Thêm mới địa điểm ';
    require_once __DIR__ .'/../../autoload.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        /**
         *  lay giá trị từ input
         */
        $name       = Input::get("loc_name");
        $sort       = Input::get("loc_sort");
        $loc_hot    = Input::get("loc_hot");
        $loc_status = Input::get("loc_status");
		if($name == '')
        {
            // nếu giá trị trống thì gán vào 1 mảng lỗi
            $errors['loc_name'] = ' Mời bạn điền đầy đủ thông tin';
        }
        $loc_image  = '';
        if ( isset ($_FILES['loc_image']) && $_FILES['loc_image']['name'] != NULL )
        {
            $upload_image = upload_image('loc_image');
            if (!isset($upload_image['code']))
            {
                $errors['loc_image'] = "  Lỗi file ảnh hoạc định dạng ảnh không đúng ";
            }else
            {
                $loc_image = $_SESSION['loc_image'] = $upload_image['name'];
            }
        }
        if(empty($errors))
        {
            // gán vào 1 mảng giá trị để insertt
            if ( isset($_SESSION['loc_image']))
            {
                $loc_image  = $_SESSION['loc_image'];
            }
            $data = [
                'loc_name'   => $name ,
                'loc_sort'   => $sort ,
                'loc_image'  => $loc_image,
                'loc_hot'    => $loc_hot,
                'loc_status' => $loc_status,
            ];
            $id_insert = DB::insert('locations',$data);
            if($id_insert > 0)
            {
                // insert thanh cong
                // gán session thông báo thành công
                //chuyển về trang index trong thư mục category_products
                $_SESSION['success'] = "Thêm mới thành công ";
                unset($_SESSION['loc_image']);
                header("Location: ".path_url().'/admin/modules/locations');exit();
            }
            $_SESSION['danger'] = " Thêm mới thất bại ";
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
                <li><a href="#">Địa điểm </a></li>
                <li class="active">Thêm mới</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="col-md-10 col-sm-offset-1">
                        <!-- Horizontal Form -->
                        <div class="box box-primary">
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="ZPEdLE4Il64joczf4kmj8Q9eQBvPxcz1qVZwfLOB">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Tên địa điểm  </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="loc_name" id="inputEmail3" placeholder="Hà Nội" autocomplete="off" value="<?= isset($loc_name) ? $loc_name : ''?>">
                                            <?php if(isset($errors['loc_name'])) :?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['loc_name'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"> Vị trí </label>
                                        <div class="col-sm-9">
                                            <input type="number" name="loc_sort" class="form-control" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"> Địa điểm nổi bật </label>
                                        <div class="col-sm-9">
                                            <input type="checkbox" name="loc_hot"  value="1" style="margin-top: 11px;"> Hót
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"> Trạng thái </label>
                                        <div class="col-sm-9">
                                            <input type="radio" name="loc_status"  value="1"> Hiện 
                                            <input type="radio" name="loc_status"  value="0"> Ẩn
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Hình ảnh   </label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="loc_image" id="imgInp">
                                        </div>
                                        <div class="col-sm-9" style="margin-top: 10px;margin-left: 25%">
                                            <img src="<?= path_url('/public/uploads/tours/') ?><?= isset($_SESSION['loc_image']) ? $_SESSION['loc_image'] : '' ?>" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 260px;height: 258px;border: 1px solid #dedede">
                                            <?php if(isset($errors['loc_image'])) :?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['loc_image'] ?></span>
                                            <?php endif ;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer col-sm-offset-3">
                                    <button type="submit" class="btn btn-primary btn-xs"> Thêm mới  </button>
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
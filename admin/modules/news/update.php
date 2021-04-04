<?php
$modules = 'posts';
$title_global = 'Cập nhậtbài viết';
require_once __DIR__ .'/../../autoload.php';
$id = (int)Input::get('id');
$post = DB::fetchOne('news',$id);
if( ! $post )
{
    $_SESSION['error'] = "  Không tồn tại dữ liệu ";
    header("Location: ".baseServerName().'/admin/modules/posts');exit();
}
if (isset($_SESSION['n_images'])) {
    unset($_SESSION['n_images']);
}
$n_images = $post['n_images'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $n_title        = Input::get("n_title");
    $n_descriptions = Input::get("n_descriptions");
    $n_content      = Input::get('n_content');
    $n_type      = Input::get('n_type');
    if(empty($n_title)) {
        $errors['n_title']          ='Mời bạn điền đầy đủ thông tin';
    }

    if(empty($n_descriptions)) {
        $errors['n_descriptions']  =  'Mời bạn điền đầy đủ thông tin';
    }

    if(empty($n_content)) {
        $errors['n_content']       =  'Mời bạn điền đầy đủ thông tin';
    }


    if ( isset ($_FILES['n_images']) && $_FILES['n_images']['name'] != NULL )
    {
        $file_name = $_FILES['n_images']['name'];
        $file_tmp  = $_FILES['n_images']['tmp_name'];
        $file_type = $_FILES['n_images']['type'];
        $file_erro = $_FILES['n_images']['error'];
        if ($file_erro == 0)
        {
            $n_images = $file_name;
            $_SESSION['n_images'] = $n_images;
        }
    }
    if ( empty($errors))
    {
        $data =
            [
                'n_title'        => $n_title ,
                'n_slug'         => str_slug($n_title),
                'n_descriptions' => $n_descriptions ,
                'n_images'       => $n_images,
                'n_content'      => $n_content,
                'n_admin_id'     => isset($_SESSION['admin_id'])? $_SESSION['admin_id'] : '',
                'n_type' => $n_type
            ];

        //tiến hành insert
        $id_insert = DB::update('news',$data,array('id' => $id));

        $_SESSION['success'] = "Cập nhật thành công ";
        move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT'].'/uploads/news/'.$n_images);
        header("Location: ".path_url().'/admin/modules/news');exit();
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
    <script type="text/javascript" src="/public/admin/ckeditor/ckeditor.js"></script>
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
                <li><a href="#">Sản phẩm </a></li>
                <li class="active">Thêm mới</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box box-primary">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Thunbar   </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="n_images" id="imgInp">
                                            <?php if( isset( $errors['n_images']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['n_images'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                            <img src="/uploads/news/<?= isset($post['n_images']) ? $post['n_images'] : '' ?>" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Tiêu đề </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="n_title" value="<?= $post['n_title'] ?>"  placeholder=" Tên sản phẩm không quá 200 từ" autocomplete="off">
                                            <?php if( isset( $errors['name']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['name'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label"> Kiểu bài viết </label>
                                        <div class="col-sm-10">
                                            <select name="n_type" id="" class="form-control">
                                                <option value="1" <?php isset($post['n_type']) && $post['n_type'] == 1 ? 'selected="selected"' : '' ?>>Bài viết tin tức</option>
                                                <option value="2" <?php isset($post['n_type']) && $post['n_type'] == 2 ? 'selected="selected"' : '' ?>>Giới thiệu khách sạn</option>
                                                <option value="3" <?php isset($post['n_type']) && $post['n_type'] == 3 ? 'selected="selected"' : '' ?>>Giới thiệu nhà hàng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label" style="margin-bottom: 10px;"> Description </label>
                                        <div class="col-sm-10" style="margin-right: 0;margin-left: 0">
                                            <textarea name="n_descriptions"  cols="10" rows="5" class="form-control" placeholder=" Mô tả ngắn về nội dung bài viết , không quá 250 ký tự"><?= $post['n_descriptions'] ?></textarea>
                                            <?php if( isset( $errors['n_descriptions']) ): ?>
                                                <span class="color-red"><i class="fa fa-bug"></i><?= $errors['n_descriptions'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin:5px 0">
                                <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;"> Nội dung </label>
                                <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                    <textarea name="n_content" id="my-editor" cols="10" rows="10" class="form-control" placeholder=" Mời bạn nhập nội dung bài viết "><?= $post['n_content'] ?></textarea>
                                    <?php if( isset( $errors['content']) ): ?>
                                        <span class="color-red"><i class="fa fa-bug"></i><?= $errors['content'] ?></span>
                                    <?php endif ; ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="" style="position: fixed;right: 15px;top: 50%;transform: translateY(-50%);">
                                <button type="submit" class="btn btn-primary btn-xs" style="width: 75px"> Cập nhật </button><br>
                                <a href="index.php" class="btn btn-danger btn-xs" style="width: 75px"> Huỷ bỏ </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
</div>
<?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
<script type="text/javascript">
    CKEDITOR.replace( 'my-editor', {
        height:'400px'
    });
</script>
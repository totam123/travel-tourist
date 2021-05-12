<?php
    $modules = 'tours';
    $title_global = 'Thêm mới tours';
    require_once __DIR__ .'/../../autoload.php';
    $sql = "SELECT * FROM locations  WHERE 1";
    $locations = DB::fetchsql($sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $t_name          = Input::get("t_name");
        $t_location_id   = Input::get("t_location_id");
        $t_code_tour     = Input::get("t_code_tour");
        $t_number_guests = Input::get('t_number_guests');
        $t_price         = Input::get('t_price');
        $t_schedule      = Input::get('t_schedule');
        $t_content       = Input::get('t_content');
        $t_sale          = Input::get('t_sale');
        $t_policy        = Input::get('t_policy');
        $t_time        = Input::get('t_time');
        $t_vehicle        = Input::get('t_vehicle');
        $t_time_start     = Input::get("t_time_start");
        $t_time_end       = Input::get("t_time_end");
        
        $errors = [];
        // bat loi
        if(empty($t_name)) {
            $errors['t_name']          =  'Mời bạn điền đầy đủ thông tin';
        }

        if(empty($t_location_id)) {
            $errors['t_location_id']   = 'Mời bạn điền đầy đủ thông tin';
        }

        if(empty($t_number_guests)) {
            $errors['t_number_guests'] = 'Mời bạn điền đầy đủ thông tin';
        }

        if(empty($t_price)) {
            $errors['t_price']         = 'Mời bạn điền đầy đủ thông tin';
        }

        if(empty($t_code_tour)) {
            $errors['t_code_tour']         = 'Mời bạn điền đầy đủ thông tin';
        }
        
        $t_images  = '';
        if ( isset ($_FILES['t_images']) && $_FILES['t_images']['name'] != NULL )
        {

            $upload_image = upload_image('t_images');
            if (!isset($upload_image['code']))
            {
               $errors['t_images'] = "  Lỗi file ảnh hoặc định dạng ảnh không đúng ";
            }else
            {
                $t_images = $_SESSION['t_images'] = $upload_image['name'];
            }
        }

        if (empty($errors))
        {
            $data =
            [
                't_name'          => $t_name,
                't_code_tour'     => $t_code_tour,
                't_number_guests' => $t_number_guests,
                't_images'        => $t_images,
                't_price'         => $t_price,
                't_location_id'   => $t_location_id,
                't_schedule'      => $t_schedule,
                't_content'       => $t_content,
                't_sale'          => $t_sale,
                't_policy'        => $t_policy,
                't_vehicle'       => $t_vehicle,
                't_time'          => $t_time,
                't_time_start' => $t_time_start,
                't_time_end'   => $t_time_end,
            ];
            $id_insert = DB::insert('tours',$data);
            if($id_insert > 0)
            {
                $_SESSION['success'] = "Thêm mới thành công ";
                unset($_SESSION['t_images']);
                header("Location: ".path_url().'/admin/modules/tours');exit();
            }

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
        <link rel="stylesheet" href="/public/admin/js/bootstrap3-wysihtml5.min.css">
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
                        <li><a href="#">Tours </a></li>
                        <li class="active">Thêm mới</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-body">
                            <div class="box box-primary">
                                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="t_images" id="imgInp">
                                                </div>
                                                <div class="col-sm-10" style="margin-top: 10px;margin-left: 17%">
                                                    <img src="<?= path_url('/public/uploads/tours/') ?><?= isset($_SESSION['t_images']) ? $_SESSION['t_images'] : '' ?>" alt="" class="img img-responsive" id="blah" title=" Logo " style="width: 100%;height: 258px;border: 1px solid #dedede">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"> Địa điểm </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" name="t_location_id">
                                                        <option value=""> - Chọn tours  - </option>
                                                        <?php if(count($locations) > 0) :?>
                                                            <?php foreach($locations as $location) :?>
                                                                <option value="<?= $location['id'] ?>"> <?= $location['loc_name'] ?> </option>
                                                            <?php endforeach ;?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <?php if( isset($errors['t_location_id']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i> 
                                                            <?= $errors['t_location_id'] ?></span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label"> Tiêu đề </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="t_name" value="<?= isset($t_name) ? $t_name : '' ?>"  placeholder="Tiêu đề tours" autocomplete="off">
                                                    <?php if( isset( $errors['t_name']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i>
                                                            <?= $errors['t_name'] ?>
                                                        </span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label" style="text-align: left;padding-left: 97px;"> Mã Tours  </label>
                                                <div class="col-sm-4">
                                                    <input type="text"  placeholder="Mã tours" readonly name="   t_code_tour" id="code_sale" class="form-control" value="<?= isset($t_code_tour) ? $t_code_tour : '' ?>">
                                                    <?php if( isset( $errors['t_code_tour']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i> 
                                                            <?= $errors['t_code_tour'] ?>
                                                        </span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a class="btn btn-primary" id="render_code">Tạo mã tours</a>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="" class="col-sm-3 control-label"> Giá Tour  </label>
                                                <div class="col-sm-4">
                                                    <input type="number" min="0" placeholder=" Giá Tours" name="t_price" class="form-control" value="<?= isset($t_price) ? $t_price : '' ?>">
                                                    <?php if( isset( $errors['t_price']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i>
                                                            <?= $errors['t_price'] ?>
                                                        </span>
                                                    <?php endif ; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label" style="text-align: left;padding-left: 91px;"> Số Lượng  </label>
                                                <div class="col-sm-4">
                                                    <input type="number" min="0" max="1000" placeholder="Số lượng khách hàng " name="t_number_guests" class="form-control" value="<?= isset($t_number_guests) ? $t_number_guests : '' ?>">
                                                    <?php if( isset( $errors['t_number_guests']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i>
                                                            <?= $errors['t_number_guests'] ?>
                                                        </span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label"> Sale ( % )</label>
                                                    <div class="col-sm-3">
                                                        <input type="number" min="0" max="10" placeholder=" 1 - 10 (%)" name="t_sale" class="form-control" value="<?= isset($t_sale) ? $t_sale : '0' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label" style="text-align: left;padding-left: 91px;"> Thời gian  </label>
                                                <div class="col-sm-4">
                                                     <select class="form-control" name="t_time">
                                                        <?php if(count($arrayTime) > 0) :?>
                                                            <?php foreach($arrayTime as $key => $at) :?>
                                                                <option value="<?= $key ?>"> <?= $at ?> </option>
                                                            <?php endforeach ;?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label">  Phương tiện </label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="t_vehicle">
                                                    
                                                        <?php if(count($arrayVehicle) > 0) :?>
                                                            <?php foreach($arrayVehicle as $k => $av) :?>
                                                                <option value="<?= $k ?>"> <?= $av ?> </option>
                                                            <?php endforeach ;?>
                                                        <?php endif; ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label" style="text-align: left;padding-left: 91px;"> Ngày đi</label>
                                                <div class="col-sm-4">
                                                    <input type="date" min="0" max="1000"  name="t_time_start" class="form-control" value="<?= isset($t_time_start) ? $t_time_start: '' ?>">
                                                    <?php if( isset( $errors['t_time_start']) ): ?>
                                                        <span class="color-red">
                                                            <i class="fa fa-bug"></i>
                                                            <?= $errors['t_time_start'] ?>
                                                        </span>
                                                    <?php endif ; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label"> Ngày về </label>
                                                    <div class="col-sm-3">
                                                        <input type="date" min="0" max="10" placeholder=" 1 - 10 (%)" name="t_time_end" class="form-control" value="<?= isset($t_time_end) ? $t_time_end : '0' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group" style="margin: 5px 0">
                                        <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;">Lịch trình</label>
                                        <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                            <textarea name="t_schedule"  cols="10" id="prd_description" rows="3" class="form-control wysihtml5" placeholder="Lịch trình tour"><?= isset($t_schedule) ? $t_schedule : '' ?></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group" style="margin: 5px 0">
                                        <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;"> Chính sách </label>
                                        <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                            <textarea name="t_policy"  cols="10" id="prd_description" rows="3" class="form-control wysihtml5" placeholder="Chính sách tour"><?= isset($t_policy) ? $t_policy : '' ?></textarea>
                                            <?php if( isset( $errors['t_policy']) ): ?>
                                                <span class="color-red"><?= $errors['t_policy'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group" style="margin:5px 0">
                                        <label for="inputEmail3" class="col-sm-12 control-label" style="text-align: left;margin-bottom: 10px;padding-right: 30px;padding-left: 30px;"> Nội dung </label>
                                        <div class="col-sm-12" style="padding-left: 30px ;padding-right: 30px">
                                            <textarea name="t_content" id="my-editor" cols="10" rows="10" class="form-control" placeholder=" Mô tả tour "><?= isset($t_content) ? $t_content : '' ?></textarea>
                                            <?php if( isset( $errors['t_content']) ): ?>
                                                <span class="color-red"><?= $errors['t_content'] ?></span>
                                            <?php endif ; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="" style="position: fixed;right: 15px;top: 50%;transform: translateY(-50%);">
                                        <button type="submit" class="btn btn-primary btn-xs" style="width: 75px"> Thêm mới </button><br>
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
        <script type="text/javascript" src="/public/admin/js/bootstrap3-wysihtml5.all.min.js"></script>
        <script type="text/javascript">
            CKEDITOR.replace( 'my-editor', {
                height:'400px'
            });
            $('textarea.wysihtml5').wysihtml5();
            $("#render_code").click(function(event){
                event.preventDefault();
                let string = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                $("#code_sale").val(string);
            })
        </script>
<?php
    $modules = 'tours';
    $title_global = 'Danh Sách Tours ';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT tours.* ,  locations.loc_name FROM tours 
        LEFT JOIN  locations  ON locations.id = tours.t_location_id
        WHERE 1
    ";
    $filter = [];
    $keyword = Input::get('keyword');
    if ( $keyword ) {
        $sql .= ' AND   t_name LIKE \'%'.$keyword.'%\'' ;
        $filter['keyword'] = $keyword;
    }

    if ( Input::get('location') ) {
        $sql .= ' AND tours.t_location_id = '.Input::get('location') ;
        $filter['locations'] = Input::get('location');
    }

    if ( Input::get('id') ) {
        $sql .= ' AND tours.id = '.(int)Input::get('id') ;
        $filter['id'] = Input::get('id');
    }
    $tours = Pagination::pagination('tours', $sql, 'page', 10);
    $sql = "SELECT * FROM locations  WHERE 1";
    $locations = DB::fetchsql($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php require_once __DIR__ .'/../../layouts/inc_css.php'; ?>
        <style>
            
        </style>
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
                        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Danh sách tour </li>
                    </ol>
                </section>
                <section class="content">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Bộ Lọc Tìm Kiếm </h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="">
                                <div class="form-group col-sm-5">
                                    <input type="text" class="form-control" name="keyword" placeholder=" Keyword tours " value="<?= Input::get('keyword') ? Input::get('keyword') : '' ?>">
                                </div>
                                <div class="form-group col-sm-3">
                                    <select name="location" id="" class="form-control">
                                        <option value="">-- Lọc theo địa điểm  --</option>
                                        <?php foreach($locations as $location) :?>
                                            <option value="<?= $location['id'] ?>" <?= Input::get('location') && Input::get('location') == $location['id'] ? "selected='selected'" : "" ?>> <?= $location['loc_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group col-sm-2">
                                    <input type="number" name="id" class="form-control" value="<?= Input::get('id') ?>" placeholder="ID Tours">
                                </div>
                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn btn-xs btn-success">
                                    <a  href="index.php" class="btn btn-xs btn-danger"> Làm mới<a/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                    <?php if($_SESSION['type'] === 'admin'): ?>
                        <div class="box-header with-border">
                            <a href="add.php" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                            <span> Kết quả tìm kiếm : </span>
                        </div>
                    <?php endif; ?>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover border">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th style="width: 30%">Tên tour</th>
                                            <th>Hình Ảnh</th>
                                            <th>Thông tin</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($tours as $tour) :?>
                                            <tr class='<?= $tour['t_number_guests'] <= 5 ? "bg-danger-nhat" : "" ?> item_product' data-id="<?= $tour['id'] ?>"  data-toggle="tooltip" data-placement="top" title="Click vào đây để xem chi tiết tour !">
                                                <td><?= $tour['id'] ?></td>
                                                <td><?= $tour['t_name'] ?></td>
                                                <td>
                                                    <img src="<?= path_url('/uploads/tours/') ?><?= $tour['t_images'] ?>" alt="<?= $tour['t_images'] ?>" style="width:50px;height:50px;" class="img img-responsive">
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Địa điểm  <span class="label label-success"><?= $tour['loc_name'] ?></span></li>
                                                        <li>Số Lượng Khách  <b><?= $tour['t_number_guests'] ?></b> | Sale : <b><?= $tour['t_sale'] ?> (%) </b></li>
                                                        <li>Giá : <b> <?= format_price($tour['t_price']) ?> đ </b> <?= $tour['t_sale'] != 0 ? " | <b>".format_price($tour['t_price'],$tour['t_sale'])." đ</b>" : '' ?></li>
                                                    </ul>

                                                </td>
                                                <td><a href="active.php?id=<?= $tour['id'] ?>" class="custome-btn label <?= $tour['t_status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $tour['t_status'] == 1 ? 'Hiện' : 'Ẩn' ?></span></a></td>
                                                <td>
                                                    <a href="update.php?id=<?= $tour['id'] ?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Cập nhật </a>
                                                    <a href="delete.php?id=<?= $tour['id'] ?>" class="custome-btn btn-danger btn-xs delete comfirm_delete" ><i class="fa fa-trash"></i> Xoá </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="custome-paginate">
                                <div class="pull-right">
                                    <?php echo Pagination::getListpage($filter) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
            $(function () {
                $(".item_product").click(function(){
                    let $that = $(this);

                    $(".item_product_content").remove();
                    if ($that.hasClass('active'))
                    {
                        $that.removeClass('active');
                        return false;
                    }else{
                        $that.addClass("active")
                    }

                    let id = $that.attr("data-id");

                    $.ajax({
                        url: location.origin + '/admin/modules/tours/ajax.php',
                        type:'POST',
                        data:{'id':id},
                        async:true,
                        success:function(data)
                        {
                            $that.after(data);
                        }
                    })
                });
            })
        </script>
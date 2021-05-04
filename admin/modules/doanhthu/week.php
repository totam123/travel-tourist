<?php
    $modules = 'doanhthu';
    $title_global = 'Danh Sách doanh thu trong tuần ';
    require_once __DIR__ .'/../../autoload.php';
    $sql = "SELECT book_tours.* ,book_tours.id as idtour ,tours.* , users.* FROM book_tours 
        LEFT JOIN tours ON book_tours.b_tour_id = tours.id 
        LEFT JOIN users ON book_tours.b_user_id = users.id
        WHERE book_tours.b_status = 1 AND YEARWEEK(book_tours.created_at, 1) = YEARWEEK(CURDATE(), 1) AND MONTH(book_tours.created_at) = MONTH(NOW())";
    $book_tour = Pagination::pagination('book_tours',$sql,'page',15);
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
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Đặt Tour</a></li>
                <li class="active"> Danh sách</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover border">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Thông tin</th>
                                <th>Tour Đặt</th>
                                <th>Số tiền</th>
                                <th>Ngày đặt</th>
                            </tr>
                                <?php if($book_tour)  :?>
                                <?php foreach ($book_tour as $key => $bt): ?>
                                        <tr>
                                            <td>
                                                <?= $key + 1 ?>
                                            </td>
                                            <td> 
                                                <p>Tên khách hàng  : <?= $bt['u_name'] ?></p>
                                                <p>Phone : <?= $bt['u_phone'] ?></p>
                                                <p>Địa chỉ : <?= $bt['u_address'] ?></p>
                                            </td>
                                            <td> <?= $bt['t_name'] ?></td>
                                            <td> <?= number_format($bt['b_total'],0,',','.') ?> VNĐ</td>
                                            <td><?= $bt['created_at']?></td>
                                        </tr>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="custome-paginate">
                        <div class="pull-right">
                            <?php echo Pagination::getListpage($filter='') ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
</div>
<?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
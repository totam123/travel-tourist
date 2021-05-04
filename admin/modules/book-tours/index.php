<?php
    // bien module de active cai menu
    $modules = 'book-tours';
    $title_global = 'Danh sách đặt tour ';
    require_once __DIR__ .'/../../autoload.php';
$sql = "SELECT book_tours.* ,book_tours.id as idtour ,tours.* , users.* FROM book_tours 
        LEFT JOIN tours ON book_tours.b_tour_id = tours.id 
        LEFT JOIN users ON book_tours.b_user_id = users.id
        ORDER BY book_tours.created_at DESC";
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
                                <th style="width: 20%">Tour Đặt</th>
                                <th>Số tiền</th>
                                <th>Trang thái</th>
                                <th>Thao tác</th>
                            </tr>
                            <?php if($book_tour)  :?>
                                <?php foreach ($book_tour as $bt): ?>
                                    <tr>
                                        <td>
                                            <?= $bt['idtour'] ?>
                                        </td>
                                        <td> 
                                            <p>Tên khách hàng  : <?= $bt['u_name'] ?></p>
                                            <p>Phone : <?= $bt['u_phone'] ?></p>
                                            <p>Địa chỉ : <?= $bt['u_address'] ?></p>
                                        </td>
                                        <td> <?= $bt['t_name'] ?></td>
                                        <td> <?= number_format($bt['b_total'],0,',','.') ?> VNĐ</td>
                                        <td>
                                        <?php if($_SESSION['type'] === 'admin'): ?>
                                            <a href="active.php?id=<?= $bt['idtour'] ?>" class="custome-btn label <?= $bt['b_status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $bt['b_status'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán ' ?></span></a>
                                        <?php else: ?>
                                            <div class="custome-btn label <?= $bt['b_status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $bt['b_status'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán ' ?></span></div>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="delete.php?id=<?= $bt['idtour'] ?>" class="custome-btn btn-danger btn-xs delete comfirm_delete" ><i class="fa fa-trash"></i> Xoá </a>
                                        </td>
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
<?php
    // bien module de active cai menu
    $modules = 'locations';
    $title_global = 'Danh sách địa điểm ';
    require_once __DIR__ .'/../../autoload.php';
    $locations = Pagination::pagination('locations',$sql='','page',15);
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
                <li><a href="#">Địa điểm</a></li>
                <li class="active"> Danh sách</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <a href="add.php" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới </a>
                </div>
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover border">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tên địa điểm</th>
                                <th>Vị trí</th>
                                <th>Địa điểm nổi bật</th>
                                <th>Trang thái</th>
                                <th>Thao tác</th>
                            </tr>
                            <?php if($locations)  :?>
                            <?php foreach ($locations as $key => $location): ?>
                                <tr>
                                    <td>
                                        <?= $location['id'] ?>
                                    </td>
                                    <td> <?= $location['loc_name'] ?></td>
                                    <td> <?= $location['loc_sort'] ?></td>
                                    <td>
                                        <a href="hot.php?id=<?= $location['id'] ?>" class="custome-btn label <?= $location['loc_hot'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $location['loc_hot'] == 1 ? 'Nổi bật' : 'Thường' ?></span></a>
                                    </td>
                                     <td><a href="active.php?id=<?= $location['id'] ?>" class="custome-btn label <?= $location['loc_status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $location['loc_status'] == 1 ? 'Hiện' : 'Ẩn' ?></span></a></td>
                                    <td>
                                        <a href="update.php?id=<?= $location['id'] ?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Cập nhật </a>
                                        <a href="delete.php?id=<?= $location['id'] ?>" class="custome-btn btn-danger btn-xs delete comfirm_delete" ><i class="fa fa-trash"></i> Xoá  </a>
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
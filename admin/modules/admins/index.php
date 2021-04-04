<?php
    $modules = 'admins';
    $title_global = 'Danh sách quản lý Admins';
    require_once __DIR__ .'/../../autoload.php';

    // level = 1 || cap do cong tac vien
    // level = 2 || admin
	$admins = Pagination::pagination('admins','SELECT * FROM admins WHERE level <= 2','page',9);
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
                        <li><a href="#"> Quản lý </a></li>
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
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <!-- <th>Cấp độ</th> -->
                                            <th>Trang Thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                        <?php if($admins) :?>
                                            <?php foreach ($admins as $admin) :?>
                                                <tr>
                                                    <td><?= $admin['id'] ?></td>
                                                    <td><?= $admin['name'] ?></td>
                                                    <td><?= $admin['email'] ?></td>
                                                    <td><?= $admin['phone'] ?></td>
                                                    <td>
                                                        <a href="active.php?id=<?= $admin['id'] ?>" class="custome-btn label <?= $admin['status'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $admin['status'] == 1 ? 'Hiện' : 'Ẩn' ?></span></a>
                                                        <a href="#" class="custome-btn label <?= $admin['level'] == 1 ? 'label-info' : 'label-default' ?>"><span><?= $admin['level'] == 1 ? 'Đang online' : 'Offline' ?></span></a>
                                                    </td>
                                                    <td>
                                                        <a href="update.php?id=<?= $admin['id']?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Cập nhật </a>
                                                        <a href="delete.php?id=<?= $admin['id']?>" class="custome-btn btn-danger btn-xs delete comfirm_delete" ><i class="fa fa-trash"></i> Xoá </a>
                                                    </td>
                                                 </tr>
                                            <?php endforeach; ?>
                                        <?php endif ;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
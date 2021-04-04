<?php
$modules = 'contacts';
$title_global = 'Danh sách liên hệ';
require_once __DIR__ .'/../../autoload.php';
$contact = Pagination::pagination('contact','','page',9);
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
                <li><a href="#"> Liên hệ </a></li>
                <li class="active"> Danh sách</li>
            </ol>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Thao tác</th>
                            </tr>
                            <?php if($contact) :?>
                                <?php foreach ($contact as $admin) :?>
                                    <tr>
                                        <td><?= $admin['id'] ?></td>
                                        <td><?= $admin['c_name'] ?></td>
                                        <td><?= $admin['c_email'] ?></td>
                                        <td><?= $admin['c_title'] ?></td>
                                        <td><?= $admin['c_content'] ?></td>
                                        <td>
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
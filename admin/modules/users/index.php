<?php
    require_once __DIR__ .'/../../autoload.php';
    $modules = 'users';
    $title_global = ' Danh sách  thành viên ';
    $sql = " SELECT * FROM users WHERE 1";
    $users = Pagination::pagination('users','','page',10);

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
                        <?= $title_global  ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li><a href="#">Thành viên</a></li>
                        <li class="active"> Danh sách thành viên  </li>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($users as $user) :?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['u_name'] ?></td>
                                                <td><?= $user['u_email'] ?></td>
                                                <td><?= $user['u_phone'] ?></td>
                                                <td><?= $user['u_address'] ?></td>
                                                <td>
                                                    <a href="delete.php?id=<?= $user['id'] ?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Xóa </a>
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
                                    <?php echo Pagination::getListpage() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require_once __DIR__ .'/../../layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/../../layouts/inc_js.php'; ?>
<?php
    $modules = 'news';
    $title_global = 'Quản lý bài viết';
    require_once __DIR__ .'/../../autoload.php';

    $sql = "SELECT * FROM news WHERE 1 ORDER   BY  ID DESC";
    $news = Pagination::pagination('news',$sql,'page',9);
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
                        <li><a href="#"> Bài viết </a></li>
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
                                            <th>STT</th>
                                            <th style="width: 25%">Tiêu đề</th>
                                            <th style="width: 13%">Kiểu bài viết</th>
                                            <th style="width: 35%">Mô tả</th>
                                            <th>Ảnh</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($news as $k => $new) :?>
                                        <tr>
                                            <td><?= $k + 1 ?></td>
                                            <td><?= $new['n_title'] ?></td>
                                            <td><?= $typeNews[$new['n_type']] ?></td>
                                            <td><?= $new['n_descriptions'] ?></td>
                                            <th>
                                                <img src="/uploads/news/<?= $new['n_images'] ?>" alt="" style="width: 60px;height: 60px">
                                            </th>
                                            <td>
                                                <a href="update.php?id=<?=  $new['id']?>" class="custome-btn btn-info btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                <a href="delete.php?id=<?= $new['id']?>" class="custome-btn btn-danger btn-xs delete" ><i class="fa fa-trash"></i> Xóa </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
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
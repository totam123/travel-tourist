<?php
    $modules = 'comments';
    $title_global = 'Danh Sách Comments ';
    require_once __DIR__ .'/../../autoload.php';
    $sql = "SELECT comments.* ,  users.u_email  FROM comments 
        LEFT JOIN  users  ON users.id = comments.c_user_id
        WHERE 1
    ";
    $filter = [];
    $email = Input::get('email');
    if ( $email ) {
        echo $sql .= ' AND u_email = "'.$email.'"' ;
        $filter['u_email'] = $email;
    }
    if ( Input::get('id') ) {
        $sql .= ' AND comments.id = '.(int)Input::get('id') ;
        $filter['id'] = Input::get('id');
    }
    $comments = Pagination::pagination('comments', $sql, 'page', 10);
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
                        <li class="active"> Danh sách comment </li>
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
                                    <input type="email" class="form-control" name="email" placeholder="email " value="<?= Input::get('email') ? Input::get('email') : '' ?>">
                                </div>
                                
                                <div class="form-group col-sm-2">
                                    <input type="number" name="id" class="form-control" value="<?= Input::get('id') ?>" placeholder="ID comments">
                                </div>
                                <div class="form-group col-sm-3">
                                    <input type="submit" value="Tìm Kiếm" class="btn btn-xs btn-success">
                                    <a  href="index.php" class="btn btn-xs btn-danger"> Làm mới<a/>
                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            
                        </div>
                        <div class="box-body">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover border">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th style="width: 30%">Email</th>
                                            <th>Nội Dung</th>
                                            <th>Ngày bình luận</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach($comments as $comment) :?>
                                            <tr>
                                                <td><?= $comment['id'] ?></td>
                                                <td><?= $comment['u_email'] ?></td>
                                                <td><?= $comment['c_content'] ?></td>
                                                <td><?= $comment['created_at'] ?></td>
                                                <td>
                                                    <a href="delete.php?id=<?= $comment['id'] ?>" class="custome-btn btn-danger btn-xs delete comfirm_delete" ><i class="fa fa-trash"></i> Xoá </a>
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
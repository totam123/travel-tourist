<?php
    $active = 'news';
    require_once __DIR__ .'/autoload.php';

    $id = Input::get('id');

    $sql = "SELECT news.*  FROM news  WHERE 1 and id = ".$id." "; 

    $new = DB::fetchsql($sql);
    $new = $new[0];


    $news_sugges = DB::query('news','*','  ORDER BY ID DESC limit 8');
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết bài viết</title>
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
    <!-- end -->

</head>
<body class="page-hotel-listing ">

<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
<div class="slider-lg" style="background:#FFEBCD">
    <div class="slider-content"style="background:#FFEBCD">
        <div class="bg-full" style="background:url(<?= path_url() ?>/public/images/logo/li.jpg) center top">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- breadcrumb -->
        <div class="col-xs-12" import-html="breadcrumb">
            <div class="breadcrumb-scroll">
                <ul class="breadcrumb scroll-y ps-container ps-active-x" id="breadcrumb-scroll">
                    <li><a href="/" class="events-tracking" data-category="Breadcrumbs" data-action="" data-label="non member">Bài viết</a></li>
                    <li class="active"><?= $new['n_title'] ?></li>
                </ul>
            </div>
        </div>

        <?php
        $locations  = DB::query('locations','*',' and loc_hot = 1 ');
        $sql_sale = "SELECT  t_name, t_sale,t_price,t_images,id FROM tours 
        WHERE 1 and t_status = 1 and  t_sale > 0 LIMIT 5";
        $tour_sale = DB::fetchsql($sql_sale);
        ?>
        <div class="col-md-3  sidebar">

            <div class="box box-toggle filter_tg_tl">
                <div class="box-header" js-t="js-toggle" style="background:#FFD700">
                    <h3 class="box-title">
                        Điểm đến phổ biến
                        <i class="fa fa-chevron-up pull-right"></i>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="toggle-body">
                        <ul class="nav nav-check-list">

                            <?php foreach ($locations as $loc): ?>
                                <li class="">
                                    <a href="/dia-diem.php?id=<?= $loc['id'] ?>"><i class="ui-checkbox"></i><?= $loc['loc_name'] ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="box box-toggle filter_tg_tl">
                <div class="box-header" js-t="js-toggle" style="background:#FFD700">
                    <h3 class="box-title">
                        Bài viết liên quan
                        <i class="fa fa-chevron-up pull-right"></i>
                    </h3>
                </div>
                <div class="box-body">
                    <div class="toggle-body">
                        <ul class="nav nav-check-list">

                            <?php foreach ($news_sugges as $ne): ?>
                                <li class="">
                                    <a style="    white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" href="/tin-tuc/<?= str_slug($ne['n_title']) ?>-<?= $ne['id']?>.html"><i class="ui-checkbox"></i><?= $ne['n_title'] ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="product product-tour">
                <div style="overflow: hidden"><?= $new['n_content'] ?></div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
</div>
</body>
</html>

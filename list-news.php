<?php

    require_once __DIR__ .'/autoload.php';


    if ($_REQUEST['type'] == 1) {
        $active = 'news';
    } else if ($_REQUEST['type'] == 2) {
        $active = 'hotel';
    } else if ($_REQUEST['type'] == 3) {
        $active = 'restaurant';
    } else {
        $active = 'news';
    }

    $new = Pagination::pagination('news','SELECT * FROM news WHERE n_type = ' .$_REQUEST['type'],'page', 5);

    $news_sugges = DB::query('news','*','  ORDER BY ID DESC limit 8');
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tin tức</title>
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
</head>
<body class="page-hotel-listing ">

<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
<div id="searchfixed" class="search-fixed"style="background:#FFEBCD">

</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12" import-html="breadcrumb">
            <div class="breadcrumb-scroll">
                <ul class="breadcrumb scroll-y ps-container ps-active-x" id="breadcrumb-scroll">
                    <li><a href="/" class="events-tracking" data-category="Breadcrumbs" data-action="" data-label="non member"><?php echo $typeNews[$_REQUEST['type']] ?></a></li>
                </ul>
            </div>
        </div>

        <?php
        $locations  = DB::query('locations','*',' and loc_hot = 1 ');

        // lay tour khuyen mai
        $sql_sale = "SELECT  t_name, t_sale,t_price,t_images,id FROM tours 
        WHERE 1 and t_status = 1 and  t_sale > 0 LIMIT 5";
        $tour_sale = DB::fetchsql($sql_sale);
        ?>
        <div class="col-md-3  sidebar">
            <div class="box box-toggle filter_tg_tl">
                <div class="box-header" js-t="js-toggle"style="background:#FFD700">
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
                <div class="box-header" js-t="js-toggle"style="background:#FFD700">
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
            <div class="group-filter">
                <div class="device-pc-none mg-r-20">
                    <a class="btn btn-blue btn-filter-show" href="javascript:;">
                        <i class="fa fa-bars"></i> Bộ lọc
                    </a>
                </div>

            </div>
            <div class="product product-tour">
                <div class="blog">
                    <?php foreach($new as $nw) :?>
                    <div class="col-sm-4">
                        <!-- blog-item -->
                        <div class="blog-item" style="height: 350px">
                            <a href="/tin-tuc/<?= str_slug($nw['n_title']) ?>-<?= $nw['id']?>.html">
                                <img class="img-responsive blog-img" src="<?php echo path_url() ?>/uploads/news/<?= $nw['n_images'] ?>" data-src="<?php echo path_url() ?>/uploads/news/<?= $nw['n_images'] ?>" alt="Vì sao Quảng Bình được mệnh danh là vương quốc hang động" title="Vì sao Quảng Bình được mệnh danh là vương quốc hang động" style="width:100%;height: 200px;">
                                <h2 class="blog-name"> <?= mb_substr($nw['n_title'],0,100, "utf-8"); ?> ...</h2>
                            </a>
                            <p class="blog-data">
                                <span>
                                <i class="fa fa-calendar"></i>
                                <span class="date"><?= $nw['created_at'] ?></span>
                                </span>
                            </p>
                            <div class="blog-item-content">
                                <?= mb_substr($nw['n_descriptions'],0,50, "utf-8"); ?> ...
                                <div class="box-tag">
                                    </div>
                                    <p class="blog-view-detail">
                                        <a href="/tin-tuc/<?= str_slug($nw['n_title']) ?>-<?= $nw['id']?>.html">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ;?>

                </div>
                <div class="clearfix"></div>
                <div class="box_paginator">
                    <div class="panigation-center">
                        <?= Pagination::getListpage() ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xs-12">
            <!-- Mô tả -->
            <div class=" listing-title">
            </div>
            <!-- /Mô tả -->
            <input type="hidden" id="listing-places" value="">
            <div id="place-near-box" class="box box-view-more box-custom-position hidden">
                <div class="box-header"style="background:#FFD700">
                    <h2 class="box-title">
                        Địa danh gần khách sạn
                    </h2>
                </div>
                <div class="box-body over_hidden">
                    <ul class="nav-thumbnails nav-thumbnails-list clearfix">
                    </ul>
                    <button class="btn-link btn-view-more" data-more="">
                        Xem thêm
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
</div>
</body>
</html>

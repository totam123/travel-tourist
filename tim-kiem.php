<?php
    require_once __DIR__ .'/autoload.php';
    $active = "tours";

    $loca = Input::get('location');

    $filter = [];
    $sql = "SELECT tours.* , locations.loc_name FROM tours 
            LEFT JOIN locations ON locations.id = tours.t_location_id
            WHERE 1 and t_status = 1 ";
    if ($loca) 
    {
        $filter['location'] = $loca;
       $sql .= " and t_name LIKE '%".$loca."%' or locations.loc_name like '%".$loca."%'";
    }

    if (Input::get('price'))
    {
        $price = Input::get('price');
        $filter['price'] = $price;
        if(array_key_exists($price,$arrayPrice))
        {
            $sql .= ' AND t_price BETWEEN ' .str_replace('.','',$arrayPrice[$price][0]) . ' AND ' . str_replace('.','',$arrayPrice[$price][1]) . ' ';
        }
    }

    if (Input::get('time'))
    {
        $filter['time'] = Input::get('time');
        $sql .= ' AND t_time  = '.$filter['time'];
    }


    $tours = Pagination::pagination('tours',$sql,'page',10);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tìm kiếm</title>
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
</head>
<body class="page-hotel-listing">

<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
<div id="searchfixed" class="search-fixed">

</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12" import-html="breadcrumb">
            <div class="breadcrumb-scroll">
                <ul class="breadcrumb scroll-y ps-container ps-active-x" id="breadcrumb-scroll">
                    <li><a href="/" class="events-tracking" data-category="Breadcrumbs" data-action="" data-label="non member">Danh sách tours</a></li>

                </ul>
            </div>
        </div>
        <?php include_once  __DIR__. '/layouts/inc_sidebar.php' ?>
        <div class="col-md-9">
            <div class="page-header">
                <div class="clearfix">
                    <h1 title="" class="title-lg pull-left">
                        <a href="">Kết quả tìm kiếm </a>
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-7">
                    </div>
                    <div class="col-sm-5 mg-t-10">
                        <!-- social -->
                        <ul class="list-inline">
                            <li class="fb-button">
                                <div class="fb-like" data-href="/c65/khach-san-tai-da-nang.html"
                                     data-layout="button_count"
                                     data-action="like" data-show-faces="false" data-share="true"></div>
                            </li>
                            <li class="gp-button">
                                <div class="g-plusone" data-size="medium"
                                     data-href="/c65/khach-san-tai-da-nang.html"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="group-filter">
                <div class="device-pc-none mg-r-20">
                    <a class="btn btn-blue btn-filter-show" href="javascript:;">
                        <i class="fa fa-bars"></i> Bộ lọc
                    </a>
                </div>

            </div>
            <div class="product product-tour">
                <?php foreach($tours as $tou) :?>
                    <div class="product-item row">
                        <div class="col-sm-9">
                            <h2 class="title-sm h3" title="">
                                <a class="product-name" href="/tour/<?= str_slug($tou['t_name']) ?>-<?= $tou['id'] ?>.html"><?= $tou['t_name'] ?></a>
                            </h2>
                        </div>
                        <div class="product-left-content col-sm-9">
                            <div class="product-info">
                                <div class="product-image">
                                    <a href="/tour/<?= str_slug($tou['t_name']) ?>-<?= $tou['id'] ?>.html">
                                        <img data-src="<?php echo path_url() ?>/uploads/tours/<?= $tou['t_images'] ?>" src="<?php echo path_url() ?>/uploads/tours/<?= $tou['t_images'] ?>" alt="" title="" class="img-responsive">
                                    </a>
                                    <a href="#" class="schedule" mytour-ext="ajax-modal" modal-name="modal-tour-schedule" data-tourid="140">
                                        <i class="fa fa-chevron-circle-right blue"></i> <span class="gray">Lịch trình</span>
                                    </a>
                                </div>
                                <div class="product-content">
                                    <ul class="nav list-unstyled device-mb-none">
                                        <li><strong>Ngày khởi hành:</strong> Hàng ngày</li>
                                        <li><strong>Thời gian:</strong> <?= array_key_exists($tou['t_time'],$arrayTime) ? $arrayTime[$tou['t_time']] : 'Đang cập nhật' ?></li>
                                        <li><strong>Điểm khởi hành:</strong> Hà Nội</li>
                                        <li><strong>Dành cho :</strong> <?= $tou['t_number_guests'] ?> người </li>
                                        <li><strong>Phương tiện:</strong>  <?= array_key_exists($tou['t_vehicle'],$arrayVehicle) ? $arrayVehicle[$tou['t_vehicle']] : 'Đang cập nhật' ?></li>
                                    </ul>
                                    <ul class="nav nav-list-gray">
                                        <li>
                                            <a mytour-ext="ajax-modal" modal-name="modal-sure-good-price">
                                                <i class="fa fa-check-circle green text-sm"></i>
                                                Đảm bảo giá tốt nhất!
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="review device-mb-none" data-toggle="tooltip tooltip-df">
                                        <small><?= $tou['t_schedule'] ?></small>
                                        <div data-toggle="tooltip-content"><?= $tou['t_policy'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-right-content col-sm-3">
                            <div class="box-review">
                                <span class="rate">8</span>
                                <span class="rate-info">Xuất sắc</span>
                            </div>
                            <div class="box-price">
                                <div class="item-price">
                                    <br>
                                    <strong class="price"><?= formatPrice($tou['t_price'],$tou['t_sale']) ?><small>đ</small></strong>
                                </div>
                                <a class="btn btn-yellow" href="/tour/<?= str_slug($tou['t_name']) ?>-<?= $tou['id'] ?>.html">
                                    Xem tour
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <hr class="dark">
                        </div>
                    </div>

                <?php endforeach ;?>
                <!-- /.product-item -->


            </div>
            <!-- /.product -->
            <div class="box_paginator">
                <!-- panigation-center -->
                <div class="panigation-center">
                    <?= Pagination::getListpage($filter) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class=" listing-title">
            </div>
            <input type="hidden" id="listing-places" value="">
            <div id="place-near-box" class="box box-view-more box-custom-position hidden">
                <div class="box-header">
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
    <!-- /menu-footer -->
</div>
<!-- mytour:js -->
<script src="/public/frontend/js/main.js" type="text/javascript" /></script>
</body>
</html>
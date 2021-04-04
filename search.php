<?php
    require_once __DIR__ .'/autoload.php';
    $sql = "SELECT tours.* ,  locations.loc_name FROM tours 
        LEFT JOIN  locations  ON locations.id = tours.t_location_id
        WHERE 1
    ";
    $keyword = Input::get('keyword');
    
    
    if ( $keyword ) { 
        $sql .= ' AND   t_name LIKE "%'.$keyword.'%"';
        $filter['keyword'] = $keyword;
    }

    $tours = Pagination::pagination('tours', $sql, 'page', 10);
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mytour.vn</title>
        <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="page-hotel-listing ">
        
        <?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
        <div id="searchfixed" class="search-fixed">
            
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12" import-html="breadcrumb">
                    <div class="breadcrumb-scroll">
                        <ul class="breadcrumb scroll-y ps-container ps-active-x" id="breadcrumb-scroll">
                            <li><a href="/" class="events-tracking" data-category="Breadcrumbs" data-action="" data-label="non member">Danh sách tour tại <?= $keyword ?></a></li>
                            
                        </ul>
                    </div>
                </div>
                <?php include_once  __DIR__. '/layouts/inc_sidebar.php' ?>
                <div class="col-md-9">
                    <div class="page-header">
                        <div class="clearfix">
                            <h1 title="" class="title-lg pull-left">
                                <a href="">Danh sách tour tại <?= $keyword ?></a>
                            </h1>
                            <small class="text-df" style="line-height:42px;padding-left:10px;">
                            
                            </small>
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
                                <!-- /.social -->
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
                                <h2 class="title-sm h3" title="Tour Thăm Quan Ngoại Thành Đà Lạt 1 Ngày">
                                    <a class="product-name" href="/tour/<?= str_slug($tou['t_name']) ?>-<?= $tou['id'] ?>.html"><?= $tou['t_name'] ?></a>
                                </h2>
                            </div>
                            <div class="product-left-content col-sm-9">
                                <div class="product-info">
                                    <div class="product-image">
                                        <a href="/tour/<?= str_slug($tou['t_name']) ?>-<?= $tou['id'] ?>.html">
                                        <img data-src="https://static.mytour.vn/resources/pictures/tours/medium_fkk1412673767.jpg" src="https://static.mytour.vn/resources/pictures/tours/medium_fkk1412673767.jpg" alt="Tour Thăm Quan Ngoại Thành Đà Lạt 1 Ngày" title="Tour Thăm Quan Ngoại Thành Đà Lạt 1 Ngày" class="img-responsive">
                                        </a>
                                        <a href="#" class="schedule" mytour-ext="ajax-modal" modal-name="modal-tour-schedule" data-tourid="140">
                                        <i class="fa fa-chevron-circle-right blue"></i> <span class="gray">Lịch trình</span>
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <ul class="nav list-unstyled device-mb-none">
                                            <li><strong>Ngày khởi hành:</strong> Hàng ngày</li>
                                            <li><strong>Thời gian:</strong> <?= array_key_exists($tou['t_time'],$arrayTime) ? $arrayTime[$tou['t_time']] : 'Đang cập nhật' ?></li>
                                            <li><strong>Điểm khởi hành:</strong> Lâm Đồng</li>
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
                            </div>>
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
                       
                    </div>
                    <div class="box_paginator">
                        <div class="panigation-center">
                            <?= Pagination::getListpage($filter='') ?>
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
                <div class="col-sm-12">
                    <div class="box-location" style="background-image:url(https://static3.mytour.vn/resources/pictures/locations/large_1hz1469089591.jpg)">
                        <div class="box-location-content">
                            <h2 class="text-sm"> Cẩm nang du lịch Đ&agrave; Nẵng </h2>
                            <ul class="list-unstyled">
                                <li> <a href = "/c65/463-an-gi-khi-du-lich-da-nang.html" > Ăn g&igrave; khi du lịch Đ&agrave; Nẵng? </a ></li >
                                <li> <a href = "/c65/466-du-lich-da-nang-ly-tuong-nhat-vao-luc-nao.html" > Du lịch Đ&agrave; Nẵng l&yacute; tưởng nhất v&agrave;o l&uacute;c n&agrave;o? </a ></li >
                                <li> <a href = "/c65/469-nhung-dieu-can-luu-y-khi-du-lich-da-nang.html" > Những điều cần lưu &yacute; khi du lịch Đ&agrave; Nẵng </a ></li >
                                <li> <a href = "/c65/464-o-dau-khi-du-lich-da-nang.html" > Ở đ&acirc;u khi du lịch Đ&agrave; Nẵng? </a ></li >
                                <li> <a href = "/c65/467-di-chuyen-bang-gi-khi-du-lich-da-nang.html" > Di chuyển bằng g&igrave; khi du lịch Đ&agrave; Nẵng? </a ></li >
                                <li> <a href = "/c65/470-choi-gi-khi-du-lich-da-nang.html" > Chơi g&igrave; khi du lịch Đ&agrave; Nẵng? </a ></li >
                                <li> <a href = "/c65/465-du-lich-da-nang-mua-gi-ve-lam-qua.html" > Du lịch Đ&agrave; Nẵng mua g&igrave; về l&agrave;m qu&agrave;? </a ></li >
                                <li> <a href = "/c65/468-da-nang-va-nhung-net-van-hoa-thu-vi.html" > Đ&agrave; Nẵng v&agrave; những n&eacute;t văn h&oacute;a th&uacute; vị </a ></li >
                                <li> <a href = "/c65/472-cam-nang-du-lich-da-nang-tu-a-z.html" > Cẩm nang du lịch Đ&agrave; Nẵng từ A - Z </a ></li >
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blue fade" id="getGoodPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="modal-title" id="exampleModalLabel">XEM BÁO GIÁ QUA EMAIL</p>
                    </div>
                    <div class="modal-body">
                        <div class="show_error alert alert-info">
                            <strong>Giá tốt nhất</strong> sẽ thay đổi theo ngày nhận phòng của bạn.
                        </div>
                        <form class="form-search form-search-date" data-toggle="validator" role="form" id="requesPrice">
                            <div class="form-group">
                                <div class="box-search box_js_arrow">
                                    <div class="form-search ">
                                        <div class="mt-datepicker t-datepicker js_arrow datepicker-modal">
                                            <div class="t-check-in"></div>
                                            <div class="t-check-out"></div>
                                        </div>
                                    </div>
                                </div>
                                <input id="good_price_checkin" type="hidden" class="form-control datepicker-df check-in"
                                    value="04/07/2018" name="check-in"/>
                                <input id="good_price_checkout" type="hidden" class="form-control datepicker-df check-out"
                                    value="05/07/2018" name="check-out"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tên khách hàng<small class="red">*</small></label>
                                <input type="text" name="name" required class="form-control cus_name" tabindex="1" data-error="Tên khách hàng không chính xác!" value="">
                                <p class="help-block red with-errors"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email<small class="red">*</small></label>
                                <input type="email" name="email" required class="form-control cus_email" tabindex="2" placeholder="example@gmail.com" data-error="Email không hợp lệ!" value="">
                                <p class="help-block red with-errors"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Số điện thoại<small class="red">*</small></label>
                                <input type="tel" data-minlength="9" name="phone" required class="form-control cus_phone" tabindex="3" data-error="Số điện thoại không chính xác!" value="">
                                <p class="help-block red with-errors"></p>
                            </div>
                            <input type="hidden" class="hot_id get_good_price" name="hot_id" value=""/>
                            <input type="hidden" class="cus_type cus_good_price" name="cus_type" value="">
                            <input type="hidden" class="room_id room_info_price" name="room_id" value=""/>
                            <input type="hidden" class="rate_id rate_info_price" name="rate_id" value="" />
                            <input type="hidden" class="events-tracking" data-category="Request_price_Submit" data-route="hotel-listing" data-action="Listing" data-label="non member">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-gray" data-dismiss="modal">Huỷ</button>
                            <button type="submit" class="btn btn-blue cl-request-price">Gửi yêu cầu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal YeuCauGiaModal -->
        <div class="footer">
            <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
            <!-- /menu-footer -->    
        </div>
        <script src="/public/frontend/js/main.js" type="text/javascript" /></script>
        <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=vi-VN&key=AIzaSyB-NX6fMciZIPFTLgZvmQIHF2Arws4V-Lk"></script>
        <div class="modal modal-blue fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </body>
</html>
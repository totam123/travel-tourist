<?php
    require_once __DIR__ .'/autoload.php';
    $active = "";
    // lay ra dia diem noi bat  o viet nam
    $locations  = DB::query('locations','*',' and loc_hot = 1 ');
    // dd($locations);

    // lay tin tu cmoi nhat

    $news = DB::query('news','*','  ORDER BY ID DESC limit 8');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Đồ án tốt nghiệp</title>
        <meta name="description" content="">
        <link rel="canonical" href="/" />
        <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
        <!-- mytour:css -->
        <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?= path_url() ?>/public/admin/js/jquery.min.js"></script>
        <style>
           .img-responsive:hover{
            opacity: 0.5 !important;
           }
           .item-thumbnail{
               border-radius:7rem !important;
               transition: transform 1s ease-in-out;
           }
           .item-thumbnail:hover {
            transform: rotateY(180deg);
           }
        </style>
    </head>
    <body class="page-home">
        <?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
        <div class="slider-lg" style="background:#FFEBCD">
           <div class="slider-content"style="background:#FFEBCD">
              <div class="bg-full" style="background:url(<?= path_url() ?>/public/images/logo/li.jpg) center top">
              </div>
              <div class="container">
                 <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                       <div class="box-search"style="background:#ed0080">
                          <div class="box-search-header">
                             <h1 class="mg-0 mg-bt-5 h2" title="Đặt tour du lịch Việt Nam và quốc tế">Bạn muốn đi du lịch ở đâu?</h1>
                          </div>
                          <form class="form-search" action="/tim-kiem.php">
                                <input  style="margin-bottom: 40px" type="text" class="form-control" id="header-search" name="location" autocomplete="off" placeholder="Tìm kiếm theo địa điểm hoạc tên tour ">
                             </div>
                             <div class="form-group row">
                                <div class="col-sm-6 col-sm-offset-3">
                                   <button style="margin-top: 20px;" type="submit" class="btn btn-block btn-lg btn-yellow">Tìm Tour</button>
                                </div>
                             </div>
                          </form>
                          <div id="suggesstion-box"></div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    <!-- box-list-thumbnails Popular Destinations -->
        <div class="box-thumbnails mg-bt-30">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="title-sm text-uppercase h5" title="Đặt phòng khách sạn phổ biến Việt Nam">
                            <strong>ĐIỂM ĐẾN Phổ biến Việt Nam</strong>
                        </h2>
                    </div>
                    <div class="body-thumbnails">
                        <ul class="nav-thumbnails">

                            <?php foreach($locations as $loc) :?>
                                <li class="col-sm-4 col-md-3">
                                    <div class="item-thumbnail">
                                        <a title="Địa điểm ở<?= $loc['loc_name'] ?>" href="/dia-diem.php?id=<?= $loc['id'] ?>" class="events-tracking" data-category="Home" data-action="popular-cities" data-label="">
                                            <img class="img-responsive" src="<?php echo path_url() ?>/uploads/tours/<?= $loc['loc_image'] ?>" alt="" title="" onerror="this.onerror=null;this.src='<?php echo path_url() ?>/uploads/noimage.jpg';">
                                            <h3 class="item-name" style="background:#ed0080""><?= $loc['loc_name'] ?></h3>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- /body-thumbnails -->
                </div>
            </div>
        </div>

        <div class="box-thumbnails mg-bt-30">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="title-sm text-uppercase h5" title="Đặt phòng khách sạn phổ biến Việt Nam">
                            <strong>Bài viết mới nhất</strong>
                        </h2>
                    </div>
                    <div class="body-thumbnails">
                        <ul class="nav-thumbnails">
                            <?php foreach($news as $new) :?>
                                <li class="col-sm-4 col-md-3">
                                    <div class="item-thumbnail">
                                        <a title="Khách sạn tại <?= $new['n_title'] ?>" href="/tin-tuc/<?= str_slug($new['n_title']) ?>-<?= $new['id']?>.html" class="events-tracking" data-category="Home" data-action="popular-cities" data-label="">
                                        <img class="img-responsive" style="height: 270px" src="<?php echo path_url() ?>/uploads/news/<?= $new['n_images'] ?>"  alt="" title="" onerror="this.onerror=null;this.src='<?php echo path_url() ?>/uploads/noimage.jpg';">
                                            <h3 class="item-name" style="background:#ed0080""><span style="    font-size: 14px;line-height: 22px;font-weight: 500;"><?= mb_substr($new['n_title'],0,70, "utf-8"); ?> ...</span></h3>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            <div class="clearfix"></div>

                        </ul>
                    </div>
                    <!-- /body-thumbnails -->
                </div>
            </div>
        </div>

    <!-- /box-list-thumbnails -->
    <!-- box commercial -->
        <div class="container">
        <div class="row">
            <div class="bxslider-sm col-sm-6 slider-deal-home">
                <ul class="bxslider">
                    <?php for($i= 1 ; $i <= 2 ; $i ++) :?>
                    <li>
                        <a href="">
                            <img src="<?php path_url()?>/public/images/slider.jpg" alt="" height=415 title="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="<?php path_url()?>/public/images/sliders.jpg" alt="" height=415 title="">
                        </a>
                    </li>

                    <?php endfor ; ?>

                </ul>
            </div>
            <!-- /bxslider-sm -->
            <div class="why-mytour why-mytour-responsive col-sm-6">
                <div class="why-mytour-content">
                   
                    <img class="img-responsive"
                         src="<?php echo path_url() ?>/public/frontend/images/bg-why-mytour.jpg" alt="">
                    <ul class="nav nav-list-icon">
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> <strong>Giá tốt hơn</strong> so với đặt
                            phòng trực tiếp tại khách sạn
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Đảm bảo
                            <strong data-toggle="modal" mytour-ext="ajax-modal" modal-name="modal-sure-good-price">giá tốt nhất
                                <i class="fa fa-question-circle blue"></i>
                            </strong>
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Đảm bảo
                            <strong data-toggle="modal" mytour-ext="ajax-modal" modal-name="modal-sure-back-money">hoàn tiền
                                <i class="fa fa-question-circle blue"></i>
                            </strong>
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Nhân viên chăm sóc, tư vấn nhiều kinh
                            nghiệm
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Hơn <strong>5000</strong> khách sạn tại
                            Việt Nam với đánh giá thực
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Nhiều chương trình khuyến mãi và tích lũy
                            điểm
                        </li>
                        <li>
                            <i class="fa fa-check-circle green text-sm"></i> Thanh toán <strong>dễ dàng, đa
                                dạng</strong>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /why-mytour -->
        </div>
    </div>
    <!-- box commercial -->
    <!-- slider banner -->
    <!-- /slider banner -->
   
        <!-- menu-footer -->
            <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
        <!-- /menu-footer -->
    <!-- mytour:js -->
    </body>

</html>
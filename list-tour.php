<?php
    require_once __DIR__ .'/autoload.php';
    $active = "tours";


    $sql = "SELECT tours.* , locations.loc_name FROM tours 
                LEFT JOIN locations ON locations.id = tours.t_location_id
                WHERE 1 and t_status = 1 ";

    $filter = [];

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

    $news_sugges = DB::query('news','*','  ORDER BY ID DESC limit 8');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Danh sách tour</title>
        <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
        <style>
        .checked {
            color: orange;
        }
        .stars{
            margin-left:60%;
        }
        </style>
    </head>
    <body class="page-hotel-listing">
        
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
                            <h2 title="" class="title-lg pull-left"style="color:blue;font-size:30px;">
                            <strong>Danh sách Tours</strong>
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                            </div>
                            <div class="col-sm-5 mg-t-10">
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
                                    <a class="product-name" href="tour-detail.php?id=<?= $tou['id'] ?>"><?= $tou['t_name'] ?></a>
                                </h2>
                            </div>
                            <div class="product-left-content col-sm-9">
                                <div class="product-info">
                                    <div class="product-image">
                                        <a href="tour-detail.php?id=<?= $tou['id'] ?>">
                                        <img data-src="<?php echo path_url() ?>/uploads/tours/<?= $tou['t_images'] ?>" src="<?php echo path_url() ?>/uploads/tours/<?= $tou['t_images'] ?>" alt="" title="" class="img-responsive">
                                        </a>
                                        
                                    </div>

                                    <div class="product-content">
                                        <ul class="nav list-unstyled device-mb-none">
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
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <div class="box-price"style="background:#FFEBCD">
                                    <div class="item-price">
                                        <br>
                                        <strong class="price"><?= formatPrice($tou['t_price'],$tou['t_sale']) ?><small>đ</small></strong>
                                    </div>
                                    <a class="btn btn-yellow" href="tour-detail.php?id=<?= $tou['id'] ?>">
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
                            <?= Pagination::getListpage($filter) ?>
                        </div>                  
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="box-location">
                        <div class="box-location-content">
                            <h2 class="text-sm"> Cẩm nang du lịch </h2>
                            <ul class="list-unstyled">
                                <?php foreach($news_sugges as $news): ?>
                                    <li> <a href = "/tin-tuc/<?= str_slug($news['n_title']) ?>-<?= $news['id']?>.html" > <?= the_excerpt($news['n_title'] ,80) ?> </a ></li >
                                <?php endforeach ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
   
        </div>
        <!-- mytour:js -->
    </body>
</html>
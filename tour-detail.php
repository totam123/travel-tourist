<?php
    require_once __DIR__ .'/autoload.php';
    $active = "tours";
    $id = Input::get('id');


    $sql = "SELECT tours.* , locations.loc_name,locations.id as id_loca FROM tours 
        LEFT JOIN locations ON locations.id = tours.t_location_id
        WHERE 1 and t_status = 1 and  tours.id = ".$id."
    ";

    $tour = DB::fetchsql($sql);

    $tour = $tour[0];

     // lay ra dia diem noi bat  o viet nam
    $locations  = DB::query('locations','*',' and loc_hot = 1 ');

    // lay tour khuyen mai
    $sql_sale = "SELECT  t_name, t_sale,t_price,t_images,id FROM tours 
        WHERE 1 and t_status = 1 and  t_sale > 0 LIMIT 5";

    $tour_sale = DB::fetchsql($sql_sale);
    //Get,post: phương thức gửi request
    // xử lý comment sản phẩm 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $content = Input::get('cmt_content'); // Lấy nội dung comment
        $data = 
        [
            'c_user_id'    => $_SESSION['id_user'] ,
            'c_content'    => $content,
            'c_tour_id'    => $id 
        ];

        if ($user)
        {
            $data['cmt_user_id'] = $user['id'];
        }

        //tiến hành insert 
        $id_insert = DB::insert('comments',$data);

        if($id_insert > 0)
        {
            // insert thanh cong
            // gán session thông báo thành công
            $_SESSION['success'] = "Thêm mới thành công ";
            $_SESSION['flag_comment'] = 1;
            //redirect: điều hương trang
            header("Location: ".'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);exit();
        }
    }

    // lay danh sach comment cua tour 
    $sqlcmt  = "SELECT comments.* , users.u_email  FROM comments 
        LEFT JOIN users ON users.id = comments.c_user_id WHERE 1  AND c_tour_id = ".$id." ORDER BY ID DESC lIMIT 6
    ";

    $comment = DB::fetchsql($sqlcmt);

    $sql = "SELECT tours.* , locations.loc_name,locations.id as id_loca FROM tours 
            LEFT JOIN locations ON locations.id = tours.t_location_id
            WHERE t_status = 1 and  tours.t_location_id  = ".$tour['t_location_id']." AND tours.id != ".$id."
        ";
    //query: câu truy vấn
    $tourInvolve = DB::fetchsql($sql);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chi tiết tour</title>
        <meta name="description" content="Tour du lịch thành phố Nha Trang trong 1 ngày giá tốt nhất từ 450,000. Đảm bảo hoàn tiền tại Mytour.vn. Có đánh giá thực từ nhiều khách hàng đã sử dụng. Chăm sóc khách hàng chuyên nghiệp.">
    
        <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
        <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
       
    </head>
    <body class="page-tour-detail ">
       
        <?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
        <div class="slider-lg" style="background:#FFEBCD">
           <div class="slider-content"style="background:#FFEBCD">
              <div class="bg-full" style="background:url(<?= path_url() ?>/public/images/logo/li.jpg) center top">
              </div>
           </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12" import-html="breadcrumb">
                    <div class="breadcrumb-scroll">
                        <ul class="breadcrumb scroll-y ps-container ps-active-x" id="breadcrumb-scroll">
                            <li><a href="javascript:;" class="events-tracking" data-category="Breadcrumbs" data-action="Tour du lịch" data-label="non member">Tour du lịch</a></li>
                            <li><a href="" class="events-tracking" data-category="Breadcrumbs" data-action="Tour du lịch Việt Nam" data-label="non member"><?= $tour['loc_name'] ?></a></li>
                            <li><a href="javascript:;" class="events-tracking" data-category="Breadcrumbs" data-action="Tour du lịch Kh&aacute;nh H&ograve;a" data-label="non member"><?= $tour['t_name'] ?></a></li>
                           
                        </ul>
                    </div>
                </div>
                <div id="sidebar-scroll">
                    <?php include_once  __DIR__. '/layouts/inc_sidebar.php' ?>
                </div>
                <div class="col-md-9 filter_tg_tl">
                    <div class="page-header">
                        <h1 class="title-lg" style="color:black;font-size:30px;"><?= $tour['t_name'] ?></h1>
                    </div>
                    <div class="slider-sm">
                        <p style="text-align: center;" id="loading-slider"><img style="width: 100%; height: 500px;"
                            src="<?= path_url() ?>/uploads/tours/<?php echo $tour['t_images'] ?>"/>
                    </div>
                    <div class="box">
                        <div class="box-body row">
                            <dl class="dl-horizontal mg-bt-0 col-sm-8">
                                <dt>Tour ID</dt>
                                <dd><?= $tour['id'] ?></dd>
                                <dt>Ngày khởi hành:</dt>
                                <dd><?= isset($tour['t_time_start']) ? date_format(date_create($tour['t_time_start']), 'Y/m/d') : 'Hàng ngày'?></dd>
                                <dt>Thời gian:</dt>
                                <dd><?= array_key_exists($tour['t_time'],$arrayTime) ? $arrayTime[$tour['t_time']] : 'Đang cập nhật' ?></dd>
                                <dt>Dành cho:</dt> <dd><?= $tour['t_number_guests'] ?> người</dd>
                                <dt>Điểm đến:</dt>
                                <dd><?= $tour['loc_name'] ?> - Việt Nam</dd>
                                <dt>Phương tiện:</dt>
                                <dd><?= array_key_exists($tour['t_vehicle'],$arrayVehicle) ? $arrayVehicle[$tour['t_vehicle']] : 'Đang cập nhật' ?></dd>
                            </dl>
                            <div class="col-sm-12 device-mb-show">
                                <hr class="dark">
                            </div>
                            <div class="box-price col-sm-4 text-right">
                                <div class="item-price">
                                    <strong class="price text-lg-1"><?= formatPrice($tour['t_price'],$tour['t_sale']) ?> <small>đ</small></strong>
                                </div>
                                <h4 class="text-danger">Sale <?= $tour['t_sale'] ?>%</h4>
                                <a class="btn btn-blue btn-lg mg-t-10" href="<?= path_url() ?>/boox-tour.php?id=<?= $tour['id'] ?>&guests=<?= $tour['t_number_guests'] ?>">
                                Đặt ngay
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body">
                            <dl class="dl-horizontal mg-bt-0">
                                <dt>Tên nhà cung cấp:</dt>
                                <dd> C&Ocirc;NG TY CỔ PHẦN TRAVEL TÂM VIỆT NAM<br> </dd>
                                <dt>Địa chỉ:</dt>
                                <dd> BÌNH DƯƠNG<br> </dd>
                                <dt>SĐT liên hệ:</dt>
                                <dd>
                                    TP.HCM : 0564841529
                                    <br>
                                    HÀ NỘI : 0913767674
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <!-- Giá bao gồm -->
                    <div class="box box-toggle">
                        <div class="box-header" js-t="js-toggle"style="background:#FFEBCD">
                            <div class="box-title">
                                Nội dung <i class="fa fa-chevron-up pull-right"></i>
                            </div>
                        </div>
                         <div class="box-body">
                            <?= $tour['t_content'] ?>
                        </div>
                    </div>
                    <!-- /.Giá bao gồm -->
                    <!-- Lịch trình -->
                    <div class="box box-toggle">
                        <div class="box-header" js-t="js-toggle"style="background:#FFEBCD">
                            <div class="box-title">
                                Lịch trình <i class="fa fa-chevron-up pull-right"></i>
                            </div>
                        </div>
                        <div class="box-body"><?= $tour['t_schedule'] ?></div>
                    </div>
                    <!-- /.Lịch trình -->
                    <!-- Chính sách tour -->
                    <div class="box box-toggle">
                        <div class="box-header" js-t="js-toggle"style="background:#FFEBCD">
                            <div class="box-title">
                                Chính sách  <i class="fa fa-chevron-up pull-right"></i>
                            </div>
                        </div>
                        <div class="box-body">
                            <?= $tour['t_policy'] ?>
                        </div>
                       
                    </div>
                    <!-- /.Chính sách tour -->
                    <!-- Đánh giá tour -->
                    <div class="box" id="box_review_tour">
                        <div class="box-header"style="background:#FFEBCD">
                            <div class="box-title h3">
                                Đánh giá Tour du lịch
                            </div>
                           
                        </div>
                        <div class="box-body">
                        	<?php if (isset($_SESSION['id_user'])): ?>
                        		<a href="javascript:;void(0)" class="btn-comment" style="margin-bottom: 10px;">Click vào đây để bình luận</a><br>
                        	<?php else :?>
                        		<a href="/login.php">Đăng nhập để bình luận</a><br>
                        	<?php endif ;?>
                        	
                        	<div id="form-comment" class="" style="display: none">
                            	<div style="border: 1px solid #dedede;margin-bottom: 10px;background-color: white;margin-top: 20px;">
								    <div id="form-comment" class="col-sm-12">
								        <h5 style="border-bottom: 2px solid ;padding-bottom: 10px;padding-top: 10px;"> Gủi bình luận của bạn </h5>
								        <form method="POST" action="">
								            <div class="form-group" style="padding-top: 10px;">
								                <label for="usr">Họ Tên hoạc Email <span style="color: red">*</span></label>
								                <input type="text" class="form-control" id="usr" name="cmt_name" readonly required value="<?= $_SESSION['email_user'] ?>">
								            </div>
								            <div class="form-group">
								                <label for="usr">Nội Dung <span style="color: red">*</span></label>
								                <textarea name="cmt_content" id="" cols="30" rows="3" class="form-control wysihtml5" required></textarea>
								            </div>
								            <div class="form-group">
								                <input type="submit" class="form-control btn btn-xs btn-success" id="pwd" value="&nbsp;Gửi đi">
								            </div>
								        </form>
								    </div>
								    <div class="clearfix"></div>
								   
								</div>
                            </div>
                            <?php  if (count($comment) > 0) :?>
                            <?php foreach($comment as $cmt) :?>
                                <div class="col-sm-12" style="margin-bottom:5px;">
                                    <div class="media" style="position: relative;">
                                        <div class="media-left">
                                            <img src="/public/frontend/images/user-default.png" onerror="this.onerror=null;this.src='/public/user-default.png';" class="media-object" style="width:60px">
                                        </div>
                                        <div class="media-body">
                                            <h6 style="font-size:14px;" class="media-heading"><a href="javascript:;void(0)" style="color:red;font-weight:bold"><?= $cmt['u_email'] ?></a></h6>
                                            <div class="main-comment">
                                                <?php echo $cmt['c_content'] ?>.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php endforeach ; ?>
                            <?php else : ?>
                                <p class="text-danger"> Chưa có bình luận nào !</p>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title-sm text-uppercase h5" title="Tour du lịch phổ biến Việt Nam" align="center" style="color:red;font-size:30px;">
                            <strong>Danh sách tour liên quan</strong>
                        </h2>
                        <div class="product product-tour">
                            <div class="blog">
                                <?php foreach($tourInvolve as $itemTour) :?>
                                    <div class="col-sm-4">
                                        <!-- blog-item -->
                                        <div class="blog-item" style="height: 350px">
                                            <a href="tour-detail.php?id=<?= $itemTour['id'] ?>">
                                                <img class="img-responsive blog-img" src="<?php echo path_url() ?>/uploads/tours/<?= $itemTour['t_images'] ?>" data-src="<?php echo path_url() ?>/uploads/tours/<?= $itemTour['t_images'] ?>" style="width:100%;height: 200px;">
                                                <h2 class="blog-name"> <?= mb_substr($itemTour['t_name'],0,100, "utf-8"); ?> ...</h2>
                                            </a>
                                            <p class="blog-data">
                                                <span>
                                                <i class="fa fa-calendar"></i>
                                                <span class="date"><?= $itemTour['created_at'] ?></span>
                                                </span>
                                            </p>
                                            <div class="blog-item-content">
                                                <div style="width: 50%;float: left;">
                                                    <p>Địa điểm : <?= $itemTour['loc_name'] ?></p>
                                                    <p>Giá tiền : <?= $itemTour['t_price'] ?></p>
                                                </div>
                                                <div>
                                                    <p>Dành cho :  <?= $itemTour['t_number_guests'] ?> người</p>
                                                    <p>Phương tiện : <?= array_key_exists($itemTour['t_vehicle'],$arrayVehicle) ? $arrayVehicle[$itemTour['t_vehicle']] : 'Đang cập nhật' ?></p>
                                                </div>
                                                <div class="box-tag">
                                                </div>
                                                <p class="blog-view-detail">
                                                    <a href="tour-detail.php?id=<?= $itemTour['id'] ?>" style="margin-top: 10px">Xem thêm <i class="fa fa-angle-double-right"></i></a>
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
                </div>
            </div>
        </div>
       
        <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>

        <script src="https://static.mytour.vn/themes/js/jquery.flexslider-min.js"></script>
        
        <script async type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
        <script type="text/javascript">
        	$(function(){
        		$(".btn-comment").click(function(){
        			$("#form-comment").slideToggle();
        		})
        	})
        </script>
    </body>
</html>
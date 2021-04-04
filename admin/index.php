
<?php
	require_once __DIR__ .'/autoload.php';
    $countLocations = DB::countTable('locations');
	$countTours = DB::countTable('tours');
	$countUsers = DB::countTable('users');
	$countNews = DB::countTable('news');
	// doanh thu ngay
	$day = date('d');
	$sqltime2= "SELECT SUM(b_total) as doanhthu FROM book_tours WHERE b_status = 1 AND DAY(`created_at`) = $day";
	$amountDay = DB::fetchsql($sqltime2);
	//doanh thu thang
	$month = date('m');
	$sqltime3 = "SELECT SUM(b_total) as doanhthu FROM book_tours WHERE b_status = 1 AND MONTH(`created_at`) = $month";
	$amountMonth = DB::fetchsql($sqltime3);
	//doanh thu theo tuan
	$sqltime4 = "SELECT SUM(b_total) as doanhthu FROM book_tours WHERE b_status = 1 AND YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1) AND MONTH(`created_at`) = $month";
	$amountWeek = DB::fetchsql($sqltime4);
	//tong doanh thu
	$sqltime5 = "SELECT SUM(b_total) as doanhthu FROM book_tours WHERE 1";
	$amountSum = DB::fetchsql($sqltime5);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> <?= isset($title_global) ? $title_global : 'Trang admin ' ?>  </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require_once __DIR__ .'/layouts/inc_css.php'; ?>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <div class="wrapper">
            
            <?php require_once __DIR__ .'/layouts/inc_header.php'; ?>
            <?php require_once __DIR__ .'/layouts/inc_sidebar.php'; ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>QUẢN TRỊ WEBSITE</h1>
                    <ol class="breadcrumb">
                        <li class="active"><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="box">
                        <div class="box-body border mr-t-10">
                            <div class="row">
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3><?= $countLocations ?></h3>
                                            <p> Địa điểm </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="/admin/modules/locations" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3><?= $countTours ?></h3>
                                            <p> Danh sách tours </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="/admin/modules/tours" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3><?= $countUsers ?></h3>
                                            <p> Khách hàng </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="/admin/modules/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-6">
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3><?= $countNews ?></h3>
                                            <p> Tin Tức </p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="/admin/modules/news" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh thu hôm nay</span>
                                            <span class="info-box-number"><?= format_price($amountDay[0]['doanhthu']) ?> đ</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh thu tuần</span>
                                            <span class="info-box-number"><?= format_price($amountWeek[0]['doanhthu']) ?></span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh Thu Tháng Nay</span>
                                            <span class="info-box-number"><?= format_price($amountMonth[0]['doanhthu']) ?>đ</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Doanh Thu Năm </span>
                                            <span class="info-box-number"><?= format_price($amountSum[0]['doanhthu']) ?>đ</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>
            </div>
            <?php require_once __DIR__ .'/layouts/inc_footer.php'; ?>
        </div>
        <?php require_once __DIR__ .'/layouts/inc_js.php'; ?>
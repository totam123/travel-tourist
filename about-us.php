<?php
    require_once __DIR__ .'/autoload.php';
    $active = 'abouts';
    $tours = Pagination::pagination('tours',$sql='','page',15);
    $locations  = DB::query('locations','*',' and loc_hot = 1 ');

      // lay tour khuyen mai
    $sql_sale = "SELECT  t_name, t_sale,t_price,t_images,id FROM tours 
        WHERE 1 and t_status = 1 and  t_sale > 0 LIMIT 5";
    $tour_sale = DB::fetchsql($sql_sale);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Về chúng tôi</title>
        <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
        <script type="text/javascript" src="<?= path_url() ?>/public/admin/js/jquery.min.js"></script>
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
                            <li><a href="/" class="events-tracking" data-category="Breadcrumbs" data-action="" data-label="non member">Về chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
                <?php include_once  __DIR__. '/layouts/inc_sidebar.php' ?>
                <div class="col-md-9">
                    <div class="page-header">
                        <div class="clearfix">
                            <h1 title="" class="title-lg pull-left">
                                <a href="">Về chúng tôi</a>
                            </h1>
                            <small class="text-df" style="line-height:42px;padding-left:10px;">
                                
                            </small>
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
                        <div class="rtejustify"><span style="font-size:14px;"><strong> Công ty Lữ hành MyTour</strong> – Tổng Công ty Du lịch Hà Nội xin gửi tới Quý khách lời chào trân trọng và lời chúc sức khỏe, hạnh phúc, an khang - thịnh vượng!<br>
                        Tổng Công ty Du lịch Hà Nội là doanh nghiệp nhà nước có vị thế hàng đầu trong các lĩnh vực: kinh doanh lữ hành quốc tế, khách sạn, nhà hàng, vận chuyển,&nbsp; xuất khẩu lao động… &nbsp;với hơn 50 năm xây dựng và trưởng thành, Công ty Lữ hành chúng tôi nhiều năm liền đạt danh hiệu “Top ten Lữ hành quốc tế” của Tổng cục Du lịch và hạng A1 “Top five” trong số ít các công ty lữ hành có số lượng khách Việt Nam đi nước ngoài đông nhất của hãng Hàng không Quốc gia Việt Nam (Vietnamairlines)…</span><br>
                            &nbsp;
                        </div>

                        <div class="rtejustify"><span style="font-size:14px;"> Trong xu thế hội nhập, để không ngừng đáp ứng nhu cầu tham quan, học tập, khảo sát, tham dự hội chợ, triển lãm, hội thảo, giao lưu và hợp tác ngày càng cao của Quý khách, với phương châm <strong>“Tất cả vì sự hài lòng của khách hàng”,</strong> chúng tôi xin trân trọng giới thiệu tới Quý khách các chương trình <strong>“Vòng quanh Thế giới” và "Đất nước muôn màu". </strong><br>
                        Hy vọng rằng, đây sẽ là những thông tin bổ ích và thiết thực về các sản phẩm du lịch tiêu biểu và hấp dẫn đến hấu hết các thắng cảnh của Tổ quốc và các quốc gia trên thế giới mà công ty chúng tôi đã và đang thực hiện rất thành công.<br>
                        Hãy đến với chúng tôi để được <strong>“thỏa mãn ước mơ du lịch - khám phá năm châu bốn biển”.</strong><br>
                        <strong>
                        Công ty Lữ hành chúng tôi</strong> - Tổng Công ty Du lịch Hà Nội rất hân hạnh được nồng nhiệt chào đón và đồng hành cùng Quý khách.</span>
                    </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="footer">
            <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>   
        </div>
        <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=vi-VN&key=AIzaSyB-NX6fMciZIPFTLgZvmQIHF2Arws4V-Lk"></script>
        <div class="modal modal-blue fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </body>
</html>
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
        <div class="slider-lg" style="background:#FFEBCD">
           <div class="slider-content"style="background:#FFEBCD">
              <div class="bg-full" style="background:url(<?= path_url() ?>/public/images/logo/li.jpg) center top">
              </div>
           </div>
        </div>
        <div class="container">
            <div class="row">
                    <div class="page-header">
                        <div class="clearfix">
                            <h2 title="" class="title-lg pull-left"style="color:blue;font-size:30px;">
                            <strong>Giới thiệu về chúng tôi</strong>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product product-tour">
                        <div class="rtejustify"><span style="font-size:18px;    "><strong> Công ty CP TM DV Du lịch TAM ( gọi tắt là TAM Travel)</strong> kính chào quý khách, cảm ơn quý khách đã quan tâm và sử dụng dịch vụ của TAM Travel trong suốt thời gian qua.<br>
                        Trải qua 4 năm hình thành và phát triển, TAM Travel tự hào đã trở thành Công ty Du lịch uy tín tại Việt Nam nhiều năm liền. Sau những biến động thăng trầm của ngành du lịch nói riêng và kinh tế Việt Nam nói chung, TAM Travel vẫn vững vàng, sẵn sàng đương đầu với thử thách và luôn cải tiến, đem đến cho quý khách hàng những dịch vụ tốt nhất với chi phí hợp lý nhất.</span><br>
                        &nbsp;
                        </div>

                        <div class="rtejustify"><span style="font-size:18px;"> Hiện nay, TAM Travel có hệ thông chi nhánh khắp toàn quốc cùng tổng số lượng gồm 200 nhân viên chính thức và 300 cộng tác viên. Qua 4 năm phục vụ, TAM Travel tự hào được nhiều khách hàng và đối tác lớn tin tưởng lựa chọn bởi đem đến <strong>những giá trị:</strong>
                        <li>Liên tục khai thác các điểm tham quan mới tạo nên sự chất lượng và hấp dẫn trên các hành trình du lịch</li> 
                        <li>Luôn luôn cập nhật và sáng tạo các trò chơi vận động mới lạ, độc đáo, hấp dẫn tạo nên sự nhiệt huyết, máu lửa và giá trị khác biệt trong từng chương trình du lịch</li> 
                        <li>Luôn cam kết tạo nên giá trị đồng hành giữa chất lượng và chi phí nhằm làm hài lòng quý khách hàng</li> 
                        <li>Sự chọn lọc kỹ càng và không ngừng nâng cao chất lượng dịch vụ phương tiện vận chuyển, nơi lưu trú và dịch vụ ăn uống, … để quý khách luôn được an tâm, thoải mái nhất trên mỗi hành trình</li> 
                        <li>Dịch vụ chăm sóc khách hàng chu đáo: Tư vấn miễn phí; Hỗ trợ 24/24; Đa phương thức tiếp cận</li></span>
                        &nbsp;
                        </div>
                        <div class="rtejustify"><span style="font-size:18px;    "><strong> Sẵn sàng đương đầu với thách thức, thay đổi để bắt kịp xu hướng</strong> <br>
                        Năm 2020 - 2021 là một năm đầy thách thức đối với ngành du lịch nói riêng và kinh tế toàn cầu nói chung do sự ảnh hưởng của đại dịch Covid-19. Trong bối cảnh khó khăn chung do dịch bệnh, Ban lãnh đạo TAM Travel đã có sự điều chỉnh về nhân sự và thay đổi định hướng kinh doanh nhằm phù hợp với xu hướng du lịch mới.<br>
                        </span>
                        &nbsp;
                        </div>
                        <div class="rtejustify"><span style="font-size:18px;    "><strong> Khát vọng vươn ra thế giới</strong> <br>
                        Trong suốt 4 năm hoạt động, tập thể công ty TAM Travel luôn không ngừng nỗ lực sáng tạo và đổi mới, nhằm tạo nên những sản phẩm, dịch vụ có chất lượng và giá thành tốt nhất gửi đến quý khách hàng. Trong tương lai, TAM Travel mong rằng tiếp tục nhận được nhiều hơn nữa sự tin yêu của quý khách hàng, đối tác. Đặc biệt, đưa được thương hiệu TAM Travel lên vị trí số 1 ở thị trường du lịch trong nước và vươn mạnh mẽ ra thị trường quốc tế.<br>
                        </span>
                        &nbsp;
                        </div>
                    </div>
            </div>
        </div>
        <div class="footer">
            <?php include_once  __DIR__. '/layouts/inc_footer.php' ?>   
        </div>
    </body>
</html>
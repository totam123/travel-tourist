<?php
$locations_footer  = DB::query('locations','*',' and loc_hot = 1 ');
?>
<div class="bottom-footer" style="background:#FFEBCD">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a class="logo" href="#">
                    <img class="img-responsive" src="<?= path_url() ?>/public/images/logo/logo.jpg" alt="mytour.vn" title="mytour.vn" style="width: 100px;height: 50px" />
                </a>
            </div>
            <div class="col-sm-4">
                <h5 class="footer-title">
                    Công ty TNHH TRAVEL Tâm Việt Nam
                </h5>
                <div class="contact-mytour">
                    <ul class="list-unstyled mg-bt-30">
                        <li>Bình Dương: 0564841529 </li>
                        <li>Hà Nội: 0913767674 </li>
                        <li>Email: totam9991@gmail.com</li>
                        <li>Văn phòng Bình Dương: Bến Cát, Bình Dương</li>
                        <li>Văn phòng Hà Nội: Thái Bình, Hà Nội</li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="row mg-bt-20">
                    <h5 class="footer-title text-uppercase">
                        Địa điểm nổi bật
                    </h5>
                    <ul class="list-unstyled">
                        <?php foreach($locations_footer as $lf) :?>
                            <li><a href="<?php path_url() ?>/dia-diem.php?id=<?=$lf['id'] ?>"><i class="ui-checkbox"></i><?= $lf['loc_name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12">
                    <div class="socail-group">
                        <h5 class="footer-title text-uppercase mg-bt-10">
                            Kết nối với với chúng tôi qua
                        </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/totam.nguyenthi.73/" target="_blank">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://accounts.google.com/" target="_blank">
                                    <i class="fa fa-google-plus-square"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/tam.nguyenthito/" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.271408643062!2d106.59788091433893!3d11.093138456302295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174cd91a45305a5%3A0xf613832933637cae!2zxJDhuqBJIEjhu4xDIFRI4bumIEThuqZVIE3hu5hU!5e0!3m2!1svi!2s!4v1617518845340!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <div id="fb-root"></div>
                 <!-- Your Chat Plugin code -->
                <div class="fb-customerchat"
                    attribution="setup_tool"
                    page_id="112985580889905">
                </div>
             </div>
        </div>
    </div>
</div>
<script src="/public/frontend/js/main.js" type="text/javascript" /></script>
 <!-- Load Facebook SDK for JavaScript -->
<script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
</script>
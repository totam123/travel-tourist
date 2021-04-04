<div class="navbar">
    <div class="container">
        <div class="row">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-collapse" aria-expanded="false">
                <img src="<?= path_url() ?>/public/images/logo/logo.jpg" alt="" class="img-responsive">
                <i class="li-chevron-up"></i>
            </button>
            <div class="logo">
                <a href="/"><img src="<?= path_url() ?>/public/images/logo/logo.jpg" alt="" style="height: 50px;" class="img-responsive"></a>
            </div>
            <div class="collapse navbar-collapse" id="menu-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?= $active =="" ? 'active' : '' ?>">
                        <a class="" href="/">Trang chủ</a>
                    </li>

                    <li class="<?= $active == "abouts" ? 'active' : '' ?>">
                        <a  href="<?php echo path_url() ?>/about-us.php">Giới thiệu</a>
                    </li>
                    <li class="<?= $active == "tours" ? 'active' : ''; ?>">
                        <a  href="<?php echo path_url() ?>/list-tour.php">Tour</a>
                    </li>
                    <li class="<?= $active == "news" ? 'active' : ''; ?>">
                        <a class="" href="/tin-tuc.html?type=1">Tin tức</a>
                    </li>
                    <li class="<?= $active == "hotel" ? 'active' : ''; ?>">
                        <a class="" href="/tin-tuc.html?type=2">Khách sạn</a>
                    </li>
                    <li class="<?= $active == "restaurant" ? 'active' : ''; ?>">
                        <a class="" href="/tin-tuc.html?type=3">Nhà hàng</a>
                    </li>
                     <li class="<?= $active == "contact" ? 'active' : ''; ?>">
                        <a class="" href="<?php echo path_url() ?>/contact.php">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if( isset($_SESSION['id_user'])) :?>
                    <li class="dropdown account signed-in <?= $active == "user" ? 'active' : '' ?>">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="li-user"></i>
                        </a>
                        <ul class="dropdown-menu">

                            <li><a href="<?= path_url() ?>/boox-tour-pay.php">Quản lý đặt Tour</a></li>
                            <li><a href="<?= path_url() ?>/list-order.php">Danh sách Tour đã đặt</a></li>
                            <li><a href="<?= path_url() ?>/profile.php">Cập nhật thông tin</a></li>
                            <li><a href="/logout.php">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php else :?>
                    <li class="dropdown account  <?= $active == "user" ? 'active' : '' ?>">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="li-user mg-r-10"></i>Tài khoản <i class="li-chevron-down mg-l-10"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= path_url() ?>/boox-tour-pay.php">Quản lý Tour</a></li>
                            <li class="p_login " data-page="home"><a href="/login.php">Đăng nhập</a>
                            </li>
                            <li class="p_login" data-page="home"><a href="/sign-up.php">Đăng ký</a></li>
                        </ul>
                    </li>
                <?php endif ;?>
            </ul>
        </div>
    </div>
</div>
<?php if(isset($_SESSION['success'])) :?>
    <script>
        alert('<?php echo $_SESSION['success']; ?>');
    </script>
     <?php  unset($_SESSION['success']) ?>
<?php  endif ;?>

<?php if(isset($_SESSION['danger'])) :?>
    <script>
        alert('<?php echo $_SESSION['danger']; ?>');
    </script>
    <?php unset($_SESSION['danger']) ?></p>
<?php  endif ;?>
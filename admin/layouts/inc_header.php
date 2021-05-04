<header class="main-header">
	<a href="<?= path_url() ?>" target="_blank" class="logo">
    	<span class="logo-mini"></span>
        <span class="logo-lg"></span>
    </a>
    <nav class="navbar navbar-static-top">
    	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	<span class="sr-only"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/public/admin/images/logo.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?= $_SESSION['admin_name'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= path_url() ?>/admin/modules/admins/profile.php" class="btn btn-success btn-flat"> Cập nhật</a>
                            </div>
                         	<div class="pull-right">
                                <a href="<?= path_url() ?>/authenticate/thoat.php" class="btn btn-danger btn-flat"> Thoát hệ thống</a>
                            </div>
                        </li>
                    </ul>
                </li>
             </ul>
        </div>
    </nav>
</header>
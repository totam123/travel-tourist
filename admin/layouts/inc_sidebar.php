<aside class="main-sidebar">
	<section class="sidebar">
    	<div class="user-panel">
            <div class="pull-left image">
                <img src="/public/admin/images/logo.jpg" class="img-circle" alt="User Image" style="height: 45px;">
            </div>
            <div class="pull-left info">
                <p>ToTam</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Danh mục</li>
            <li class="">
                <a href="/admin"><i class="fa fa-dashboard"></i> <span>Home</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'locations' ? 'active' : ''?>">
                <a href="<?= path_url('/admin/modules/locations') ?>"><i class="fa fa-list-alt "></i> <span>Địa điểm</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'tours' ? 'active' : ''?>">
                <a href="/admin/modules/tours"><i class="fa fa-database"></i> <span>Tours</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'news' ? 'active' : ''?>">
                <a href="/admin/modules/news"><i class="fa fa-pencil"></i> <span>Bài viết</span></a>
            </li>
           
            <li class="header"> Quản lý </li>
            <li class="<?= isset($modules) && $modules == 'book-tours' ? 'active' : ''?>">
                <a href="/admin/modules/book-tours"><i class="fa fa-book"></i> <span> Quản lý đặt tours </span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'comments' ? 'active' : ''?>">
                <a href="/admin/modules/comments"><i class="fa fa-pencil"></i> <span>Quản lý comments</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'users' ? 'active' : ''?>">
                <a href="/admin/modules/users"><i class="fa fa-user-plus"></i> <span> Quản lý Khách Hàng </span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'contacts' ? 'active' : ''?>">
                <a href="/admin/modules/contact"><i class="fa fa-pencil"></i> <span>Quản lý liên hệ</span></a>
            </li>
            <li class="<?= isset($modules) && $modules == 'admins' ? 'active' : ''?>">
                <a href="/admin/modules/admins"><i class="fa fa-users"></i> <span> Quản lý Admin </span></a>
            </li>
        </ul>
    </section>
</aside>
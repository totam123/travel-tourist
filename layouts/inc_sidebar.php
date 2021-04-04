<?php
    $locations  = DB::query('locations','*',' and loc_hot = 1 ');
    $sql_sale = "SELECT  t_name, t_sale,t_price,t_images,id FROM tours 
        WHERE 1 and t_status = 1 and  t_sale > 0 LIMIT 5";
    $tour_sale = DB::fetchsql($sql_sale);
?>
<div class="col-md-3  sidebar">
    <div class="box box-toggle filter_tg_tl">
        <div class="box-header" js-t="js-toggle" style="background:#FFD700">
            <h3 class="box-title">
                Bộ lọc tìm kiếm
            </h3>
        </div>
        <div class="box-body">
            <div class="toggle-title" js-t="js-toggle" style="background:#FFD700">
                Theo mức giá
            </div>
            <div class="toggle-body">
                <ul class="nav nav-check-list">
                    <?php foreach($arrayPrice as $key => $ap)  :?>
                        <li class="fprice filter_js " data-value="1">
                            <a href="<?= \vendor\Utils\Url::addParams(['price' => $key]) ?>"><i class="ui-checkbox"></i> <?= $ap[0]. ' - ' . $ap[1] ?></a>
                        </li>
                    <?php endforeach ;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="box box-toggle filter_tg_tl">
        <div class="box-header" js-t="js-toggle"style="background:#FFD700">
            <h3 class="box-title">
                Điểm đến phổ biến
            </h3>
        </div>
        <div class="box-body">
            <div class="toggle-body">
                <ul class="nav nav-check-list">
                    <?php foreach ($locations as $loc): ?>
                        <li class="">
                        <a href="/dia-diem.php?id=<?= $loc['id'] ?>"><i class="ui-checkbox"></i><?= $loc['loc_name'] ?></a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="box box-toggle filter_tg_tl">
        <div class="box-header" js-t="js-toggle"style="background:#FFD700">
            <h3 class="box-title">
                Số ngày
            </h3>
        </div>
        <div class="box-body">
            <div class="toggle-body">
                <ul class="nav nav-check-list">

                    <?php for($i = 1 ; $i <= 5 ; $i ++) :?>
                        <li class="">
                            <a href="<?= \vendor\Utils\Url::addParams(['time' => $i]) ?>"><i class="ui-checkbox"></i><?= $i ?> ngày </a>
                        </li>
                    <?php endfor ;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="box device-pc-show tour_promo">
        <div class="box-header" style="background:#FFD700">
            <h3 class="box-title">
                Tour có khuyến mãi
            </h3>
        </div>
        <div class="box-body">
            <ul class="nav-thumbnails nav-thumbnails-list nav-thumbnails-list-no-pd" style=" height: 325px;">
                <?php foreach ($tour_sale as $key => $ts): ?>
                    <li class="col-xs-12">
                        <div class="item-thumbnail">
                            <a class="item-name" href="tour-detail.php?id=<?= $ts['id'] ?>"><?= $ts['t_name'] ?></a>
                            <a href="tour-detail.php?id=<?= $ts['id'] ?>">
                            <img class="img-responsive" src="<?= path_url() ?>/uploads/tours/<?= $ts['t_images'] ?>" data-src="<?= path_url() ?>/uploads/tours/<?= $ts['t_images'] ?>" onerror="this.onerror=null;this.src='<?php echo path_url() ?>';">
                            </a>
                            <div class="red">
                                    Sale <?= $ts['t_sale'] ?>%
                            </div>
                            <div class="item-thumbnail-content" style="margin-top:-1rem;">
                                <div class="item-price">
                                    <span class="text-xs">Giá từ:</span> <strong class="price"><?= formatPrice($ts['t_price']) ?> <small>đ</small></strong>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>
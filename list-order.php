<?php
    require_once __DIR__. '/autoload.php';
    $active = '';
    if (!isset($_SESSION['id_user']))
    {
        header("Location: ".redirectUrl());exit();
    }

    $userLogin = DB::fetchOne('users' ,' id = '.$_SESSION['id_user']);


    $sql = "SELECT book_tours.* ,tours.t_name FROM book_tours 
        LEFT JOIN tours ON book_tours.b_tour_id = tours.id WHERE 1 AND b_user_id = ".$_SESSION['id_user'];

    $tour = DB::fetchsql($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt phòng khách sạn, hotel trực tuyến hàng đầu Việt Nam</title>
    <meta name="description" content="Hơn 5000 khách sạn, hotels trong và ngoài nước. Giá rẻ nhất và đánh giá thực chỉ có tại Mytour.vn. Khuyến mãi giảm giá lên đến 70%. Hoàn Tiền Nếu Không Hài Lòng.">
    <link rel="canonical" href="/" />
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
    <!-- mytour:css -->
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>
<div class="container booking">
    <form id="booking-form" method="POST" action="">
        <input type="hidden" name="_token" value="y4nM38o9kjAqBv5ywCIgUmeQqqkOyQl2oP6rq7XI">
        <div class="row">
            <!-- booking -->
            <div class="booking-info text-header-margin">
                <div class="col-sm-12">

                    <h2>Danh sách tour đã đặt của bạn</h2>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Tour</th>
                            <th>Số người</th>
                            <th>Giá</th>
                            <th>Thành tiền </th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($tour as $t) :?>
                        <tr>
                            <td>[<?= $t['id'] ?>]</td>
                            <td><a target="_blank" href="tour-detail.php?id=<?= $t['id'] ?>"><?= $t['t_name'] ?></a></td>
                            <td><?= $t['b_number_guests'] ?></td>
                            <td><?= number_format($t['b_price'],0,',','.') ?> VNĐ</td>
                            <td><?= number_format($t['b_total'],0,',','.') ?> VNĐ</td>
                            <td><a class="label <?= $t['b_status'] == 1  ? 'label-success' : 'label-default' ?>" href="javascript:;void(0)"> <?= $t['b_status'] == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' ?> </a></td>
                            <td>
                                <?php if($t['b_status'] == 0) :?>
                                <a href="delete_tour_item.php?id=<?= $t['id'] ?>" class="label label-danger">Huỷ tour</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.booking -->
        </div>

    </form>
</div>


<!-- menu-footer -->
<?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
<!-- /menu-footer -->
<!-- mytour:js -->
</body>

<div class="modal modal-blue fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- /modal XemBanDo -->
</html>
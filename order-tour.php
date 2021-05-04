<?php
require_once __DIR__. '/autoload.php';
    $active = 'tours';
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['danger'] = 'Không tồn tại tour nào '; 
        header("Location: ".redirectUrl());exit();
    }


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     *  lay giá trị từ input
     */
    $qty = Input::get("qty");

    if ($qty)
    {
        $_SESSION['cart']['number'] = $qty;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin tour đã đặt</title>
    <link rel="icon" type="image/jpg" href="/public/frontend/images/logo.jpg"/>
    <link rel="canonical" href="/" />
    <link href="/public/frontend/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-home">
<?php include_once  __DIR__. '/layouts/inc_nav.php' ?>


<div class="container profile-page sign-up">
    <div class="row">
        <div class="col-md-10 col-sm-offset-1 mg-t-40 mg-bt-40">
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Tour</th>
                            <th>Số Người</th>
                            <th>Số Tiền</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action="" method="POST">
                            <tr>
                                <td><?= $_SESSION['cart']['id'] ?></td>
                                <td><?= $_SESSION['cart']['name'] ?></td>
                                <td><input type="number" min="1" value="<?= $_SESSION['cart']['number'] ?>" name="qty"></td>
                                <td><?= formatPrice($_SESSION['cart']['price']) ?>đ</td>
                                <td><?= formatPrice($_SESSION['cart']['price'] * $_SESSION['cart']['number']) ?>đ</td>
                                <td>
                                    <a href="/boox-tour-delete.php?id=<?= $_SESSION['cart']['id'] ?>">Huỷ</a>
                                    <button type="submit" class="btn">Cập nhật</button>
                                </td>
                            </tr>

                    </form>

                    </tbody>
                </table>

            </div>
            <a href="/boox-tour-pay.php" class="btn pull-right">Tiến hành thanh xác nhận</a>
        </div>

    </div>
</div>

<?php include_once  __DIR__. '/layouts/inc_footer.php' ?>
</body>

<div class="modal modal-blue fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
</html>
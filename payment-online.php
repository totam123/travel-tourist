<?php
    require_once __DIR__ .'/autoload.php';
    if(isset($_POST['email']) && isset($_POST['name'])){
        $_SESSION['user_name'] = $_POST['name'];
        $_SESSION['user_email'] = $_POST['email'];
    }
    if (!empty($_POST["token"])) {
        require_once 'libs/StripePayment.php';
        $stripePayment = new libs\StripePayment;

        $stripeResponse = $stripePayment->chargeAmountFromCard($_POST,$_SESSION['user_email']);

        $amount = $stripeResponse["amount"];
        if(isset($_SESSION['user_email'])){
            $param_value_array = array(
                'email' => $_SESSION['user_email'],
                'amount' => $amount,
                'currency_code' => $stripeResponse["currency"],
                'txn_id' => $stripeResponse["balance_transaction"],
                'payment_status' => $stripeResponse["status"],
                'payment_response' => json_encode($stripeResponse)
            );
        }else{
            $param_value_array = array(
                'email' => $_POST['user_email'],
                'amount' => $amount,
                'currency_code' => $stripeResponse["currency"],
                'txn_id' => $stripeResponse["balance_transaction"],
                'payment_status' => $stripeResponse["status"],
                'payment_response' => json_encode($stripeResponse)
            );
        }

        DB::insert('payment', $param_value_array);
        if(isset($_POST['b_user_id'])){
            $data_book_tour = [
                'b_tour_id'       => $_POST['b_tour_id'],
                'b_user_id'       => $_POST['b_user_id'],
                'b_number_guests' => $_POST['b_number_guests'],
                'b_price'         => $_POST['b_price'],
                'b_total'         => $_POST['amount'], 
                'b_status'        => 1                
            ];
            $book_check = DB::insert('book_tours',$data_book_tour);
        }else{
            $data_user = [
                'u_name' => $_POST['user_name'],
                'u_email' => $_POST['user_email'],
                'u_phone' => $_POST['phone'],
                'u_address' => $_POST['address'],
                'u_password' => md5(12345678)
            ];
            DB::insert('users', $data_user);
            $res = DB::query('users','*',' AND u_email="'.$_POST['user_email'].'"');
            $data_book_tour = [
                'b_tour_id'       => $_POST['b_tour_id'],
                'b_user_id'       => $res[0]["id"],
                'b_number_guests' => $_POST['b_number_guests'],
                'b_price'         => $_POST['b_price'],
                'b_total'         => $_POST['amount'],
                'b_status'        => 1                    
            ];
            $book_check = DB::insert('book_tours',$data_book_tour);
        }
        
        if ($book_check && !empty($_POST['user_email']))
        {
            unset($_SESSION['cart']);
            echo "<script>
            alert('Thanh to??n th??nh c??ng !Qu?? kh??ch ???? tr??? th??nh kh??ch h??ng th??nh vi??n c???a ch??ng t??i. ????? xem chi ti???t ????n h??ng qu?? kh??ch vui l??ng ????ng nh???p email c???a qu?? kh??ch v?? m???t kh???u m???c ?????nh l?? 12345678. Ch??c qu?? kh??ch 1 ng??y t???t l??nh.');
            window.location.href = '/';
            </script>";
        }elseif($book_check && !empty($_SESSION['user_email']))
        {
            unset($_SESSION['cart']);
            echo "<script>
            alert('Thanh to??n th??nh c??ng !Ch??c qu?? kh??ch 1 ng??y t???t l??nh.');
            window.location.href = '/';
            </script>";
        }
        else
        {
            echo "<script>
            alert('X??? l?? th???t b???i, m???i qu?? kh??ch ?????t l???i.');
            window.location.href = '/';
            </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh to??n ??i???n t???</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>THANH TO??N ??I???N T???</h2>
    <div id="error-message"></div>
    <form id="frmStripePayment" action="" method="POST">
        <?php if(isset($_POST['name']) && isset($_POST['email'])): ?>
            <div class="form-group">
                <label for="user_name">T??n s??? h???u</label> <span id="card-holder-name-info" class="info"></span>
                <input type="text" id="user_name" name="user_name" class="form-control" value="<?= $_POST['name'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label> <span id="email-info" class="info"></span>
                <input type="user_email" id="user_email" name="user_email" class="form-control" value="<?= $_POST['email'] ?>" disabled>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="user_name">T??n s??? h???u</label> <span id="card-holder-name-info" class="info"></span>
                <input type="text" id="user_name" name="user_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_email">Email</label> <span id="email-info" class="info"></span>
                <input type="user_email" id="user_email" name="user_email" class="form-control">
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="phone">S??? ??i???n tho???i</label>
            <input type="tel" id="phone" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">?????a ch???</label>
            <input type="text" id="address" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="card-number">S??? t??i kho???n</label> <span id="card-number-info" class="info"></span>
            <input type="text" id="card-number" name="card-number" class="form-control">
        </div>
        <div class="form-group">
            <label>H???n m???c (Th??ng / N??m)</label> <span id="userEmail-info" class="info"></span>
            <div class="row">
                <div class="col">
                    <select name="month" id="month" class="form-control">
                        <?php for($i = 1;$i<=12;$i++): ?>
                            <option value="<?= $i ?>">Th??ng <?= $i ?></option>
                        <?php endfor; ?>
                    </select> 
                </div>
                <div class="col">
                    <select name="year" id="year" class="form-control">
                        <?php for($i = 2021;$i<=2030;$i++): ?>
                            <option value="<?= $i ?>">N??m <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="cvc">CVC</label> <span id="cvv-info" class="info"></span>
            <input type="text" name="cvc" id="cvc" class="form-control">
        </div>
        <div>
            <input type="submit" name="pay_now" value="Thanh to??n" id="submit-btn" class="btn btn-primary" onClick="stripePay(event);">
        </div>
        <input type='hidden' name='currency_code' value='VND'>
        <input type="hidden" name="amount" value="<?= $_POST['amount'] ?>">
        <input type="hidden" name="b_tour_id" value="<?= $_POST['b_tour_id'] ?>">
        <input type="hidden" name="b_number_guests" value="<?= $_POST['b_number_guests'] ?>">
        <input type="hidden" name="b_price" value="<?= $_POST['b_price'] ?>">
        <?php if(isset($_POST['b_user_id'])): ?>
            <input type="hidden" name="b_user_id" value="<?= $_POST['b_user_id'] ?>" />
        <?php endif; ?>
    </form>
</div>
<!-- Handle payment -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="/public/js/payment.js"></script>
</body>
</html>
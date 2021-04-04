<?php
    require_once __DIR__. '/autoload.php';
    $id = Input::get('id');

    DB::delete('book_tours',' id = '.$id . ' and b_status = 0');

    $_SESSION['success'] = 'Huỷ tour thành công ';
    header("Location: ".redirectUrl('/list-order.php'));exit();
?>

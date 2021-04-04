<?php
    // bien module de active cai menu

    require_once __DIR__ .'/../../autoload.php';
    $id = Input::get('id');

    $tour = DB::fetchOne('book_tours',' id = '.$id);

    $status = $tour['b_status'] == 1 ? 0 : 1;
    \DB::update('book_tours',array('b_status' => $status),array('id' => $id));

    $_SESSION['success'] = "Cập nhật thành công ";

    header("Location: ".path_url().'/admin/modules/book-tours');exit();

?>
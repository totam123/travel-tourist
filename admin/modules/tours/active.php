<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    $editTours = DB::fetchOne('tours',' id = '.$id);

    if ( empty($editTours))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".path_url().'/admin/modules/tours');exit();
    }
    $active = $editTours['t_status'] == 1 ? 0 : 1;
    $update = DB::update("tours",array('t_status' => $active) ,array("id" => $id));
    $update && $update > 0 ? $_SESSION['success'] = ' Cập nhật thành công  ' : $_SESSION['error'] = ' Cập nhật thất bại  ';
    header("Location: ".path_url().'/admin/modules/tours');exit();
?>
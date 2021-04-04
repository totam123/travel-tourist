<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    $EditLocation = DB::fetchOne('locations',' id = '.$id);
    if ( empty($EditLocation))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".path_url().'/admin/modules/locations');exit();
    }
    $active = $EditLocation['loc_status'] == 1 ? 0 : 1;
    $update = DB::update("locations",array('loc_status' => $active) ,array("id" => $id));
    $update && $update > 0 ? $_SESSION['success'] = ' Cập nhật thành công  ' : $_SESSION['error'] = ' Cập nhật thất bại  ';
    header("Location: ".path_url().'/admin/modules/locations');exit();
?>
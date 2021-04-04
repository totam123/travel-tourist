<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    $EditLocations = DB::fetchOne('locations',' id = '.$id);
    if ( empty($EditLocations))
    {
        $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
        header("Location: ".path_url().'/admin/modules/locations');exit();
    }
    $active = $EditCategory['loc_hot'] == 1 ? 0 : 1;
    $update = DB::update("locations",array('loc_hot' => $active) ,array("id" => $id));
    $update && $update > 0 ? $_SESSION['success'] = ' Cập nhật thành công  ' : $_SESSION['error'] = ' Cập nhật thất bại  ';
    header("Location: ".path_url().'/admin/modules/locations');exit();
?>
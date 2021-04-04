<?php
require_once __DIR__ .'/../../autoload.php';
$id = (int)Input::get('id');
try{
    $iddelete = DB::delete('admins',' id = '.$id);
    ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' Xoá Thất Bại  ';
    header("Location: ".path_url().'/admin/modules/admins');exit();
}catch (\Exception $e)
{
    dd(" Lỗi Xoá Danh Mục  " . $e->getMessage());
}
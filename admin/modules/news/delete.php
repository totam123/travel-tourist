<?php
require_once __DIR__ .'/../../autoload.php';
$id = (int)Input::get('id');
try{
    $iddelete = DB::delete('news',' id = '.$id);
    ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' XoáBài Viết Thất Bại  ';
    header("Location: ".path_url().'/admin/modules/news');exit();
}catch (\Exception $e)
{
    dd(" Lỗi Xoá Bài Viết  " . $e->getMessage());
}
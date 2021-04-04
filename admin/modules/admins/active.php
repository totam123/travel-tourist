<?php
@ob_start();
require_once __DIR__ .'/../../autoload.php';
//lấy id url
$id = (int)Input::get('id');
//lấy id cần sửa xem có tồn tại không
$admin = DB::fetchOne('admins',' id = '.$id);
if ( empty($admin))
{
    $_SESSION['error'] = '  Không có dữ liệu trong DB   ';
    header("Location: ".path_url().'/admin/modules/admins');exit();
}

if( $_SESSION['admin_level'] <= $admin['level'])
{
    $_SESSION['error'] = ' Bạn không có quyền chỉnh sửa thông tin của người có cùng cấp độ hoạc lớn hơn cấp độ của bạn ';
    header("Location: ".base_url().'/admin/modules/admins');exit();
}

$active = $admin['status'] == 1 ? 0 : 1;
$update = DB::update("admins",array('status' => $active) ,array("id" => $id));

$update && $update > 0 ? $_SESSION['success'] = ' Cập nhật thành công  ' : $_SESSION['error'] = ' Cập nhật thất bại  ';

header("Location: ".path_url().'/admin/modules/admins');exit();
?>

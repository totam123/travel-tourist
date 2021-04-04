<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    try{
        $iddelete = DB::delete('users',$id);
        if($iddelete)
        {
            $_SESSION['success'] = ' Xoá Thành Công ';
            header("Location: ".path_url().'/admin/modules/users');exit();
        }
    }catch (\Exception $e)
    {
        dd(" Lỗi Xoá Thành Viên " . $e->getMessage());
    }
?>
<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    try{
        $iddelete = DB::delete('book_tours','id= '.$id);
        ( $iddelete ) ? $_SESSION['success'] = ' Xoá Thành Công ' : $_SESSION['error'] = ' Xoá Thất Bại  ';
        // xoa tiep o chi tiet don hang
        header("Location: ".path_url().'/admin/modules/book-tours');exit();
    }catch (\Exception $e)
    {
        dd(" Xoá đơn hàng thất bại  " . $e->getMessage());
    }
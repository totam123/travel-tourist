<?php
    require_once __DIR__ .'/../../autoload.php';
    $id = (int)Input::get('id');
    try{
        $order = DB::fetchOne('tbl_chitietdonhang','id_chitietdonhang = '.$id);
        
        $transaction = DB::fetchOne('tbl_donhang',' id_donhang = '. (int)$order['donhang_id']);

        $tongtien = $transaction['tongtien'] - $order['giasanpham']*$order['soluong'];

    
        $update_transaction = DB::update('tbl_donhang', array('tongtien' => $tongtien), array('id_donhang = '.(int)$order['donhang_id']));

        $iddelete = DB::delete('tbl_chitietdonhang','id_chitietdonhang = '.$id);

        header("Location: ".baseServerName().'/admin/modules/transactions');exit();
    }catch (\Exception $e)
    {
        dd(" Xoá đơn hàng thất bại  " . $e->getMessage());
    }
?>
<?php
    require_once __DIR__. '/autoload.php';
    if (!isset($_SESSION['url_redirect']))
    {
        $_SESSION['url_redirect'] = $_SERVER["HTTP_REFERER"];
    }
    if( isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if( isset($_GET['guests']))
    {
        $guests = $_GET['guests'];
    }
    $tour = DB::fetchOne("tours",(int)$id);

    if( $tour['t_number_guests'] < 1 )
    {
        $url = $_SESSION['url_redirect'];
        unset($_SESSION['url_redirect']) ;

        header("Location: ".redirectUrl().$url);exit();
        
    }else
    {
        if( !isset($_SESSION['cart']))
        {
            $_SESSION['cart']['qty']     = 1;
            $_SESSION['cart']['id']      = $id;
            $_SESSION['cart']['number']  = $guests;
            $_SESSION['cart']['name']    = $tour['t_name'];
            $_SESSION['cart']['img']     = $tour['t_images'];
            $_SESSION['cart']['price']   = money($tour['t_price'],$tour['t_sale']);
        }
        else
        {
            $url = $_SESSION['url_redirect'];
            unset($_SESSION['url_redirect']) ;
            $_SESSION['success'] = ' Bạn phải huỷ hoạc xác nhận trước khi đặt tour mới ';
            header("Location: ".redirectUrl().$url);exit();
        }
    }
    $url = $_SESSION['url_redirect'];
    unset($_SESSION['url_redirect']) ;
    $_SESSION['success'] = ' Đặt tour thành công ';
    header("Location: ".redirectUrl('/boox-tour-pay.php').$url);exit();
	
?>
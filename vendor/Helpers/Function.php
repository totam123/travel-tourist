<!==
Author:Nguyễn Thị Tố Tâm
Website:http://websitedulich.abc/
=>
<?php 
if ( ! function_exists( 'dd' ))
{
    /**
     * @param $data
     */
    function dd( $data ) {
        echo '<pre class="sf-dump" style=" color: #222; overflow: auto;">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);
        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';
        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            print_r($data); die;
        }
        echo '</pre>';
    }
}

if( ! function_exists('str_slug'))
{
    // convert duong dan than thien
    function str_slug($str,$default = '-') {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/',$default, $str);
        return $str;
    }
}

if ( ! function_exists('formatPrice'))
{
    // dinh dang lai gia tien
    function formatPrice($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return number_format($price, 0,',','.') ;
    }

}
if ( ! function_exists('money'))
{
    // dinh dang lai gia tien
    function money($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return $price;
    }
}

if( ! function_exists( 'path_url'))
{
    // duong dan url ban dau
    function path_url($url='')
    {
        return 'http://'.$_SERVER["SERVER_NAME"] .$url;
    }
}

if ( ! function_exists('redirectUrl'))
{
    function redirectUrl($url = '')
    {
        header("location: ".path_url()."{$url}");exit();
    }
}

if ( ! function_exists( 'curPageURL' ))
{
    /**
     * @return string
     * lay duong dan url hien tai
     * VD
     */
    function curPageURL() {
        $pageURL = "http";
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

function ColorFind($string,$fild)
{
    if($string != '')
    {
        return str_replace($string,"<span style='color:red;font-size:14px'>".$string."</span>",$fild);
    }
    else
    {
        return $fild;
    }
}
if ( ! function_exists( 'createFolder' ))
{
	/**
	 *  Ham tao  thuc muc 
	 * return 0  => errors
	 * return 1  => success
	 *  tao moi thu muc
	**/
	function createFolder($path , $name)
	{
		$respons = 
		[
			'code' => 0,
			'message' => ' Thư mục '.$name.' đã tồn tại ' 
		];
		if(is_dir($path . $name))
		{
			return $respons;
		}
		$check_create = mkdir( $path . $name, 0777); 
		if($check_create)
		{
			$respons['message']  =  ' Tạo thư mục thành công ';
			$respons['code']  =  1;
			return $respons;
		}
		$respons['message']  = ' Lỗi tạo thư mục';
		return $respons;
	}
}

if( ! function_exists( '' ))
{
	/**
	 *  xoa thu muc va file tong thu muc do 
	 */
	function deleteFolder($dir = null) {
	  	if (is_dir($dir)) {
	    	$objects = scandir($dir);
		    foreach ($objects as $object) {
		      	if ($object != "." && $object != "..")
		      	{
		        	if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
	        		else unlink($dir."/".$object);
		      	}
		    }
		    reset($objects);
		    rmdir($dir);
	  	}
	}
}

if (!function_exists('get_start_and_time'))
{
    function get_start_and_time($date_range, $config=[])
    {
        $dates = explode(' - ', $date_range);

        $start_date = date('Y-m-d', strtotime($dates[0]));
        $end_date = date('Y-m-d', strtotime($dates[1]));

        return [
            'start' => $start_date,
            'end' => $end_date
        ];
    }
}

if (!function_exists('upload_image'))
{
    /**
     * @param $file [tên file trùng tên input]
     * @param array $extend [ định dạng file có thể upload được]
     * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
     */
    function upload_image($file ,array $extend  = array() )
    {
        $code = 1;
        $result = [
            'error' => 0
        ];

        // thong tin file

        $info = [
            'name'  => $_FILES[$file]['name'],
            'tmp'   => $_FILES[$file]['tmp_name'],
            'type'  => $_FILES[$file]['type'],
            'error' => $_FILES[$file]['error']
        ];

        // file loi
        if ($info['error'] != 0 )
        {
            return $result;
        }

        // kiem tra dinh dang file
        if ( ! $extend )
        {
            $extend = ['png','jpg','jpeg'];
        }

        // lay dinh dang duoi anh dc upload vao
        $ext =  str_replace('image/','',$info['type']);

        // neu ko phai dinh dang anh
        if ($ext && !in_array($ext,$extend))
        {
            return $result;
        }

        $filename = date('Y-m-d__').str_slug(str_replace($ext,'',$info['name'])) . '.' . $ext;
        
        // thu muc goc de upload
        $path = UPLOADS;
        // di chuyen file
        move_uploaded_file($info['tmp'], $path. $filename);

        $data = [
            'name'              => $filename,
            'code'              => $code,
        ];
        return $data;
    }
}

if ( ! function_exists('format_price'))
{
    // dinh dang lai gia tien
    function format_price($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return number_format($price, 0,',','.') ;
    }

}
if ( ! function_exists('the_excerpt'))
{
    function the_excerpt($text ,$num){
       
        if(strlen($text)> $num){

            $cutstring = substr($text,0,$num);
            $word = substr($text,0,strrpos($cutstring,' '));
            return $word .'...';

        }
        else{
            return $text;
        }

    }
}

function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    $str = '';
    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[ rand( 0, $size - 1 ) ];
    }

    return $str;
}

function sendMail($title, $content, $nTo, $mTo,$diachicc='')
{
    $nFrom = 'Nguyễn Thị Tố Tâm';//mail duoc gui tu dau, thuong de ten cong ty ban
    $mFrom = 'totam9991@gmail.com';  //dia chi email cua ban 
    $mPass = '0564841529';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP(); 
    $mail->CharSet   = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";        
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $diachicc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('', '');
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}
     
function sendMailAttachment($title, $content, $nTo, $mTo,$diachicc='',$file,$filename)
{
    $nFrom = 'lilama.com';
    $mFrom = 'totam9991@gmail.com';  //dia chi email cua ban 
    $mPass = '0564841529';       //mat khau email cua ban
    $mail             = new PHPMailer();
    $body             = $content;
    $mail->IsSMTP(); 
    $mail->CharSet   = "utf-8";
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                    // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";        
    $mail->Port       = 465;
    $mail->Username   = $mFrom;  // GMAIL username
    $mail->Password   = $mPass;               // GMAIL password
    $mail->SetFrom($mFrom, $nFrom);
    //chuyen chuoi thanh mang
    $ccmail = explode(',', $diachicc);
    $ccmail = array_filter($ccmail);
    if(!empty($ccmail)){
        foreach ($ccmail as $k => $v) {
            $mail->AddCC($v);
        }
    }
    $mail->Subject    = $title;
    $mail->MsgHTML($body);
    $address = $mTo;
    $mail->AddAddress($address, $nTo);
    $mail->AddReplyTo('info@freetuts.net', 'Freetuts.net');
    $mail->AddAttachment($file,$filename);
    if(!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}


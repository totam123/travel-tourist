<?php
    require_once __DIR__.'/../../config.php';
    class Connect
    {
        protected $link;
        public function __construct()
        {
            $this->link = mysqli_connect(LOCALHOST,USER,PASS,DATABASE) or die ( ' Lỗi kết nối cơ sở dữ liệu  ' );
            // gan kieu du lieu
            mysqli_set_charset($this->link,"utf8");
        }
		
    }
?>
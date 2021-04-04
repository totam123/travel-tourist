<?php
require_once __DIR__."/Connect.php";
class Pagination extends Connect
{
    private $total; // tong so ban ghi
    private $sql ; // cau lenh sql
    private $table ; // ten table
    private static $totalPage ; // tong so trang
    private static $totalSql ; // set lai gia tri tong so ban ghi cua query chua phan trang
	public function __construct() 
    {
        parent::__construct();
    }

    public static function pagination($table , $sql = '' , $start , $stop)
    {
        $that = new self();
        $that->sql      = $sql ;
        $that->table    = $table ;
		// so trang
        $totalPage = ceil($that->totalPageRecou()/$stop);
        $that->setTotalSql($that->totalPageRecou());
		// gan  tong so trang
        $that->setTotalPage($totalPage);
		// vi tri lay
        $start = ($that->getPage($start) - 1) * $stop;
		//  neu ko ton tai $sql
        if ($sql == '')
        {
            $sql = " SELECT * FROM {$table} LIMIT $start , $stop ";

            $result = mysqli_query($that->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($that->link));
        }
        else
        {
            $sql .= " LIMIT $start , $stop ";
            $result = mysqli_query($that->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($that->link));
        }
        $data = [];
        if( $result)
        {
            while ($num = mysqli_fetch_assoc($result))
            {
                $data[] = $num;
            }
        }
        $that->total = count($data);
        return $data;
    }
	//  tính tổng số mục của sql truyền vào
    public function totalPageRecou()
    {
        $query = $this->sql;
        $tables = $this->table ;
		if ($query == '')
        {

            $sql = "SELECT count(id) as total FROM {$tables}";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $row = mysqli_fetch_assoc($result);
            $this->total = $row['total'];
        }
        else
        {
            $result = mysqli_query($this->link,$query) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
			if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }

            $this->total = count($data);
        }
        return $this->total ;
    }

    public function setTotalSql($totalPage)
    {
        Pagination::$totalSql = $totalPage;
    }
    public static function getTotalQuery()
    {
        return self::$totalSql;
    }
	public function getPage($page)
    {
        $page = isset($_GET[$page]) ? $_GET[$page] : 1;
        return $page ;
    }
    public function setTotalPage($totalPage)
    {
        Pagination::$totalPage = $totalPage;
    }
    // lay so trang
    public function getTotalPage()
    {
        return self::$totalPage;
    }
	public static function getListpage($filter = array())
    {
        $patten = '';
        if ($filter)
        {
            $patten = '?';
            foreach($filter as $key => $item)
            {
                $patten .= $key.'='.$item.'&';
            }
            $patten = substr($patten, 0, -1);
        }   

        $that = new self();
        // tổng số trang
        $totalPage = intval($that->getTotalPage());


        $html = '<ul class="pagination mg-0" style="display:flex;justify-content: center;">' ;
        if ($that->getPage('page') > 1)
        {

            $pre = intval($that->getPage('page')) - 1;
            if ( ! $patten)
            {
                $html .= '<li><a href="?page='.$pre.'">Pre</a></li>';
            }else
            {
                $html .= '<li><a href="'.$patten.'&page='.$pre.'">Pre</a></li>';
            }

        }
        
        if( $totalPage > 1 )
        {
            if( $totalPage > 10 )
            {
                $html .= "<li class=''><a disabled>[...]</a></li>";
                $start = ($that->getPage('page') - 3) > 0 ? ($that->getPage('page') - 3) : 1;
                $top   = (($that->getPage('page') + 3) > $totalPage) ? $totalPage : $that->getPage('page') + 3;
                for($i = $start ; $i <= $top  ; $i ++ )
                {
                    if ( ! $patten)
                    {
                        if($that->getPage('page') == $i)
                        {
                            $html .= "<li class='active '><a href='?page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li><a class='' href='?page=".$i."'>" . $i ."</a></li>";
                        }
                    }else 
                    {
                        if($that->getPage('page') == $i)
                        {
                            $html .= "<li class=' active'><a href='".$patten."&page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li class=''><a href='".$patten."&page=".$i."'>" . $i ."</a></li>";
                        }
                    }   
                }
                $html .= "<li class=''><a disabled>[...]</a></li>";
            }else
            {
                for($i = 1; $i <= $totalPage  ; $i ++ )
                {
                
                    if ( ! $patten)
                    {
                        if($that->getPage('page') == $i)
                        {
                            $html .= "<li class='active'><a href='?page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li><a class='' href='?page=".$i."'>" . $i ."</a></li>";
                        }
                    }else 
                    {
                        if($that->getPage('page') == $i)
                        {
                            $html .= "<li class='active'><a href='".$patten."&page=".$i."'>" . $i ."</a></li>";
                        }
                        else
                        {
                            $html .= "<li><a class='' href='".$patten."&page=".$i."'>" . $i ."</a></li>";
                        }
                    }   
                }
            }
        }
		
        
        if ($that->getPage('page') + 1 <= $totalPage)
        {
            $pre = intval($that->getPage('page')) + 1;
            if ( ! $patten)
            {
                $html .= '<li><a href="?page='.$pre.'">Next</a></li>';
            }else
            {
                $html .= '<li><a href="'.$patten.'&page='.$pre.'">Next</a></li>';
            }
            
        }
        $html .= "</ul>" ;
        return $html;
    }
}
?>
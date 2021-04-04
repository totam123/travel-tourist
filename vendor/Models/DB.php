<?php
    // v2.0
    require_once __DIR__."/Connect.php";
    class DB extends Connect
    {

        protected $link;
        public function __construct()
        {
            parent::__construct();
        }
		 public static function insert($table, array $data)
        {
            $that = new self();
			$sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            $values  = "";
            $sql .= '(' . $columns . ')';
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $values .= "'". mysqli_real_escape_string($that->link,$value) ."',";
                } else {
                    $values .= mysqli_real_escape_string($that->link,$value) . ',';
                }
            }
			$values = substr($values, 0, -1);
            $sql .= " VALUES (" . $values . ')';
			$check = mysqli_query($that->link, $sql);

            if ( ! $check )
            {
                dd(" Câu truy vấn : => " . '<b style="color:red">'.$sql.'</b>');
                dd(" Insert thất bại ! Mời bạn kiểm tra dữ liệu truyền vào " );
            }

            return mysqli_insert_id($that->link);
        }

        public static function update($table, $data, $conditions)
        {
            $that = new self();
            $sql = "UPDATE {$table}";
            $set = " SET ";
            $where = " WHERE ";

            if (is_array($data))
            {
                foreach($data as $field => $value) {
                    if(is_string($value)) {
                        $set .= $field .'='.'\''. mysqli_real_escape_string($that->link,($value)) .'\',';
                    } else {
                        $set .= $field .'='. mysqli_real_escape_string($that->link,($value)) . ',';
                    }
                }
                $set = substr($set, 0, -1);
            }
            else
            {
                $set .= $data ;
            }
			if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $where .= $field .'='.'\''. mysqli_real_escape_string($that->link,($value)) .'\' AND ';
                    } else {
                        $where .= $field .'='. mysqli_real_escape_string($that->link,($value)) . ' AND ';
                    }
                }
                $where = substr($where, 0, -5);
            }
            else
            {
                $where .= $conditions;
            }

            $sql .= $set . $where;
           
            $check = mysqli_query($that->link, $sql);
        
            if ( ! $check)
            {
                dd(" Câu truy vấn : => " . '<b style="color:red">'.$sql.'</b>');
                dd(" Update thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            else
            {
                return mysqli_affected_rows($that->link);
            }

        }
		public static function delete ($table ,  $conditions )
        {
            $that = new self();
            $sql = "DELETE FROM {$table} WHERE " ;
            if (is_int($conditions))
            {
                $conditions = (int) $conditions;
                $sql .= " id = $conditions ";
            }
            else if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $sql .= $field .'='.'\''. mysqli_real_escape_string($that->link,($value)) .'\' AND ';
                    } else {
                        $sql .= $field .'='. mysqli_real_escape_string($that->link,($value)) . ' AND ';
                    }
                }
                $sql = substr($sql, 0, -5);
            }
            else
            {
                $sql .= $conditions ;
            }

            $check = mysqli_query($that->link,$sql);
            if ( ! $check)
            {
                dd(" Xóa thất ! bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
            else
            {
                return mysqli_affected_rows($that->link);
            }

        }
		public static function fetchOne($table , $conditions ,$showsql = false)
        {
            $that = new self();
            $sql = "SELECT * FROM {$table} " ;

            if ( is_int($conditions))
            {
                $sql .= " WHERE id = $conditions ";
            }
            else
            {
                $sql .= " WHERE  " .$conditions ;
            }

            $check = mysqli_query($that->link,$sql);

            
            if ($showsql)
            {
                dd(" Câu truy vấn : => " . '<b style="color:red">'.$sql.'</b>');
                die;
            }

            if ( ! $check)
            {
                dd(" Câu truy vấn : => " . '<b style="color:red">'.$sql.'</b>');
                dd(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }

        
            return mysqli_fetch_assoc($check);
            
        }
		public static function query($table, $get = '*' , $conditions = '' )
        {
            $that = new self();
            $sql = "SELECT {$get} FROM {$table} WHERE 1 AND " ;
            $where = '';
            if (is_array($conditions))
            {
                foreach($conditions as $field => $value) {
                    if(is_string($value)) {
                        $where .= $field .'='.'\''. mysqli_real_escape_string($that->link,($value)) .'\' AND ';
                    } else {
                        $where .= $field .'='. mysqli_real_escape_string($that->link,($value)) . ' AND ';
                    }
                }
                $where = substr($where, 0, -5);
                $sql .= $where;
            }
            else
            {
                $sql = substr($sql, 0, -5);
                $sql .= $conditions ;
            }
            $result = mysqli_query($that->link,$sql);
			
            if ( ! $result)
            {
                dd(" Câu truy vấn : => " . '<b style="color:red">'.$sql.'</b>');
                dd(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");die;
            }
			$data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;

        }
		public static function fetchsql( $sql )
        {
            $that = new self();
			$result = mysqli_query($that->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($that->link));
            $data = [];
            if ( ! $result )
            {
                dd(" Truy vấn thất bại Dữ liệu truyền vào sai hoạc truy vấn của bạn không đúng ! Mời bạn xem lại ");
            }
            else
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }
        public static function countTable($table)
        { 
            $that = new self();
            $sql = "SELECT id FROM  {$table}";
            $result = mysqli_query($that->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($that->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

    }

?>
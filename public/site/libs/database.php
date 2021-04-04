//trang ket noi voi database
<?php
// Biến lưu trữ kết nối
$conn = null;
 
// Hàm kết nối
function db_connect(){
    global $conn; //goi den bien da khai bao
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', 'vertrigo', 'php_example') 
                or die ('Không thể kết nối CSDL');
        mysqli_set_charset($conn, 'UTF-8');
    }
}
 
// Hàm ngắt kết nối
function db_close(){
    global $conn;
    if ($conn){
    	mysql_close($conn);
        //mysqli_close($conn);
    }
}
 
// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
function db_get_list($sql){
    db_connect();
    global $conn;
    $data  = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}
 
// Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
function db_get_row($sql){
    db_connect();
    global $conn;
    $result = mysqli_query($conn, $sql);
    $row = array();
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
    return $row;
}
 
// Hàm thực thi câu truy  vấn insert, update, delete
function db_execute($sql){
    db_connect();
    global $conn;
    return mysqli_query($conn, $sql);
}


?>
<script src="/public/admin/js/jquery.min.js"></script>
<script src="/public/admin/js/bootstrap.min.js"></script>
<script src="/public/admin/js/jquery.slimscroll.min.js"></script>
<script src="/public/admin/js/fastclick.js"></script>
<script src="/public/admin/js/adminlte.min.js"></script>
<script src="/public/admin/js/demo.js"></script>
<script src="/public/app/js/notify.js"></script>
<script src="/public/admin/js/jquery-confirm.min.js"></script>
<script src="/public/admin/js/app.js"></script>
<?php
    if( isset($_SESSION['success']))
    {
        $string = $_SESSION['success'];
        unset($_SESSION['success']);
        echo "<script>$.notify('$string','success');</script>";
    }

    if( isset($_SESSION['error']))
    {
        $string = $_SESSION['error'];
        unset($_SESSION['error']);
        echo "<script>$.notify('$string','error');</script>";
    }
?>
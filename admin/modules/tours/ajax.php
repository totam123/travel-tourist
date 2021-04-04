<?php
    require_once __DIR__ .'/../../autoload.php';

    $id = (int)Input::get('id');

    $tour = DB::fetchOne('tours',' id = '.$id);

?>
<tr class='item_product_content' style="background: white">
    <td colspan="6" style="padding: 20px">
        <h4>Giới thiệu tour </h4>
        <div style="overflow: hidden;width: 100%;height: 100%">
            <?= $tour['t_content'] ?>
        </div>

    </td>
</tr>

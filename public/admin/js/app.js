var xulyadmin =
{
    init : function () {
        let _this = this;
        _this.previewImg();
        _this.viewOrder(); // chi tiet don hang 
        _this.removeItemOrder();
    },

    previewImg()
    {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
    },
    viewOrder()
    {
        $('.item-order').click(function() {
            $id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                url:  location.href+'view.php',
                data: { id : $id},
                success: function( msg ) {
                    $("#modal-vieworder").modal({
                        show : true,
                        backdrop : 'static'
                    });
                    $("#order-content").html('').append(msg);
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });

            // $("#modal-vieworder").html('').append(html);
            
        });
    },
    removeItemOrder()
    {
        $(document).on('click','.delete_item_order',function(){
            $this = $(this);
            $id = $this.attr('data-id_order');
            $.ajax({
                type: "GET",
                url:  location.href+'delete_item.php',
                data: { id : $id},
                success: function( msg ) {
                   
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        })
    },
    currency(nStr)
    {
        // formath gia tien
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
}


$(function () {
    xulyadmin.init();
})
$( function(){
    $(".comfirm_delete").click(function (event) {
        event.preventDefault();
        let url = $(this).attr("href");
        $.confirm({
            title: ' Xoá dữ liệu',
            content: ' Dữ liệu xoá đi không thể khôi phục hãy cân nhắc nhé !!!',
            type: 'green',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-danger',
                    keys: ['enter'],
                    action: function(){
                        console.log(this)
                        location.href = url;
                    }
                },
                cancel: function(){}
            }
        });
    })
})
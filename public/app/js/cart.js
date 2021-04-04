var ShoppingCart = {
    configSelect : {
        'classItemAddCart'    : '.add-to-car' , // class  them san pham vao gio hang
        'classItemDeleteCart' : '.item-product-remove' , // class xoa chi tiet tung san pham trong  gio hang 
        'classChangeQtyCart'  : '.change-qty-cart' , // thay doi so luong trong gio hang 
        'idTotalCart'         : '#total-cart' , // id chua noi dung tong tien ,
        'classTotalItem'      : '.total-item' , // tong tien cua tung sp
    },

    init : function()
    {
        let _this = this;

        _this.clickAddItemProductToCart();
        _this.clickItemDeleteCart();
        _this.clickItemChangeQty();
    },

    clickAddItemProductToCart : function()
    {
        let _this = this;
        $(_this.configSelect.classItemAddCart).click(function(event){
            event.preventDefault();
        
            let qty = $("#qty").val();
            if (qty == 'undefined')
            {
                qty = 1;
            }
            let id = $(this).attr('data-id-product');
                $.ajax({
                type: "GET",
                url: location.origin + '/shoppingcart/add.php',
                async:true,
                dataType:'json',
                data: { idProduct : id,qty : qty },
                success: function( msg ) {
                    
                    if( msg.status == 1)
                    {   
                        var menu_cart = '<span>'+msg.qty+'</span>'
                        $('.cart-items-count').html(menu_cart);
                        $('.notify-right').html(msg.qty);
                       

                    }else if(msg.status == 0) {
                        
                        alert("Số lượng sản phẩm không đủ ");
                    
                    } else {
                        alert("Số lượng sản phẩm không đủ ");
                    }
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        });
    },

    clickItemDeleteCart : function()
    {
        let _this = this ;
        $(_this.configSelect.classItemDeleteCart).click(function(){
            let id = $(this).attr('data-id-product');
            let $this = $(this);

            if (id)
            {
                $.ajax({
                    type: "POST",
                    url:  location.origin + '/shoppingcart/remove.php',
                    data: { id : id},
                    success: function( msg ) {
                       
                        msg = jQuery.parseJSON(msg)
                        if( msg.code)
                        {
                            $this.parents('tr').remove();
                            $(_this.configSelect.idTotalCart).text(msg.total);
                            var menu_cart = '<span>'+msg.qty+'</span>'
                            $('.cart-items-count').html(menu_cart);
                            $('.notify-right').html(msg.qty);
                            
                        }else 
                        {
                            alert("Xoá sản phẩm trong giỏ hàng thất bại");
                        }
                    },
                    error : function () {
                        alert("Lỗi xử lý ajax ");
                    }
                });
            }else
            {
                alert(' Không tồn tại id sản phẩm ');
            }
        });
    },

    clickItemChangeQty : function()
    {
        let _this = this ;
        $(_this.configSelect.classChangeQtyCart).click(function(){
            let $this = $(this);
            let qty = $this.val();
            let id  = $this.attr('data-id-product');
            $.ajax({
                type: "POST",
                url:  location.origin + '/shoppingcart/update.php',
                data: { id : id,qty : qty},
                success: function( msg ) {
                    
                    msg = jQuery.parseJSON(msg)
                    console.log(msg);
                    if( msg.code)
                    {
                        var menu_cart = '<span>'+msg.qty+'</span>'
                        $('.cart-items-count').html(menu_cart);

                        $('.notify-right').html(msg.qty);
                        $this.parents('tr').find($(_this.configSelect.classTotalItem)).text(msg.total_item)
                        $(_this.configSelect.idTotalCart).text(msg.total);
                    }else 
                    {
                        alert("Cập nhật thất bại");
                    }
                },
                error : function () {
                    alert("Lỗi xử lý ajax ");
                }
            });
        });
    }
}

ShoppingCart.init();
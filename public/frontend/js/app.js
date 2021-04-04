
var Login = {
    configSelecter :{
        base_Url: location.origin, // duong dan url
    },
	init : function()
	{
		let _this = this;
		$(".btn-show-login").click( function(){
			console.log("OK");
			$("#myModal").modal('show');
		})

		$(".btn-login-user").on('click',function(){
			let $email    = $(".ip-email").val();
			let $password = $(".ip-password").val();

			let $login = 1;
			if(!$email.length)
			{
				$login = 0;
				$(".email-alert").html(' Mời bạn điền email đăng nhập !');
			}

			if(!$password.length)
			{
                $login = 0;
				$(".password-alert").html(' Mời bạn điền password đăng nhập !');
			}

			if ($login == 1)
			{
                $.ajax({
                    type: "POST",
                    url:  _this.configSelecter.base_Url + '/ajax/dangnhap.php',
                    data: { email : $email,password : $password },
                    success: function( msg ) {
                        if( msg == 1)
                        {
                        	alert("Đăng nhập thành công ")
                        }else
                        {
                            alert(' Đăng nhập thất bại');
                        }
                    },
                    error : function () {
                        console.log(" LOI AJAX ");
                    }
                });
			}else
			{
				console.log("CHUA")
			}
		});
	}
}



$( function() {
	Login.init();
})
$( document ).ready( function(){
	$( '#_login_submit' ).on( 'click', function(){
		var _this = $( this );
		var _user_info = _this.parent().find( 'input[type=text]').val();
		var _user_password = _this.parent().find( 'input[type=password]').val();
		_this.parent().find( 'input').removeClass( 'nn_active' );
		if( _user_info =="" ){
			$( 'html' ).append( '<span class="login_error">Vui lòng không bỏ trống tên đăng nhập</span>') ;
			_this.parent().find( 'input[type=text]').addClass( 'nn_active' );
			setTimeout( function(){
				$( '.login_error' ).addClass( 'hide' );
			}, 3500);
		}
		else if( _user_password =="" ){
			$( 'html' ).append( '<span class="login_error">Vui lòng không bỏ trống mật khẩu</span>') ;
			_this.parent().find( 'input[type=password]').addClass( 'nn_active' );
			setTimeout( function(){
				$( '.login_error' ).addClass( 'hide' );
			}, 3500);
		}
		else{
			$.ajax({
				url: 'curl/login/read.php',
				type: 'POST',
				async: false,
				data: {
					'user_info': _user_info,
					'user_password': _user_password,
					'action': 'log'
				},
				beforeSend: function(){
					$( '.login_error' ).remove();
				},
				success: function( data ){
					if( data == 'NN_PROJECT' )
						location.href = "index.php";
					else {
						$( 'html' ).append( '<span class="login_error">Tài khoản hoặc mật khẩu không chính xác</span>' )
						setTimeout( function(){
							$( '.login_error' ).addClass( 'hide' );
						}, 3500);
					}
				}
			});
		}
	})
	$( '.info' ).on( 'keypress', function( e ){
		if( e.which === 13 )
			$( '#_login_submit' ).click();
	})
})
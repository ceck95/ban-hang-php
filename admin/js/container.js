$(document).ready( function(){
	var htmlLoading = "<div id='_nn_loading'></div>";
	var htmlwaiting = '<span id="_nn_waiting">Waiting</span>';
	var htmlsuccess = '<span id="_nn_success">Thành công</span>';
	var htmlfail = '<span id="_nn_success">Thất bại</span>';
	$( '.nn_tabs_item' ).on( 'click', function(){
		var _this = $( this );
		_this.parent().children().removeClass( 'nn_active' );
		_this.addClass( 'nn_active' );
		_id = _this.prop( 'id' );
		_function = _id.slice(4);
		var _mod = _this.data( 'mod' );
		$.ajax({
			url: 'curl/' + _mod + '/template.php',
			type: 'POST',
			data: {

			},
			beforeSend: function(){
				$('#_nn_content' ).html( htmlLoading );
			},
			success: function( data ){
				$( '#_nn_content' ).html( data );
				if( _function == "product_product")
					product_product();
				if( _function == "add_product")
					add_product();
				if( _function == "product_category")
					product_category();
				
				if( _function == "user_user" )
					user_user();
				if( _function == "cart_cart" )
					cart_cart();
				if( _function == "cart_order" )
					cart_order();
			}
		})
	} )
	$( '#_nn_product_product' ).click();
	$( '#_nn_user_user' ).click();
	$( '#_nn_cart_cart' ).click();

	/*
	* js chỉnh trang sản phẩm
	*/
	function product_product(){
		edit_save_product();
		confirm_delete();
		select_paging();
		search_product();
		/*
		* hien chi tiet
		*/
		$( '.nn_icon_detail' ).on( 'click', function(){
			$( this ).parent().parent().next().toggleClass( 'nn_hide' );
		})
		/*
		* chỉnh sửa && lưu
		*/
		function edit_save_product(){
			/*
			*nút chỉnh sửa
			*/
			$( '.nn_menu_option' ).off( 'click' );
			$( '.nn_icon_edit' ).on( 'click', function(){
				$( this ).next().show();
				$( this ).hide();
				// an confirm
				$( '.nn_confirm' ).hide();
				$( this ).parent().parent().children().children().attr( 'readonly', false);
				$( this ).parent().parent().children().children().attr( 'disabled', false);
				$( this ).parent().parent().find( '.nn_edit_file' ).removeClass( 'nn_hide' );

				$( this ).parent().parent().next().find( '.nn_edit_file' ).removeClass( 'nn_hide' );
				$( this ).parent().parent().next().find( 'input[readonly]' ).attr( 'readonly', false );
				$( this ).parent().parent().next().find( 'textarea[readonly]' ).attr( 'readonly', false );
				$( this ).parent().parent().next().find( 'select[disabled]' ).attr( 'disabled', false );


			} )		
			/*
			*function uploads edit image
			*/
			function preview_image(){
				$( '.nn_input_file' ).on( 'change', function(event) {
					var _this = $( this );
					var _input = event.target;
					var _reader = new FileReader();
					_reader.onload = function(){
						var dataURL = _reader.result;
						var _output = _this.parent().parent().find('img');
						_output.attr( 'src', dataURL );
					};
					_reader.readAsDataURL( _input.files[0] );
				})
			}
			preview_image();

			/*
			*nút lưu
			*/
			$( '.nn_icon_save' ).on( 'click', function(){
				$( '#_nn_success' ).remove();
				//an confirm
				$( '.nn_confirm' ).hide();
				var _this = $( this );
				var _id = $( this ).data( 'id' );
				var _img = 'image' + _id;
				_img = $( '#' + _img ).attr( 'src' );
				var _name = 'name' + _id;
				_name = $( '#' + _name ).val();

				var _cate = 'cate' + _id;
				_cate = $( '#' + _cate ).val();

				var _price = 'price' + _id;
				_price = $( '#' + _price ).val();
				var _discount = 'discount' + _id;
				_discount = $( '#' + _discount ).val();
				var _total = 'total' + _id;
				_total = $( '#' + _total ).val();
				var _bought = 'bought' + _id;
				_bought = $( '#' + _bought ).val();
				var _discribe = 'discribe' + _id;
				_discribe = $( '#' + _discribe ).val();
				var _date = 'date' + _id;
				_date = $( '#' + _date ).val();

				if( _name == "" || _cate == "" || _price == "" || _discount == "" || _discribe == "" || _total == "" || _bought =="" || _date == ""){
					_this.parent().parent().children().children().addClass( 'nn_active' );
					$( '#_nn_content' ).append( htmlfail );
				}
				else{
					var data = new FormData();
					data.append( 'edit_file', $( '#_nn_edit_file' + _id )[0].files[0] );
					data.append( 'id_save', _id );
					data.append( 'action', 'save' );
					data.append( 'name', _name );
					data.append( 'date', _date );
					data.append( 'cate', _cate );
					data.append( 'price', _price );
					data.append( 'discount', _discount );
					data.append( 'total', _total );
					data.append( 'discribe', _discribe );
					data.append( 'bought', _bought );
					$.ajax({
						url: 'curl/product.product/read.php',
						type: 'POST',
						async: false,
						cache: false,
						contentType: false,
						processData: false,
						data: data,
						beforeSend: function(){
							$('#_nn_content' ).append( htmlwaiting );
						},
						success: function( data ){
							$( '#_nn_waiting' ).remove();
								$( _this ).parent().parent().children().children().removeClass( 'nn_active' );
								$( '#_nn_content' ).append( htmlsuccess );
								$( '#_nn_success' ).fadeOut( 2000 );
								_this.parent().find('.nn_icon_edit' ).show();
								_this.parent().parent().find( '.nn_edit_file' ).addClass( 'nn_hide' );
								_this.hide();
								_this.parent().parent().children().children().attr( 'readonly', true);
								_this.parent().parent().children().find( '.nn_select' ).attr( 'disabled', true);

								_this.parent().parent().next().find( '.nn_edit_file' ).addClass( 'nn_hide' );
								_this.parent().parent().next().find( 'input' ).attr( 'readonly', true );
								_this.parent().parent().next().find( 'textarea' ).attr( 'readonly', true );
								_this.parent().parent().next().find( '.nn_select' ).attr( 'disabled', true );
						}
					});
				}
			} )	
		}
		/*
		* nút xóa
		*/
		function confirm_delete(){
			$( '.nn_icon_delete' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				var _this = $( this );
				_this.next().show();
			})
			// ok
			$( '.nn_confirm_ok' ).on( 'click', function(){
				var _this = $( this );
				var _id_del = _this.data( 'id' );
				$.ajax({
					url: 'curl/product.product/read.php',
					type: 'POST',
					async: false,
					cache: false,
					data: {
						'action' : 'delete',
						'id_del' : _id_del
					},
					beforeSend: function(){
					$( '#_nn_content' ).append( htmlwaiting );
					$( '#_nn_success' ).remove();
					},
					success: function( data ){
					$( '#_nn_waiting' ).remove();
					$( '#_nn_content' ).append( htmlsuccess );
					$( '#_nn_success' ).fadeOut( 2000 );
					$( '.nn_confirm' ).hide();
					_this.parent().parent().parent().parent().remove();
					}
				})
			})
			//cacel
			$( '.nn_confirm_cancel' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				$('.nn_icon_delete').on( 'click' );
			})
		}
		/*
		* phân trang
		*/
		function select_paging(){
			$( '#_nn_toolbar_page .nn_menu_option' ).on( 'click', function(){
				$( 'body' ).off( 'click' );
				var _this = $( this );
				_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' , function() {
					$( 'body' ).on( 'click', function(e){
					if( e.target.id != $( this ).find( '.nn_menu_item' ).attr( 'id' ) ){
						$( '.nn_menu_item' ).hide();
					}
				})
				});
				
			})
			$( '#_nn_toolbar_page .nn_menu_item' ).on( 'click', function(){
				var _this = $( this );
				var _html = _this.html();
				var _page = _this.data( 'page' );
				var _mod = _this.data( 'mod' );
				var _selected_item = "Trang " + ( _page + 1);
				$( '#_nn_loading' ).remove();
				$.ajax({
					url: 'curl/' + _mod + '/template.php',
					type: 'POST',
					cache: false,
					async: false,
					data: {
						'id_page': _page
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlLoading );
					},
					success: function( data ){
						$( '#_nn_loading' ).fadeOut();
						$('#_nn_content' ).html( data );
						product_product();
						$('#_nn_toolbar_page .nn_menu_option').html( _selected_item );
						_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' );
					}
				})
			})
		}
		/*
		* tìm kiếm theo tên
		*/
		function search_product(){
			$( '#_nn_search_product' ).on( 'keypress', function(e){
				$( '#_nn_loading' ).remove();
				if( e.which === 13 ){
					var _this = $( this );
					var _name = _this.val();
					$.ajax({
						url: 'curl/product.product/template.php',
						type: 'POST',
						cache: false,
						async: false,
						data: {
							'action': 'search',
							'keyword': _name
						},
						beforeSend: function(){
							$( '#_nn_content' ).html( htmlLoading );
						},
						success: function( data ){
							$( '#_nn_loading' ).fadeOut();
							if( data ){
								$( '#_nn_content' ).html( data );
								$( '#_nn_search_product' ).val( _name );
								product_product();
							} 
						}
					})
				}
			})
		}
		/*
		* end product_product();
		*/
	}

	function add_product(){
			preview_image();
			$( '#_nn_addproduct_detail' ).trumbowyg();
			$( '#_nn_success' ).remove();
			$( '#_nn_addproduct_button' ).on( 'click', function(){
				var _name = get_value( '_name');
				var _cate = get_value( '_cate' );
				var _price = get_value( '_price' );
				var _discount = get_value( '_discount' );
				var _discribe = get_value( '_discribe' );
				var _detail = $( '#_nn_addproduct_detail' ).html();
				var _total = get_value( '_total' );
				var _date = get_value( "_date" );
				var _src = $( '#_nn_addproduct_image' ).attr( 'src' );

				if( _src == "" || _name == "" || _cate == "" || _price == "" || _discount == "" || _discribe == "" || _detail == "" || _total == "" || _date == "" ){
					$( '#_nn_content' ).append( htmlfail );
					setTimeout( function(){
						$( '#_nn_success' ).remove();
					}, 2000)
				}
				else {
					var data = new FormData();
					data.append( 'action', 'addproduct');
					data.append( 'name', _name );
					data.append( 'cate', _cate );
					data.append( 'price', _price );
					data.append( 'discount', _discount );
					data.append( 'discribe', _discribe );
					data.append( 'detail', _detail );
					data.append( 'total', _total );
					data.append( 'date', _date );
					data.append( 'add_file', $( '#_nn_add_file' )[0].files[0] );		

					$.ajax( {
						url: 'curl/product.addproduct/read.php',
						type: 'POST',
						cache: false,
						async: false,
						contentType: false,
						processData: false,
						data: data,
						beforeSend: function(){
							$( '#_nn_content' ).append( htmlwaiting );
						},
						success: function( data ){
							$( '#_nn_waiting ' ).remove();
								$( '#_nn_content' ).append( htmlsuccess );
								$( '#_nn_success' ).fadeOut( 2000 );
								$( '#_nnn_add_product' ).click();
								console.log( data );
						}
					} );
				}
			})
			function get_value( x ){
				return $( '#_nn_addproduct' + x ).val();
			}
			function preview_image(){
				$( '.nn_input_file' ).on( 'change', function(event) {
					var _this = $( this );
					var _input = event.target;
					var _reader = new FileReader();
					_reader.onload = function(){
						var dataURL = _reader.result;
						var _output = _this.parent().parent().find('img');
						$( '.nn_preview_image' ).show();
						_output.attr( 'src', dataURL );
					};
					_reader.readAsDataURL( _input.files[0] );
					_this.parent().prev().show();
				})
				if( $( '.nn_preview_image' ).attr( 'src' ) == "" )	$( '.nn_preview_image' ).hide();
			}
	}

	function product_category(){
		// animate label
		$( '#_nn_input_add_cate' ).on( 'focus', function(){
			$( '#_nn_label_add_cate' ).addClass( 'nn_active' );
		})
		$( '#_nn_input_add_cate' ).on( 'focusout', function(){
			if( $( '#_nn_input_add_cate' ).val() =="" ) 
				$( '#_nn_label_add_cate' ).removeClass( 'nn_active' );
		})
		//edit category info
		$( '.nn_icon_edit').on( 'click', function(){
			var _this = $( this );
			_this.hide();
			_this.next().show();
			_this.parent().parent().children().children().attr( 'readonly', false );
		} )
		$( '.nn_icon_save' ).on( 'click', function(){
			var _this = $( this );
			var _id_cate = _this.data( 'category' );
			var _name = _this.parent().parent().find( '.nn_text' ).val();
			$( '#_nn_success' ).remove();
			if( _name == ""){
				_this.parent().parent().find( '.nn_text' ).addClass( 'nn_active' );
				$( '#_nn_content' ).append( htmlfail );
			}
			else
			$.ajax({
				url: 'curl/product.category/read.php',
				type: 'POST',
				cache: false,
				async: false,
				data: {
					'action': 'update_cate',
					'id_cate': _id_cate,
					'name_cate': _name
				},
				beforeSend: function(){
					$('#_nn_content' ).append( htmlwaiting );
				},
				success: function(){
					$( '#_nn_waiting' ).remove();
					$( '#_nn_content' ).append( htmlsuccess );
					$( '#_nn_success' ).fadeOut( 2000 );
					_this.hide();
					_this.prev().show();
					_this.parent().parent().children().children().removeClass( 'nn_active' );
					_this.parent().parent().children().children().attr( 'readonly', true );
					product_category();
				}
			});
		})
		//xoa
		$( '.nn_icon_delete' ).on( 'click', function(){
			$( '.nn_confirm' ).hide();
			var _this = $( this );
			_this.next().show();
		})
		//ok
		$( '.nn_confirm_ok' ).on( 'click', function(){
			var _this = $( this );
			var _id_del = _this.data( 'category' );
			$.ajax({
				url: 'curl/product.category/read.php',
				type: 'POST',
				async: false,
				cache: false,
				data: {
					'action' : 'delete',
					'id_del' : _id_del
				},
				beforeSend: function(){
					$( '#_nn_content' ).append( htmlwaiting );
					$( '#_nn_success' ).remove();
				},
				success: function( data ){
					$( '#_nn_waiting' ).remove();
					$( '#_nn_content' ).append( htmlsuccess );
					$( '#_nn_success' ).fadeOut( 2000 );
					$( '.nn_confirm' ).hide();
					_this.parent().parent().parent().parent().remove();
				}
			})
		})
		//cacel
		$( '.nn_confirm_cancel' ).on( 'click', function(){
			$( '.nn_confirm' ).hide();
			$('.nn_icon_delete').on( 'click' );
		})
		//ajax add cate
			$( '#_nn_button_add_cate' ).on( 'click', function(){
			var _this = $( this );
			var _name = _this.prev().val();
			if( _name == "" ){
				_this.next().show();
				setTimeout(function(){
					$( '#_nn_span_add_cate' ).fadeOut( '5000' );
				},2000);
			}
			else
				$.ajax({
					url: 'curl/product.category/read.php',
					type: 'POST',
					cache: false,
					async: false,
					data: {
						'action': 'add_cate',
						'name_cate': _name
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlwaiting );
						$( '#_nn_success' ).remove();
					},
					success: function( data ){
						$( '#_nn_waiting' ).remove();
						$( '#_nn_content' ).append( htmlsuccess );
						$( '#_nn_success' ).fadeOut( 2000 );
						$( '#_nn_table_add_cate tbody' ).append( data );
						$( '#_nn_input_add_cate' ).focusout();
						_this.prev().val( "" );
						$( '#_nn_label_add_cate' ).removeClass( 'nn_active' );
						$( '#_nn_button_add_cate' ).off( 'click' );
						product_category();
					}
				})
		})
	}
	/*
	* User
	*/
	function user_user(){
		edit_save_user();
		delete_user();
		search_user();
		select_paging();
		function edit_save_user(){
			$( '.nn_icon_edit' ).on( 'click', function(){
				var _this = $( this );
				_this.next().show();
				_this.hide();
				_this.parent().parent().find( 'input[readonly]' ).attr( 'readonly', false );
				_this.parent().parent().find( 'select[disabled]' ).attr( 'disabled', false );
			})
			$( '.nn_icon_save' ).on( 'click', function(){
				$( '#_nn_success' ).remove();
				var _this = $( this );
				var _id = _this.data( 'save' );
				var _name = _this.parent().parent().find( '.name' ).val();
				var _fullname = _this.parent().parent().find( '.fullname' ).val();
				var _date = _this.parent().parent().find( '.date' ).val();
				var _sex = _this.parent().parent().find( '.sex' ).val();
				var _phone = _this.parent().parent().find( '.phone' ).val();
				var _level = _this.parent().parent().find( '.level' ).val();
				var _email = _this.parent().parent().find( '.email' ).val();

				_this.parent().parent().find( '.nn_active' ).removeClass( 'nn_active' );
				if( _name == "" ){
					$( '#_nn_content' ).append( htmlfail );
					_this.parent().parent().find( '.name' ).addClass( 'nn_active' );
				}
				else if( _fullname == "" ){
					$( '#_nn_content' ).append( htmlfail );
					_this.parent().parent().find( '.fullname' ).addClass( 'nn_active' );
				}
				else if( _date == "" ){
					$( '#_nn_content' ).append( htmlfail );
					_this.parent().parent().find( '.date' ).addClass( 'nn_active' );
				}
				else if( _phone == "" ){
					$( '#_nn_content' ).append( htmlfail );
					_this.parent().parent().find( '.phone' ).addClass( 'nn_active' );
				}
				else if( _email == "" ){
					$( '#_nn_content' ).append( htmlfail );
					_this.parent().parent().find( '.email' ).addClass( 'nn_active' );
				}
				else{
					var data = new FormData();
					data.append( 'id_save', _id );
					data.append( 'name', _name );
					data.append( 'fullname', _fullname );
					data.append( 'date', _date );
					data.append( 'sex', _sex );
					data.append( 'phone', _phone );
					data.append( 'level', _level );
					data.append( 'action', 'save' );
					data.append( 'email', _email );

					$.ajax({
						url: 'curl/user.user/read.php',
						type: 'POST',
						data: data,
						cache: false,
						async: false,
						contentType: false,
						processData: false,
						beforeSend: function(){
							$( '#_nn_content' ).append( htmlwaiting );
						},
						success: function( data ){
							$( '#_nn_waiting' ).remove();
							$( '#_nn_content' ).append( htmlsuccess );
							$( '#_nn_success' ).fadeOut( 2000 );
							_this.prev().show();
							_this.hide();
							_this.parent().parent().find( '.name' ).attr( 'readonly', true );
							_this.parent().parent().find( '.fullname' ).attr( 'readonly', true );
							_this.parent().parent().find( '.date' ).attr( 'readonly', true );
							_this.parent().parent().find( '.sex' ).attr( 'disabled', true );
							_this.parent().parent().find( '.phone' ).attr( 'readonly', true );
							_this.parent().parent().find( '.email' ).attr( 'readonly', true );
							_this.parent().parent().find( '.level' ).attr( 'disabled', true );
						}
					});
				}
			})
		}
		function delete_user(){
			$( '.nn_icon_delete' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				var _this = $( this );
				_this.next().show();	
			})
			$( '.nn_confirm_cancel' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				$('.nn_icon_delete').on( 'click' );
			})
			$( '.nn_confirm_ok' ).on( 'click', function(){
				var _this = $( this );
				var _id = _this.data( 'user' );
				$.ajax({
					url: 'curl/user.user/read.php',
					type: 'POST',
					data: {
						'action': 'delete',
						'id_del': _id
					},
					cache: false,
					async: false,
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlwaiting );
					},
					success: function( data ){
						$( '#_nn_waiting' ).remove();
						$( '#_nn_content' ).append( htmlsuccess );
						$( '#_nn_success' ).fadeOut( 2000 );
						_this.parent().parent().parent().parent().remove();
					}
				})
			})
		}
		function search_user(){
			$( '#_nn_search_user' ).on( 'keypress', function(e){
				$( '#_nn_loading' ).remove();
				if( e.which === 13 ){
					var _this = $( this );
					var _name = _this.val();
					$.ajax({
						url: 'curl/user.user/template.php',
						type: 'POST',
						cache: false,
						async: false,
						data: {
							'action': 'search',
							'keyword': _name
						},
						beforeSend: function(){
							$( '#_nn_content' ).html( htmlLoading );
						},
						success: function( data ){
							$( '#_nn_loading' ).fadeOut();
							if( data ){
								$( '#_nn_content' ).html( data );
								$( '#_nn_search_user' ).val( _name );
								user_user();
							} 
						}
					})
				}
			})
		}
		function select_paging(){
			$( '#_nn_toolbar_page .nn_menu_option' ).on( 'click', function(){
				$( 'body' ).off( 'click' );
				var _this = $( this );
				_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' , function() {
					$( 'body' ).on( 'click', function(e){
					if( e.target.id != $( this ).find( '.nn_menu_item' ).attr( 'id' ) ){
						$( '.nn_menu_item' ).hide();
					}
				})
				});
				
			})
			$( '#_nn_toolbar_page .nn_menu_item' ).on( 'click', function(){
				var _this = $( this );
				var _html = _this.html();
				var _page = _this.data( 'page' );
				var _mod = _this.data( 'mod' );
				var _selected_item = "Trang " + ( _page + 1);
				$( '#_nn_loading' ).remove();
				$.ajax({
					url: 'curl/' + _mod + '/template.php',
					type: 'POST',
					cache: false,
					async: false,
					data: {
						'id_page': _page
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlLoading );
					},
					success: function( data ){
						$( '#_nn_loading' ).fadeOut();
						$('#_nn_content' ).html( data );
						user_user();
						$('#_nn_toolbar_page .nn_menu_option').html( _selected_item );
						_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' );
					}
				})
			})
		}
	}
	/*
	* js trang giỏ hàng
	*/
	function cart_cart(){
		delete_cart();
		select_paging();
		function delete_cart(){
			$( '.nn_icon_delete' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				var _this = $( this );
				_this.next().show();
			})
			//ok
			$( '.nn_confirm_ok' ).on( 'click', function(){
				var _this = $( this );
				var _id_del = _this.data( 'id' );
				$.ajax({
					url: 'curl/cart.cart/read.php',
					type: 'POST',
					async: false,
					cache: false,
					data: {
						'action' : 'delete',
						'id_del' : _id_del
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlwaiting );
						$( '#_nn_success' ).remove();
					},
					success: function( data ){
						$( '#_nn_waiting' ).remove();
						$( '#_nn_content' ).append( htmlsuccess );
						$( '#_nn_success' ).fadeOut( 2000 );
						$( '.nn_confirm' ).hide();
						_this.parent().parent().parent().parent().remove();
					}
				})
			})
			//cacel
			$( '.nn_confirm_cancel' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				$('.nn_icon_delete').on( 'click' );
			})
		}
		function select_paging(){
			$( '#_nn_toolbar_page .nn_menu_option' ).on( 'click', function(){
				$( 'body' ).off( 'click' );
				var _this = $( this );
				_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' , function() {
					$( 'body' ).on( 'click', function(e){
					if( e.target.id != $( this ).find( '.nn_menu_item' ).attr( 'id' ) ){
						$( '.nn_menu_item' ).hide();
					}
				})
				});
				
			})
			$( '#_nn_toolbar_page .nn_menu_item' ).on( 'click', function(){
				var _this = $( this );
				var _html = _this.html();
				var _page = _this.data( 'page' );
				var _mod = _this.data( 'mod' );
				var _selected_item = "Trang " + ( _page + 1);
				$( '#_nn_loading' ).remove();
				$.ajax({
					url: 'curl/' + _mod + '/template.php',
					type: 'POST',
					cache: false,
					async: false,
					data: {
						'id_page': _page
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlLoading );
					},
					success: function( data ){
						$( '#_nn_loading' ).fadeOut();
						$('#_nn_content' ).html( data );
						cart_cart();
						$('#_nn_toolbar_page .nn_menu_option').html( _selected_item );
						_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' );
					}
				})
			})
		}

	}
	function cart_order(){
		select_paging();
		delete_cart();
		function delete_cart(){
			$( '.nn_icon_delete' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				var _this = $( this );
				_this.next().show();
			})
			//ok
			$( '.nn_confirm_ok' ).on( 'click', function(){
				var _this = $( this );
				var _id_del = _this.data( 'id' );
				$.ajax({
					url: 'curl/cart.order/read.php',
					type: 'POST',
					async: false,
					cache: false,
					data: {
						'action' : 'delete',
						'id_del' : _id_del
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlwaiting );
						$( '#_nn_success' ).remove();
					},
					success: function( data ){
						$( '#_nn_waiting' ).remove();
						$( '#_nn_content' ).append( htmlsuccess );
						$( '#_nn_success' ).fadeOut( 2000 );
						$( '.nn_confirm' ).hide();
						_this.parent().parent().parent().parent().remove();
					}
				})
			})
			//cacel
			$( '.nn_confirm_cancel' ).on( 'click', function(){
				$( '.nn_confirm' ).hide();
				$('.nn_icon_delete').on( 'click' );
			})
		}
		function select_paging(){
			$( '#_nn_toolbar_page .nn_menu_option' ).on( 'click', function(){
				$( 'body' ).off( 'click' );
				var _this = $( this );
				_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' , function() {
					$( 'body' ).on( 'click', function(e){
					if( e.target.id != $( this ).find( '.nn_menu_item' ).attr( 'id' ) ){
						$( '.nn_menu_item' ).hide();
					}
				})
				});
				
			})
			$( '#_nn_toolbar_page .nn_menu_item' ).on( 'click', function(){
				var _this = $( this );
				var _html = _this.html();
				var _page = _this.data( 'page' );
				var _mod = _this.data( 'mod' );
				var _selected_item = "Trang " + ( _page + 1);
				$( '#_nn_loading' ).remove();
				$.ajax({
					url: 'curl/' + _mod + '/template.php',
					type: 'POST',
					cache: false,
					async: false,
					data: {
						'id_page': _page
					},
					beforeSend: function(){
						$( '#_nn_content' ).append( htmlLoading );
					},
					success: function( data ){
						$( '#_nn_loading' ).fadeOut();
						$('#_nn_content' ).html( data );
						cart_order();
						$('#_nn_toolbar_page .nn_menu_option').html( _selected_item );
						_this.parent().find( '.nn_menu_item' ).slideToggle( 'fast' );
					}
				})
			})
		}	
	}
	/*
	*end js
	*/
} );
<?php
	require_once( '../../autoload.php' );
	$cart = new cart( HOST, USER, PASS, DBNAME );
	$info_order = $cart -> get_order();
	$total_order = count( $info_order );
	$order_in_page = 5;
	$total_page = floor( $total_order / $order_in_page );
	if( ( $total_order % $order_in_page ) > 0 )
		$total_page++;
	if( !isset( $_POST['id_page'] ) )
		$_POST['id_page'] = 0;
	$info_order = $cart -> get_order_page( $_POST['id_page'], $order_in_page);
	echo '
<ul class="nn_toolbar">
	<span class="nn_toolbar_title">Công cụ</span>
	<li class="nn_toolbar_li">
		<ul id="_nn_toolbar_page" class="nn_menu">
			<li class="nn_menu_option">Chọn trang</li>';
			for( $i = 0; $i < $total_page; $i++ ){
				$j = $i + 1;
				$html2 ='<li data-mod="cart.order" data-page='."$i".' class="nn_menu_item">Trang '."$j".'</li>';
				echo $html2;
			}
		echo '</ul>
	</li>
</ul>
<table class="nn_table nn_col_12">
	<tr class="nn_tr_header">
		<td>ID</td>
		<td>ID giỏ hàng</td>
		<td>Thành viên</td>
		<td>SĐT</td>
		<td>Giá trị</td>
		<td>Ngày giao dịch</td>
		<td>Biên tập</td>
	</tr>';
	foreach ($info_order as $key => $value) {
		$pro = $cart -> get_product_by_idcart( $value['cart_id'] );
		$price = $pro['price'];
		$price = number_format( $price, 0, ',','.')  . ' VNĐ' ;

		$user = $cart -> get_user_by_idcart( $value['cart_id'] );
		$name_user = $user['name'];
		$phone_user = $user['phone'];
	$html = '
	<tr>
		<td>'. $value['order_id'] .'</td>
		<td>'. $value['cart_id'] .'</td>
		<td>'. $name_user .'</td>
		<td>'. $phone_user .'</td>
		<td class="nn_aln_right">'. $price .'</td>
		<td>'. $value['date'] .'</td>
		<td>
			<button class="nn_icon nn_icon_delete"></button>
			<div class="nn_confirm nn_hide">
				<div class="nn_confirm_item">
					<span>Bạn muốn xóa đơn hàng <br>"'. $value['order_id'] .'"</span>
					<button class="nn_confirm_ok" data-id="'. $value['order_id'] .'">ok</button>
					<button class="nn_confirm_cancel">cancel</button>
				</div>
			</div>
		</td>
	</tr>';
	echo $html;
	}
	echo '
</table>';
?>
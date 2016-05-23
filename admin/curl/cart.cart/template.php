<?php
	require_once( '../../autoload.php' );
	$cart = new cart( HOST, USER, PASS, DBNAME );
	$info_cart = $cart -> get_cart();
	$total_cart = count( $info_cart );
	$cart_in_page = 2;
	$total_page = floor($total_cart / $cart_in_page);
	//phan trang
	if( ( $total_cart % $cart_in_page ) > 0 )
		$total_page++;
	if( !isset( $_POST['id_page'] ) )
		$_POST['id_page'] = 0;
	$info_cart = $cart -> get_cart_page( $_POST['id_page'], $cart_in_page );
	echo '
<ul class="nn_toolbar">
	<span class="nn_toolbar_title">Công cụ</span>
	<li class="nn_toolbar_li">
		<ul id="_nn_toolbar_page" class="nn_menu">
			<li class="nn_menu_option">Chọn trang</li>';
			for( $i = 0; $i < $total_page; $i++ ){
				$j = $i + 1;
				$html2 ='<li data-mod="cart.cart" data-page='."$i".' class="nn_menu_item">Trang '."$j".'</li>';
				echo $html2;
			}
		echo '</ul>
	</li>
</ul>
<table class="nn_table nn_col_12">
	<tr class="nn_tr_header">
		<td>ID Giỏ hàng</td>
		<td>Thành viên</td>
		<td>SĐT</td>
		<td>Sản phẩm</td>
		<td>Số lượng</td>
		<td>Tổng giá trị</td>
		<td>Biên tập</td>
	</tr>';
	foreach ( $info_cart as $key => $value) {
		$info_user_by_cart = $cart -> get_user_by_idcart( $value['cart_id'] );
		$info_product_by_cart = $cart -> get_product_by_idcart( $value['cart_id'] );
		$price = $value['count'] * $info_product_by_cart['price'];
		$price = number_format( $price, 0, ',','.')  . ' VNĐ' ;
$html = '
	<tr>
		<td>'. $value['cart_id'] .'</td>
		<td>'. $info_user_by_cart['name'] .'</td>
		<td>'. $info_user_by_cart['phone'] .'</td>
		<td>'. $info_product_by_cart['name_product'] .'</td>
		<td>'. $value['count'] .'</td>
		<td class="nn_aln_right">'. $price .'</td>
		<td>
			<button class="nn_icon nn_icon_delete" title="Xóa"></button>
			<div class="nn_confirm nn_hide">
				<div class="nn_confirm_item">
					<span>Bạn muốn xóa sản phẩm <br>" '. $info_product_by_cart['name_product'] .' "</span>
					<button class="nn_confirm_ok" data-id="'.$value['id'].'">ok</button>
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
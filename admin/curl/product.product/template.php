<?php
	require_once( '../../autoload.php' );
	$product = new product(HOST, USER, PASS, DBNAME );
	$cate = $product -> get_cate();//lay the loai
	$total_cate = count( $cate );//tong the loai
	$pro_array = $product -> get_product();	
	$total_pro = count( $pro_array );
	$pro_in_page = 5;
	$total_page = floor($total_pro / $pro_in_page);
	//phan trang
	if( ( $total_pro % $pro_in_page ) > 0 )
		$total_page++;
	if( !isset( $_POST['id_page'] ) )
		$_POST['id_page'] = 0;
	$pro_array = $product -> get_product_page( $_POST['id_page'], $pro_in_page );
	//search result
	if( isset( $_POST['keyword']) && $_POST['action']  == 'search' ){
		$pro_array = $product -> search_product( $_POST['keyword'] );
		//var_dump($pro_array);
	}
	//html chon the loai
	$cate_select = $product -> get_cate();
	$html_cate = "";
	foreach ($cate_select as $key => $value_cate_info) {
		$html_cate = $html_cate .
		'<option value="'. $value_cate_info['id'] .'">'. $value_cate_info['ten'] .'</option>
					';
	}
	echo '<ul class="nn_toolbar">
			<span class="nn_toolbar_title">Công cụ</span>
			<li class="nn_toolbar_li">
				<ul id="_nn_toolbar_page" class="nn_menu">
					<li class="nn_menu_option">Chọn trang</li>';
					for( $i = 0; $i < $total_page; $i++ ){
						$j = $i + 1;
						$html2 ='<li data-mod="product.product" data-page='."$i".' class="nn_menu_item">Trang '."$j".'</li>';
						echo $html2;
					}
				echo '</ul>
			</li>
			<li class="nn_toolbar_li"><input type"text" id="_nn_search_product" class="nn_text nn_font_medium" placeholder="Nhập tên sản phẩm" /></li>
		</ul>';
	echo '
	<table class="nn_table nn_col_12">
	<tbody>
		<tr class="nn_tr_header">
			<td class="nn_td_large">Tên đồng hồ</td>
			<td>Giá ( VNĐ )</td>
			<td class="nn_aln_center">Giảm giá ( VNĐ )</td>
			<td class="nn_td_number">Tổng số</td>
			<td class="nn_td_number">Đã bán</td>
			<td>Biên tập</td>
		</tr>
		';
		foreach ($pro_array as $key => $value) {
			$cate_info = $product -> get_cate_from_id( $value['id'] );
			$x = "";
			$y = "";
			foreach($cate_info as $key1 => $value1){
				$x = $value1['name_cate'];
				$y = $value1['id_cate'];
			}
			$html1=
			'<tr>
				<td>
					<input id="name'.$value['id'].'" type="text" readonly class="nn_text" value="'.$value['ten'].'" />
				</td>
				<td class="nn_aln_right">
					<input id="price'.$value['id'].'" type="number" readonly class="nn_text" value="'.$value['price'].'" />
				</td>
				<td class="nn_aln_right">
					<input id="discount'.$value['id'].'" type="number" readonly class="nn_text" value="'.$value['discount'].'" />
				</td>
				<td class="nn_aln_center">
					<input id="total'.$value['id'].'" type="number" readonly class="nn_text" value="'.$value['total'].'" />
				</td>
				<td class="nn_aln_center">
					<input id="bought'.$value['id'].'" type="number" readonly class="nn_text" value="'.$value['bought'].'" />
				</td>
				<td class="nn_td_editor">
					<button class="nn_icon nn_icon_detail" title="Chi tiết"></button>
					<button class="nn_icon nn_icon_edit" title="Chỉnh sửa"></button>
					<button class="nn_icon nn_icon_save nn_hide" title="Lưu" data-id="'.$value['id'].'"></button>
					<button class="nn_icon nn_icon_delete" title="Xóa"></button>
					<div class="nn_confirm nn_hide">
						<div class="nn_confirm_item">
							<span>Bạn muốn xóa <br>" '.$value['ten'].' "</span>
							<button class="nn_confirm_ok" data-id="'.$value['id'].'">ok</button>
							<button class="nn_confirm_cancel">cancel</button>
						</div>
					</div>			
				</td>
			</tr>
			<tr class="nn_hide">
				<td colspan="6">
					<table class="nn_col_12 nn_table_child">
						<tr class="nn_tr_header">
							<td class="nn_table_td_medium">Hình ảnh</td>
							<td class="nn_table_td_large">Thể loại</td>
							<td class="nn_table_td_large">Miêu tả</td>
							<td class="nn_table_td_medium">Ngày nhập</td>
						</tr>
						<tr>
							<td class="nn_table_td_medium">
								<img id="image'. $value['id'] .'" src="' .$value['image']. '" />
								<form enctype="multipart/form-data">
									<label class="nn_edit_file nn_hide" for="_nn_edit_file'. $value['id'] .'">Chọn ảnh</label>
									<input name="edit_file" type="file" accept="image/*" id="_nn_edit_file' . $value['id'] .'" class="nn_input_file nn_hide" />
								</form>
							</td>
							<td>
								<select id="cate'. $value['id'] .'" class="nn_select" disabled>
									<option value="'. $y .'">'. $x .'</option>'
									 .$html_cate. '
								</select>
							</td>
							<td><textarea id="discribe'.$value['id'].'" readonly class="nn_text">'.$value['discribe'].'</textarea>
							</td>
							<td><input id="date'.$value['id'].'" type="text" readonly class="nn_text" value="'.$value['date'].'" />
							</td>
						</tr>					
					</table>
				</td>
			</tr>';
		echo $html1;
		}
	echo '
	</tbody>
</table>';
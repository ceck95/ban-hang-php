<?php
	require_once( '../../autoload.php' );
	$product = new product( HOST, USER, PASS, DBNAME );
	$cate = $product -> get_cate();
	$total = count( $cate ) + 1;
	$html1 ='	
<div id="_nn_div_add_cate" class="nn_fl nn_col_4">
	<label id="_nn_label_add_cate">Nhập tên thể loại</label>
	<input id="_nn_input_add_cate" type="text" class="nn_text"></input>
	<button id="_nn_button_add_cate" data-stt="'. $total .'" title="Thêm thể loại">Thêm thể loại</button>
	<span id="_nn_span_add_cate" class="nn_hide" style="color: #FF530D">Vui lòng điền tên thể loại</span>
</div>';
	echo $html1;
	echo '
<table id="_nn_table_add_cate" class="nn_table nn_fr nn_col_8">
	<tbody>
		<tr class="nn_tr_header">
			<td>STT</td>
			<td>Thể loại</td>
			<td>Số sản phẩm</td>
			<td>Biên tập</td>
		</tr>';
		foreach ($cate as $key => $value) {
			$stt = $key+=1;
			$soluong = $product -> num_on_cate( $value['id'] );
		$html2 = '
		<tr>
			<td>'.$stt.'</td>
			<td><input type="text" class="nn_text" readonly value="'. $value['ten'] .'"></input></td>
			<td>'. $soluong .'</td>
			<td>
				<button data-category="'.$value['id'].'" class="nn_icon nn_icon_edit" title="Chỉnh sửa"></button>
				<button data-category="'.$value['id'].'" class="nn_icon nn_icon_save nn_hide" title="Lưu"></button>
				<button data-category="'.$value['id'].'" class="nn_icon nn_icon_delete" title="Xóa"></button>
				<div class="nn_confirm nn_hide">
					<div class="nn_confirm_item">
						<span>Bạn muốn xóa <br>" '.$value['ten'].' "</span>
						<button class="nn_confirm_ok" data-category="'.$value['id'].'">ok</button>
						<button class="nn_confirm_cancel">cancel</button>
					</div>
				</div>
			</td>
		</tr>';
		echo $html2;
		}
	echo '
	</tbody>
</table>';
?>
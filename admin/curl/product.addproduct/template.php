<?php
	require_once( '../../autoload.php' );
	$product = new product( HOST, USER, PASS, DBNAME );
	$cate_select = $product -> get_cate();
	$html_cate = "";
	foreach ($cate_select as $key => $value_cate_info) {
		$html_cate = $html_cate .
		'<option value="'. $value_cate_info['id'] .'">'. $value_cate_info['ten'] .'</option>
					';
	}
	echo '
<table class="nn_col_12 nn_table">
	<tr class="nn_tr_header">
		<td colspan="2" class="nn_aln_center">Thêm sản phẩm mới</td>
	</tr>';
	$html = '
	<tr>
		<td align="left" class="nn_col_3">Tên đồng hồ</td>
		<td align="left" class="nn_col_9"><input type="text" id="_nn_addproduct_name"></td>
	</tr>
	<tr>
		<td align="left" class="">Thể loại</td>
		<td align="left">
			<select id="_nn_addproduct_cate" class="nn_select">
				<option value="">Chọn thể loại</option>
				'. $html_cate .'
			</select>
		</td>
	</tr>
	<tr>
		<td align="left">Giá</td>
		<td align="left"><input id="_nn_addproduct_price" type="number"></input></td>
	</tr>
	<tr>
		<td align="left">Giảm giá</td>
		<td align="left"><input id="_nn_addproduct_discount" type="number"></input></td>
	</tr>
	<tr>
		<td align="left">Mô tả</td>
		<td align="left"><input type="text" id="_nn_addproduct_discribe"></td>
	</tr>	
	<tr>
		<td align="left">Chi tiết</td>
		<td align="left"><div id="_nn_addproduct_detail"></div></td>
	</tr>
	<tr>
		<td align="left">Số lượng</td>
		<td align="left"><input type="number" id="_nn_addproduct_total"></input></td>
	</tr>
	<tr>
		<td align="left">Ngày nhập</td>
		<td align="left"><input type="date" id="_nn_addproduct_date"></input></td>
	</tr>
	<tr>
		<td align="left">Hình ảnh</td>
		<td align="left">
			<img class="nn_hide" id="_nn_addproduct_image" src="" />
			<form enctype="multipart/form-data">
				<label class="nn_edit_file" for="_nn_add_file">Chọn ảnh</label>
				<input name="edit_file" type="file" accept="image/*" id="_nn_add_file" class="nn_input_file nn_hide" />
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="2"><button id="_nn_addproduct_button">OK</button></td>
	</tr>';
	echo $html;
echo '
</table>';
?>
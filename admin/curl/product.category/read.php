<?php 
	require_once( '../../autoload.php' );
	$product = new product(HOST, USER, PASS, DBNAME);
	if( isset( $_POST['id_cate'] ) && $_POST['action'] == 'update_cate' ){
		$sql = "UPDATE tbl_categories SET n_name = '". $_POST['name_cate'] ."' WHERE id = '". $_POST['id_cate'] ."' ";
		$product -> insert_update_delete( $sql );
	}

	if( isset( $_POST['id_del'] ) && $_POST['action'] == 'delete' ){
		$sql = " DELETE FROM tbl_categories WHERE id = '". $_POST['id_del'] ."'; ";
		$product -> insert_update_delete( $sql );
	}
	
	if( isset( $_POST['name_cate'] ) && $_POST['action'] == 'add_cate' ){
		$id_max = $product -> add_category( $_POST['name_cate'] );
		$cate = $product -> get_cate();
		$total = count( $cate );
		$soluong = $product -> num_on_cate( $id_max );
		$html = '
		<tr>
			<td>'.$total.'</td>
			<td><input type="text" class="nn_text" readonly value="'. $_POST['name_cate'] .'"></input></td>
			<td>'. $soluong .'</td>
			<td>
				<button data-category="'.$id_max.'" class="nn_icon nn_icon_edit" title="Chỉnh sửa"></button>
				<button data-category="'.$id_max.'" class="nn_icon nn_icon_save nn_hide" title="Lưu"></button>
				<button class="nn_icon nn_icon_delete" title="Xóa"></button>
				<div class="nn_confirm nn_hide">
					<div class="nn_confirm_item">
						<span>Bạn muốn xóa <br>" '.$_POST['name_cate'].' "</span>
						<button class="nn_confirm_ok" data-category="'.$id_max.'">ok</button>
						<button class="nn_confirm_cancel">cancel</button>
					</div>
				</div>
			</td>
		</tr>
		';
		echo $html;
	}
?>
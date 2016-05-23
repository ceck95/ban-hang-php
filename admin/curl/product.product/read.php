<?php
	require_once( '../../autoload.php' );
	$product = new product(HOST, USER, PASS, DBNAME);
	if( isset( $_POST['id_save'] ) && $_POST['action'] == 'save' ){
		$sql = " UPDATE `tbl_product` SET n_name = '". $_POST['name'] ."', n_id_categories = '". $_POST['cate'] ."', n_price = '". $_POST['price'] ."', n_discount = '". $_POST['discount'] ."', n_discribe = '". $_POST['discribe'] ."', n_bought = '". $_POST['bought'] ."', n_total = '". $_POST['total'] ."', n_date = '". $_POST['date'] ."' WHERE id = '". $_POST['id_save'] ."'; ";
		$product -> insert_update_delete( $sql );
		
		if( isset( $_FILES['edit_file']['tmp_name'] ) ){
			$name_image = '/img/NN_' . time() . '.png';
			$upload_dir = ROOT;
			move_uploaded_file( $_FILES['edit_file']['tmp_name'], $upload_dir . $name_image );
			$sql = " UPDATE tbl_product SET n_image = '". $name_image ."' WHERE id = '". $_POST['id_save']."'; ";
			$product -> insert_update_delete( $sql );
		}
	}
	else if( isset( $_POST['id_del'] ) && $_POST['action'] == 'delete' ){
		$sql = " DELETE FROM tbl_product WHERE id = '". $_POST['id_del'] ."'; ";
		$product -> insert_update_delete( $sql );
	}
?>
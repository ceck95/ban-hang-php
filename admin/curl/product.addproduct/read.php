<?php
	require_once( '../../autoload.php' );
	$product = new product( HOST, USER, PASS, DBNAME );
	if( isset( $_FILES['add_file']['tmp_name'] ) && $_POST['action'] == 'addproduct' ){
		$name_image = '/img/NN_' . time() . '.png';
		echo $name_image;
		echo $name = $_POST['name'];
		echo $cate = $_POST['cate'];
		echo $price = $_POST['price'];
		echo $discount = $_POST['discount'];
		echo $discribe = $_POST['discribe'];
		echo $detail = $_POST['detail'];
		echo $total = $_POST['total'];
		echo $date = $_POST['date'];
		$upload_dir = ROOT;
		move_uploaded_file( $_FILES['add_file']['tmp_name'], $upload_dir . $name_image );
		$sql = 'INSERT INTO tbl_product (n_name, n_id_categories, n_price, n_discount, n_discribe, n_detail, n_total, n_date, n_image) VALUES ("'. $name .'", "'. $cate .'", "'. $price .'", "'. $discount .'", "'. $discribe .'", "'. htmlentities ($detail) . '", "'. $total .'", "'. $date .'", "'. $name_image .'");';
		$product -> insert_update_delete( $sql );
	}
?>
<?php 
	include 'controller/db_connect.php';
	$id = $_POST['id'];
	$cart_id = $_COOKIE['cart_id'];
	mysqli_query($con,"delete from tbl_cart where cart_id = '$cart_id' and n_id_product = '$id'");
	$sql_count_pro = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
	$count_pro = mysqli_num_rows($sql_count_pro);
	$tong = 0;
	while($row_product = mysqli_fetch_array($sql_count_pro)){
		$product = $row_product['n_id_product'];
		$query_price = mysqli_query($con,"select * from tbl_product where id = '$product'");
		$row_price = mysqli_fetch_array($query_price);
		$tong += $row_product['n_count']*$row_price['n_price'];
	}
	header('Content-Type: application/json');
	header('Content-Type: application/json');
	$data = array( 'delete' => 'success','id'=>$id,'cart_id'=>$cart_id,'count_product' => $count_pro,'sum' => $tong);
	echo json_encode($data);
?>
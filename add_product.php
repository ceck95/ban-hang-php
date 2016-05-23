<?php 
	include 'controller/db_connect.php';
	$product_id = $_GET['id'];
	$cart_id = $_COOKIE['cart_id'];
	$check = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id' and n_id_product = '0' and n_count = '0'");
	$count = mysqli_num_rows($check);
	$checkupcount = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id' and n_id_product = '$product_id'");
	$upcount = mysqli_num_rows($checkupcount);
	if($count == 1 ){
		mysqli_query($con,"update tbl_cart set n_id_product='$cart_id' ,n_count='1' where cart_id = '$cart_id' and n_id_product = '0' and n_count = '0'");
	}elseif($upcount == 1){
		$row_checkcount = mysqli_fetch_array($checkupcount);
		$countlast = $row_checkcount['n_count'];
		$countup = $row_checkcount['n_count']+1;
		mysqli_query($con,"update tbl_cart set n_id_product='$product_id' ,n_count='$countup' where cart_id = '$cart_id' and n_id_product = '$product_id' and n_count = '$countlast'");
	}else{
		    $id = mysqli_query($con,"select max(id) as id from tbl_cart");
		    $row = mysqli_fetch_array($id);
		    $id_max = $row['id'] + 1;
			mysqli_query($con,"insert into tbl_cart(id,cart_id,n_id_user,n_id_product,n_count) values('$id_max','$cart_id','null','$product_id','1')");
	}
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
	$data = array( 'message' => 'success', 'count_product' => $count_pro,'sum' => $tong );
	echo json_encode($data);
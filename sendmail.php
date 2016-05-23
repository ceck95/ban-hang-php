<?php
include 'controller/db_connect.php';
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$phone = $_POST['phone']; 
$a = $_POST['nd'];
$to      = $email;
$subject = 'Đơn giá mua hàng của bạn'.$fullname;
$message = $a;
$headers = 'From: travannhut4495@gmail.com' . "\r\n" ."Content-type:text/html;charset=UTF-8" . "\r\n"."MIME-Version: 1.0" . "\r\n".
    'Reply-To: travannhut4495@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
$cart_id = mysqli_query($con,"select max(id) as maxid from tbl_order");
$row = mysqli_fetch_array($cart_id);
$cart_id = $_COOKIE['cart_id'];
$tong = 0;
$sql_count_pro = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
while($row_product = mysqli_fetch_array($sql_count_pro)){
	$product = $row_product['n_id_product'];
	$query_price = mysqli_query($con,"select * from tbl_product where id = '$product'");
	$row_price = mysqli_fetch_array($query_price);
	$tong += $row_product['n_count']*$row_price['n_price'];
}
$order_id_max = $row['maxid'] + 1;
if($row['maxid']==null){
    $order_id_max = 1;
}
mysqli_query($con,"insert into tbl_order (id,cart_id,n_price,email,phone,address) values ('$order_id_max','$cart_id','$tong','$email','$phone','$address')");
mysqli_query($con,"delete from tbl_cart where cart_id = '$cart_id'");
setcookie('cart_id', $cart_id, time() - (86400 * 30), "/");
header('Content-Type: application/json');
$data = array( 'message' => 'success' );
echo json_encode($data);
?>

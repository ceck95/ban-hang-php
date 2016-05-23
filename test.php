<?php 

include 'controller/db_connect.php';
$cart_id = $_COOKIE['cart_id'];
$query = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
$sql_count_pro = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
$count_pro = mysqli_num_rows($sql_count_pro);
$tong = 0;
while($row_product = mysqli_fetch_array($sql_count_pro)){
	$product = $row_product['n_id_product'];
	$query_price = mysqli_query($con,"select * from tbl_product where id = '$product'");
	$row_price = mysqli_fetch_array($query_price);
	$tong += $row_product['n_count']*$row_price['n_price'];
}
$text=array("text");
?><table border="1px"><tr>
    <th>Product ID</th>
    <th>So luong</th>
    <th>Don gia</th>
  </tr><?php
while($row = mysqli_fetch_array($query)){
	$query1 = mysqli_query($con,"select * from tbl_product where id = ".$row['n_id_product']."");
	$row2 = mysqli_fetch_array($query1);
	echo "<tr><td>".$row2['n_name']."</td><td>".$row['n_count']."</td><td>$".$row2['n_price']."</td></tr>";
}

?>
<tr>
	<td>Tong tien</td>
	<td colspan="2">$<?php echo $tong ?></td>
</tr>
</table>

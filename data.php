<?php
require_once 'controller/db_connect.php';
$per_page = 8;
$id_cate = $_GET['id_cate'];
if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;

?>


<?php
$sql = mysqli_query($con,"select * from tbl_product where n_id_categories = $id_cate  limit $start,$per_page");
?>
<?php //if(mysql_num_rows($result1)>=1): ?>
<?php while($row_product = mysqli_fetch_array($sql)){ ?>
  <div class="col-md-3 col-sm-6">
	<div class="single-shop-product">
	    <div class="product-upper">
	        <img src="<?php echo $row_product['n_image'] ?>" alt="<?php $row_product['n_name'] ?>">
	    </div>
	    <h2><a href="single-product.php?id=<?php echo $row_product['id'] ?>"><?php echo $row_product['n_name'] ?></a></h2>
	    <div class="product-carousel-price">
	        <ins>$<?php echo $row_product['n_price'] ?></ins> <!-- <del>$<?php echo $row_product['n_discount'] ?></del> -->
	    </div>  
	     
	    <div class="product-option-shop">
	        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" onclick="addProduct('<?php echo $row_product['id'] ?>')">Add to cart</a>
	    </div>                       
	</div>
	</div>
<?php } ?>
<?php //endif; ?>
    <?php  include 'inc/header.php' ?>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4" id="data-search">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form class ="search-ax">
                            <input type="text" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <!-- Search -->
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $cart_id = $_COOKIE['cart_id'];
                                        $query = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
                                        while($row = mysqli_fetch_array($query)){
                                            $id = $row['n_id_product'];
                                            $query_pro = mysqli_query($con,"select * from tbl_product where id= '$id'");
                                            $row_pro = mysqli_fetch_array($query_pro);
                                    ?>
                                        <tr id="<?php echo $row['n_id_product'] ?>" class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" data-id = "<?php echo $row['n_id_product'] ?>" >×</a> 
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php echo $row_pro['n_image'] ?>"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html"><?php echo $row_pro['n_name'] ?></a> 
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">$<?php echo $row_pro['n_price'] ?></span> 
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="<?php echo $row['n_count'] ?>" min="0" step="1" data-id = "<?php echo $row_pro['id'] ?>">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">$<?php echo $row_pro['n_price']*$row['n_count'] ?></span> 
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Update Cart" name="update_cart" class="button">
                                                <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>                     
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    </div>

<?php  include 'inc/footer.php' ?>
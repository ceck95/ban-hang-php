<?php include 'inc/header.php' ;
    $cart_id = $_COOKIE['cart_id'];
    $sql_count_pro = mysqli_query($con,"select * from tbl_cart where cart_id = '$cart_id'");
    $count_pro = mysqli_num_rows($sql_count_pro);
    $tong = 0;
    while($row_product = mysqli_fetch_array($sql_count_pro)){
        $product = $row_product['n_id_product'];
        $query_price = mysqli_query($con,"select * from tbl_product where id = '$product'");
        $row_price = mysqli_fetch_array($query_price);
        $tong += $row_product['n_count']*$row_price['n_price'];
    }
?>
    
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
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <div class="checkout" name="checkout">
                            <div class="row">
                                <div class = "col-md-6">
                                <div id="customer_details" class="col2-set">
                                    <div class="col-12">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing Details</h3>
                                            <p id="billing_full_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">Full Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_first_name" name="billing_first_name" class="input-text ">
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                            </p>

                                            <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                                <input type="text" value="" placeholder="Apartment, suite, unit etc. (optional)" id="billing_address_2" name="billing_address_2" class="input-text ">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_email" name="billing_email" class="input-text ">
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                            </p>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <h3 id="order_review_heading">Your order</h3>
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="cart_item">
                                                <td class="product-name">
                                                    All Product</td>
                                                <td class="product-total">
                                                    <span class="amount"><?php echo $count_pro ?></span> </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">$<?php echo $tong ?></span>
                                                </td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>

                                                    Free Shipping
                                                    <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">$<?php echo $tong ?></span></strong> </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                    <div id="payment">

                                        <div class="form-row place-order pull-right">

                                            <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                 </div>
                                </div>
                            </div>

                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php' ?>
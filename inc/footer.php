   <div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Menu </h2>
                        <ul>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Order history</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Vendor contact</a></li>
                            <li><a href="#">Front page</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            <?php
                                    $sql_cate_name = mysqli_query($con,"select * from   tbl_categories");
                                    while($row_cate_name = mysqli_fetch_array($sql_cate_name)){
                                        ?><li><a href="index.php?view=shoppage&id_cate=<?php echo $row_cate_name['id'] ?>"><?php echo $row_cate_name['n_name']; ?></a></li><?php
                                    }
                                ?>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="../js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="../js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="../js/bxslider.min.js"></script>
	<script type="text/javascript" src="../js/script.slider.js"></script>
    <script type="text/javascript">
       function addProduct(product_id){
        $.ajax({
            type: "GET",
            url: "add_product.php?id="+product_id,
            success: function( data ) {
            $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.product-count').html(data.count_product);
            $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.cart-amunt').html('$'+data.sum);
            alert('Added');
            },
            error: function(){
                console.log("error addd");
            }
        });
    }

    $(".search-ax input[type='submit']").click(function(e){
        e.preventDefault();
        var key = $(".search-ax input[type='text']").val();
        $.ajax({
            type: "POST",
            url: "search.php",
            data: {'search': key }, 
            success: function( data ) {
                $('#list-search').remove();
                $('#data-search').append(data);
                $(".search-ax input[type='text']").val('');
            },
            error: function(){
                console.log("error addd");
            }
        });
    });
    $('.add_to_cart_button').click(function(){

        var count = $('.quantity input').val();
        var id = $('.add_to_cart_button').attr('data-id');
         $.ajax({
            type: "POST",
            url: "add_n.php",
            data: {'count': count,'id':id }, 
            success: function( data ) {
                $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.product-count').html(data.count_product);
                $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.cart-amunt').html('$'+data.sum);
                alert('Added');
                console.log(data);
            },
            error: function(){
                console.log("error addd");
            }
        });
    });
    $('.actions input[name="update_cart"]').click(function(e){
        e.preventDefault();
       $('.cart_item').each(function(){
        var count = parseInt($(this).find('.product-quantity input').val());
        var id = $(this).find('.product-quantity input').attr('data-id');
        if(count == 0 || isNaN(count) || count == null ){
            alert('Error');
            return false;
        }
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: "update_cart.php",
            data: {'count': count,'id':id }, 
            success: function( data ) {
                $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.product-count').html(data.count_product);
                $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.cart-amunt').html('$'+data.sum);
                $this.find('.product-subtotal span').html('$'+data.sumproduct);
            },
            error: function(){
                console.log("error addd");
            }
        });
       });

    });
    $('.remove').click(function(){
        var delete_id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: {'id':delete_id}, 
            success: function( data ) {
            $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.product-count').html(data.count_product);
            $('body > div.site-branding-area > div > div > div:nth-child(2) > div > a > span.cart-amunt').html('$'+data.sum);
            $('#'+delete_id).remove();
            },
            error: function(){
                console.log("error addd");
            }
        });
    });
    $('#place_order').click(function(e){
        e.preventDefault();
        var fullname = $('#billing_full_name_field input').val();
        var address = $('#billing_address_2_field input').val();
        var email = $('#billing_email_field input').val();
        var phone = $('#billing_phone_field input').val();
        var nd = $('.shop_table').html();
        var mess = '<table class="shop_table">'+nd+'</table>';
        if(fullname==""||address==""||email==""||phone==""){
            alert("Chưa điền dữ liệu");
        }else{
            $('.place-order input').val('ORDERING');
            $.ajax({
                type: "GET",
                url: "test.php",
                success: function( data ) {
                    getne(data);
                },
                error: function(){
                    console.log("error addd");
                }
            });
            function getne(mua){
                var lay = mua;
                  $.ajax({
                    type: "POST",
                    url: "sendmail.php",
                    data: {'fullname':fullname,'address':address,'email':email,'phone':phone,'nd':lay},
                    success: function( data ) {
                        $('.place-order input').val('Place order');
                        window.location.href = "/";
                    },
                    error: function(){
                        console.log("error addd");
                    }
                });
            }
        }
    });
    $('.actions input[value="Checkout"]').click(function(e){
        e.preventDefault();
        window.location.href = "/checkout.php";
    });
    </script>
  </body>
</html>
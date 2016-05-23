    <?php include 'inc/header.php';
        include 'controller/db_connect.php';
        $product_id = $_GET['id'];
        $query = mysqli_query($con,"select * from tbl_product where id = '$product_id'");
        $check = mysqli_num_rows($query);
        if($check  == 0){
            echo "error";
        }
        else {
            $row = mysqli_fetch_array($query);  
    ?>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
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
                        <div class="product-breadcroumb">
                            <a href="">Home</a>
                            <a href=""><?php 
                            $id_category = $row['n_id_categories'];
                            $query_categroy = mysqli_query($con,"select * from tbl_categories where id = '$id_category'");
                            $row_category = mysqli_fetch_array($query_categroy);
                            echo $row_category['n_name'];
                             ?></a>
                            <a href=""><?php echo $row['n_name'] ?></a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="<?php echo $row['n_image'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $row['n_name'] ?></h2>
                                    <div class="product-inner-price">
                                        <ins>$<?php echo $row['n_price'] ?></ins>
                                    </div>    
                                    
                                    <div class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <button data-id = "<?php echo $row['id'] ?>" class="add_to_cart_button">Add to cart</button>
                                    </div>   
                                    </br>
                                    <div class="product-inner-category">
                                        <p>Category: <a href=""><?php echo $row_category['n_name'] ?></a>
                                    </div> 
                                    
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <?php echo $row['n_detail'] ?>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Categories Products</h2>
                            <div class="related-products-carousel">
                            <?php $query_pro_cate = mysqli_query($con,"select * from tbl_product where n_id_categories = '$id_category'"); 
                            while($row_pro_cate = mysqli_fetch_array($query_pro_cate)){
                            ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo $row_pro_cate['n_image'] ?>" alt="">
                                        <div class="product-hover">
                                            <a onclick="addProduct('<?php echo $row_pro_cate['id'] ?>')" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="single-product.php?id=<?php echo $row_pro_cate['id'] ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href=""><?php echo $row_pro_cate['n_name'] ?></a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$<?php echo $row_pro_cate['n_price'] ?></ins>
                                    </div> 
                                </div>  
                            <?php } ?>         
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <?php }
    include 'inc/footer.php' ?>

<?php 
include 'controller/db_connect.php';
$nameSearch = $_POST['search'];
    $query = mysqli_query($con,"select * from tbl_product where n_name like '%$nameSearch%'");
    if(mysqli_num_rows($query) == 0){
        exit();
    }
    else{
        ?>
    <div class="single-sidebar" id="list-search">
    <h2 class="sidebar-title">Products</h2><?php
    while($row = mysqli_fetch_array($query)){
  ?>                  
    <div class="thubmnail-recent">
        <img src="<?php echo $row['n_image'] ?>" class="recent-thumb" alt="">
        <h2><a href=""><?php echo $row['n_name'] ?></a></h2>
        <div class="product-sidebar-price">
            <ins><?php echo $row['n_price'] ?></ins>
        </div>                             
    </div>
    <?php }
    ?>
    </div><?php
    } ?>

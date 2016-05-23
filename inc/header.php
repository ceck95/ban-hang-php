<?php 
    ini_set('display_errors',0);
    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
    require_once("{$base_dir}controller{$ds}db_connect.php");
    $view = $_GET['view'];
    $active = $_SERVER[REQUEST_URI];


    if(!isset($_COOKIE['cart_id'])) {
        $cart_id = mysqli_query($con,"select max(cart_id) as maxid from tbl_cart");
        $id = mysqli_query($con,"select max(id) as id from tbl_cart");
        $row = mysqli_fetch_array($cart_id);
        $row_id = mysqli_fetch_array($id);
        $cart_id_max = $row['maxid'] + 1;
        $id_max = $row['id'] + 1;
        if($row['maxid']==null){
            $cart_id_max = 1;
        }
        // mysqli_query($con,"insert into tbl_cart (id,cart_id,n_id_user,n_id_product,n_count) values ('$id_max','$cart_id_max','null','null','null')");
        setcookie('cart_id', $cart_id_max, time() + (86400 * 30), "/");
    }



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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora Demo</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/responsive.css">
  <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.php"><i class="fa fa-user"></i> Checkout</a></li>
                        </ul>
                    </div>
                </div>
<!--                 
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="../img/logo.png"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt">$<?php echo $tong ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $count_pro ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li <?php if($view == null && $active == '/index.php') { ?> class="active"<?php } ?> ><a href="index.php">Home</a></li>
                        <li class="cate-t dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">Category</span><b class="caret"></b></a>
                                <ul class="dropdown-menu cate">
                                <?php
                                    $sql_cate_name = mysqli_query($con,"select * from   tbl_categories");
                                    while($row_cate_name = mysqli_fetch_array($sql_cate_name)){
                                        ?><li class="hover_cate"><a href="index.php?view=shoppage&id_cate=<?php echo $row_cate_name['id'] ?>"><?php echo $row_cate_name['n_name']; ?></a></li><?php
                                    }
                                ?>
                                </ul>
                        </li>
                        <li <?php if($view == null && $active == '/cart.php') { ?> class="active"<?php } ?> ><a href="cart.php">Cart</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="index.php?view=search">Search</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
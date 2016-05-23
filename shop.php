<?php  include 'controller/db_connect.php'; ?>
    <div class="search-background1">
            <label><img src="load.gif" alt="" /></label>
    </div>
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
            <div class="row" id="resn">
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <?php
                             $query=mysqli_query($con,"select count(*) as tot from tbl_product");
                             $count = mysqli_fetch_array($query);
                              $tot=$count['tot'];
                              $page=1;
                              $ipp=8;//items per page
                              $totalpages=ceil($tot/$ipp);
                              echo"<ul class='pagination'>";
                             for($i=1;$i<=$totalpages; $i++)
                                      {
                                          echo"<li class='$i'><a>$i</a></li>";
                                      }
                           ?>
<!--                             <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li> -->
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
      //show loading bar
    function showLoader1(){
        $('.search-background1').fadeIn(200);
    }
    //hide loading bar
    function hideLoader1(){
        $('.search-background1').fadeOut(200);
    }   
    $(".pagination li").click(function(){
        //show the loading bar
        showLoader1();
        $(".pagination li").removeClass('active');      
        $(this).addClass("active");              
        $("#resn").load("data.php?page=" + $(this).text(), hideLoader1);
    });
    
    // by default first time this will execute
    $(".1").addClass("active");
    $("#resn").load("data.php?page=1&id_cate=<?php echo $_GET['id_cate'] ?>",hideLoader1);
</script>
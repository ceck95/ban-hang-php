<?php
require_once 'libs/global.inc.php';
$per_page = 3;

if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;

?>


<?php
$sql = mysqli_query($con,"select * from tbl_product limit $start,$per_page");
?>
<?php //if(mysql_num_rows($result1)>=1): ?>
<?php while($row1 = mysqli_fetch_array($sql)){ ?>
    <div class="indent1 unline" >
        <h3 class="c3title" style="text-transform: uppercase;"><a style="text-decoration: none;" href="#"><?php echo$row1['id']; ?></a></h3><br/>
        <h4>Date:<?php echo$row1['n_name']; ?> </h4>
        <p><?php $dis=str_split($row1['n_id_categories'],100); echo$dis[0]; ?></p>
         
    </div>

<?php } ?>
<?php //endif; ?>
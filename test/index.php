 <?php
require_once 'libs/global.inc.php';
 ?>
 <html>
 <head>
 <link rel="stylesheet" href="style.css"/>
 <script src='jquery.js' type="text/javascript"></script>
 </head>
 <body>
 <div class="search-background1">
			<label><img src="load.gif" alt="" /></label>
	</div>
 <div id="news" class="tabcon">
	<h2 class="c2title">NEWS</h2><br/>
	
	<div id="resn"></div>

	
	<div id="pagesn">
		<?php
		 $query=mysqli_query($con,"select count(*) as tot from tbl_product");
		 $count = mysqli_fetch_array($query);
		  $tot=$count['tot'];
		  $page=1;
		  $ipp=3;//items per page
		  $totalpages=ceil($tot/$ipp);
		  echo"<ul class='pages'>";
		  for($i=1;$i<=$totalpages; $i++)
		  {
			  echo"<li class='$i'>$i</li>";
		  }
		  echo"</ul>";
		?>
	</div>
</div>

<script type="text/javascript" src="ajax1.js"></script>

</body>
</html>
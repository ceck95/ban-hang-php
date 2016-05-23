<?php
	require_once( 'autoload.php' );
	session_start();
	$account = new account( HOST, USER, PASS, DBNAME );
	if( !isset( $_SESSION['name'] ) ) $_SESSION['name'] = time();
	$account -> check_session_login();
$html = '<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<link rel="icon" href="css/images/ico-min.png" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/login.css">

</head>
<body>
	<section class="login_main">
		<!--form action="curl/login/read.php" method="post"-->
		<div>
			<h3> LOGIN </h3>
			<input class="info" type="text" placeholder="Tên đăng nhập" name="user_info" />
			<input class="info" type="password" placeholder="Mật khẩu" name="user_password" />
			<button id="_login_submit" name="log" >Đăng nhập</button>
			<input type="checkbox" value="yes" name="keep_cookie" id="keep_cookie" checked="checked" />
			<label for="keep_cookie">Lưu phiên đăng nhập</label>
		<!--/form-->
		</div>
	</section>
	<script src="js/jquery-2.1.4.js"></script>
	<script src="js/login.js"></script>
</body>
</html>';
echo $html;
?>
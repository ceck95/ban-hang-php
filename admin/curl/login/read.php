<?php 
	require_once( '../../autoload.php' );
	session_start();
	$account = new account( HOST, USER, PASS, DBNAME );
	if( isset( $_POST['user_info'] ) && $_POST['action'] == "log" )
		$r = $account -> check_info( $_POST['user_info'], $_POST['user_password'] );
	if( $r == 1 ){
		$_SESSION['name'] = "NN_PROJECT";
		//$account -> check_session_login();
	}
	else{
		$_SESSION['name'] = time();
		//$account -> check_session();
	}
	echo $_SESSION['name'];
?>
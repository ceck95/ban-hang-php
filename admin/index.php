<?php 
	require_once( 'autoload.php' );
	session_start();
	$account = new account( HOST, USER, PASS, DBNAME);
	$account -> check_session();
	$view = new View();
	$view -> get_template('head', TPL );
	$view -> get_template( 'header', TPL );
	$view -> get_template( 'sidebar', TPL );
	$view -> get_template( 'container', TPL );
	$view -> get_template( 'footer', TPL );

?>
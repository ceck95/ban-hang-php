<?php
	require_once( '../../autoload.php' );
	$cart = new cart( HOST, USER, PASS, DBNAME );
	if( isset( $_POST['id_del'] ) && $_POST['action'] == "delete" )
		$cart -> delete_order( $_POST['id_del'] );
?>
<?php
	require_once( 'autoload.php' );
	session_start();
	session_destroy();
	header( "location: ../index.php" );
?>
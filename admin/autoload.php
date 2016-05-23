<?php 
	require_once( 'config.php' );
	spl_autoload_register( function ( $class ){
		$class = strtolower( $class );
		$path1 = CLS . $class . '.cls.php';
		file_exists( $path1 );
		require_once( $path1 );
	} );
?>
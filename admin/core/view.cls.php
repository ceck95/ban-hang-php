<?php  
	require_once( 'ysexception.cls.php' );
	class View{
		public function get_template( $filename, $folder ){
			$file = $folder . '/' . ( string )$filename . '.tpl.php';
			if( file_exists( $file ) ) {
				include_once $file;
				return true;
			}
			else {
				throw new ysexception( 'file not available: ' .$file, 700000 );
				return false;
			}
		}
	}
?>
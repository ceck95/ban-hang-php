<?php
	/**
	* 
	*/
	class account extends Database
	{
		
		function __construct( $host, $user, $pass, $dbname )
		{
			parent::__construct( $host, $user, $pass, $dbname );
		}
		public function check_session(){
			if( $_SESSION['name'] != "NN_PROJECT" )
				header( "location: ../admin/login.php");
		}
		public function check_session_login(){
			if( $_SESSION['name'] == "NN_PROJECT" )
				header( "location: ../../index.php" );
			else return false;
		}
		public function check_info( $user, $pass ){
			$sql = "SELECT * FROM tbl_user WHERE n_name = :n_name AND n_pass = :n_pass;";
			$conn = parent::get_connection();
			$array1 = array( ':n_name' => $user,
							':n_pass' => md5( $pass )
						);
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute( $array1 );
			$r = $query -> rowCount();
			if( $r > 0 ) return 1;
			else return 0;
		}
	}
?>
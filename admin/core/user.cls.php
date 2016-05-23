<?php
	/**
	* xu ly User
	*/
	class user extends Database
	{
		
		function __construct( $host, $user, $pass, $dbname )
		{
			parent::__construct( $host, $user, $pass, $dbname );
		}
		public function get_user(){
			$sql = " SELECT * FROM tbl_user ORDER BY n_level ASC;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array('id' => $r['id'],
								'name' => $r['n_name'],
								'fullname' => $r['n_realname'],
								'date' => $r['n_birth'],
								'sex' => $r['n_sex'],
								'phone' => $r['n_phone'],
								'email' => $r['n_email'],
								'level' => $r['n_level']
							);
				array_push( $array, $temp );
			}
			return $array;
		}
		public function get_user_page( $page, $user_in_page ){
			$page = $page * $user_in_page;
			$sql = "SELECT * FROM tbl_user ORDER BY n_level ASC limit $page, $user_in_page";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array('id' => $r['id'],
								'name' => $r['n_name'],
								'fullname' => $r['n_realname'],
								'date' => $r['n_birth'],
								'sex' => $r['n_sex'],
								'phone' => $r['n_phone'],
								'email' => $r['n_email'],
								'level' => $r['n_level']
							);
				array_push( $array, $temp );
			}
			return $array;			
		}
		public function search_user( $name ){
			$sql = "SELECT * FROM tbl_user WHERE n_name LIKE'%" . $name . "%';";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array('id' => $r['id'],
								'name' => $r['n_name'],
								'fullname' => $r['n_realname'],
								'date' => $r['n_birth'],
								'sex' => $r['n_sex'],
								'phone' => $r['n_phone'],
								'email' => $r['n_email'],
								'level' => $r['n_level']
							);
				array_push( $array, $temp );
			}
			return $array;
		}
		public function get_level( $x ){
			if( $x == 1 ) return "Admin";
			if( $x == 2 ) return "User";
			else return false;
		}
		public function get_sex( $x ){
			if( $x == 1 ) return "Nam";
			if( $x == 0) return "Nữ";
			else return 0;
		}
		public function update_delete_user( $x ){
			$sql = $x;
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$r = $query -> execute();
			return $r;
		}
	}
?>
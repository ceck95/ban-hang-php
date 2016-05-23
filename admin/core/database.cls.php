<?php  
	class Database {
		public function __construct( $host, $user, $pass, $dbname ){
			$this -> host = $host;
			$this -> user = $user;
			$this -> pass = $pass;
			$this -> dbname = $dbname;
		}
		public function get_connection(){
			$connection = new PDO( 'mysql:host=' . $this -> host . ';dbname=' . $this -> dbname, $this -> user, $this -> pass );
			$connection -> exec( 'set names utf8' );
			$connection -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			return $connection;
		}
	}
?>
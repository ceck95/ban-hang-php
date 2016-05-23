<?php
	/**
	* cart
	*/
	class cart extends Database
	{
		
		function __construct( $host, $user, $pass, $dbname )
		{
			parent::__construct( $host, $user, $pass, $dbname );
		}
		public function get_cart(){
			$sql = " SELECT * FROM tbl_cart; ";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array(	'id' => $r['id'],
								'cart_id' => $r['cart_id'],
								'id_user' => $r['n_id_user'],
								'id_product' => $r['n_id_product'],
								'count' => $r['n_count']
							);
				array_push( $array, $temp );
			}
			return $array;
		}
		public function get_cart_page( $page, $cart_in_page ){
			$page = $page * $cart_in_page;
			$sql = "SELECT * FROM tbl_cart ORDER BY cart_id ASC limit $page, $cart_in_page";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array(	'id' => $r['id'],
								'cart_id' => $r['cart_id'],
								'id_user' => $r['n_id_user'],
								'id_product' => $r['n_id_product'],
								'count' => $r['n_count']
							);
				array_push( $array, $temp );
			}
			return $array;
		}
		public function get_user_by_idcart( $cart_id ){
			$sql = " SELECT * FROM tbl_user AS t1 JOIN tbl_cart AS t2 ON t1.id = t2.n_id_user WHERE t2.cart_id = :cart_id;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$array1 = array( ':cart_id' => $cart_id );
			$query -> execute( $array1 );
			$r = $query-> fetch( PDO::FETCH_ASSOC );
			$array = array( 'name' => $r['n_name'],
								'phone' => $r['n_phone']
							);
			return $array;
		}
		public function get_product_by_idcart( $cart_id ){
			$sql = "SELECT * FROM tbl_product AS t1 JOIN tbl_cart AS t2 ON t1.id = t2.n_id_product WHERE t2.cart_id = :cart_id;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$array1 = array( ':cart_id' => $cart_id );
			$query -> execute( $array1 );
			$r = $query -> fetch( PDO::FETCH_ASSOC );
				$array = array( 'name_product' => $r['n_name'],
								'price' => $r['n_price']
							);
			return $array;
		}
		public function delete_cart( $cart ){
			$sql = " DELETE FROM tbl_cart WHERE id = :id;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$array1 = array( ':id' => $cart );
			$r = $query -> execute( $array1 );
			return $r;
		}
		/*
		|_tbl Order
		*/
		public function get_order(){
			$sql = " SELECT * FROM tbl_order; ";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array(	'order_id' => $r['id'],
								'cart_id' => $r['cart_id'],
								'date' => $r['n_date']
								
							);
				array_push( $array, $temp );
			}
			return $array;			
		}
		//paging
		public function get_order_page( $page, $order_in_page ){
			$page = $page * $order_in_page;
			$sql = "SELECT * FROM tbl_order ORDER BY id ASC limit $page, $order_in_page;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute();
			$array = array();
			while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array(	'order_id' => $r['id'],
								'cart_id' => $r['cart_id'],
								'date' => $r['n_date']
								
							);
				array_push( $array, $temp );
			}
			return $array;	
		}
		public function delete_order( $order ){
			$sql = " DELETE FROM tbl_order WHERE id = :id;";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$array1 = array( ':id' => $order );
			$r = $query -> execute( $array1 );
			return $r;
		}
	}
?>
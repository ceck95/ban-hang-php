 <?php  
	/**
	* sql xử lý product
	*/
	class product extends Database
	{
		
		function __construct($host, $user, $pass, $dbname)
		{
			parent::__construct( $host, $user, $pass, $dbname );
		}
		public function insert_update_delete( $s ){
			$sql = $s;
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$r = $query -> execute();
			return $r;
		}
		public function get_product(){
			$sql = "SELECT * FROM tbl_product ORDER BY n_date DESC";
			$conn = parent::get_connection();
			$query = $conn -> prepare($sql);
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp  = array(	'id' => $r['id'],
								'ten' => $r['n_name'],
								'theloai' => $r['n_id_categories'],
								'discribe' => $r['n_discribe'],
								'price' => $r['n_price'],
								'discount' => $r['n_discount'],
								'bought' => $r['n_bought'],
								'total' => $r['n_total'],
								'date' => $r['n_date'],
								'image' => $r['n_image']
				);
				array_push( $array, $temp );
			}
			return $array;
		}
		
		public function get_product_page( $page, $pro_in_page ){
			$page = $page * $pro_in_page;
			$sql = "SELECT * FROM tbl_product ORDER BY n_date DESC limit $page, $pro_in_page";
			$conn = parent::get_connection();
			$query = $conn -> prepare($sql);
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp  = array(	'id' => $r['id'],
								'ten' => $r['n_name'],
								'cate' => $r['n_id_categories'],
								'discribe' => $r['n_discribe'],
								'price' => $r['n_price'],
								'discount' => $r['n_discount'],
								'bought' => $r['n_bought'],
								'total' => $r['n_total'],
								'date' => $r['n_date'],
								'image' => $r['n_image']
				);
				array_push( $array, $temp );
			}
			return $array;
		}
		//lay the loai theo id san pham
		public function get_cate_from_id( $id ){
			$sql = "SELECT * FROM tbl_product AS t1 JOIN tbl_categories AS t2 ON t1.n_id_categories = t2.id WHERE t1.id = :id";
			$array1 = array(
					':id' => $id
				);
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute( $array1 );
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array(
							'id_cate' => $r['id'],
							'name_cate' => $r['n_name']
					);
				array_push( $array, $temp);
			}
			return $array;
		}




		public function search_product( $name ){
			$sql = "SELECT * FROM tbl_product WHERE n_name LIKE'%" . $name . "%'";
			$conn = parent::get_connection();
			$query = $conn -> prepare($sql);
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp  = array(	'id' => $r['id'],
								'ten' => $r['n_name'],
								'cate' => $r['n_id_categories'],
								'discribe' => $r['n_discribe'],
								'price' => $r['n_price'],
								'discount' => $r['n_discount'],
								'bought' => $r['n_bought'],
								'total' => $r['n_total'],
								'date' => $r['n_date'],
								'image' => $r['n_image']
				);
				array_push( $array, $temp );
			}
			return $array;
		}

		//lay the loai
		public function get_cate(){
			$sql = "SELECT * FROM tbl_categories ORDER BY id ASC";
			$conn = parent::get_connection();
			$query = $conn -> prepare($sql);
			$query -> execute();
			$array = array();
			while ( $r = $query -> fetch( PDO::FETCH_ASSOC ) ){
				$temp = array( 'id' => $r['id'],
								'ten' => $r['n_name']
					);
				array_push( $array, $temp );
			}
			return $array;
		}
		//so luong moi the loai
		public function num_on_cate( $id ){
			$sql = "SELECT * FROM tbl_product AS t1 JOIN tbl_categories AS t2 ON t1.n_id_categories = t2.id WHERE t2.id = :id";
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$query -> execute( array(
				':id' => $id
			));
			$r = $query->rowCount();
			return $r;
		}

		//add category
		public function add_category( $name ){
			$sql = "INSERT INTO `tbl_categories`(`n_name`) VALUES (:name)";
			$array = array(
					':name' => $name
				);
			$conn = parent::get_connection();
			$query = $conn -> prepare( $sql );
			$r = $query -> execute( $array );
			return $conn -> lastInsertId();			
		}
		


	}
?>
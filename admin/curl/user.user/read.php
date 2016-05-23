<?php
	require_once( '../../autoload.php' );
	$user = new user( HOST, USER, PASS, DBNAME );
	if( isset( $_POST['id_save'] ) && $_POST['action'] == "save" ){
		$sql = "UPDATE tbl_user SET n_name = '". $_POST['name'] ."', n_phone = '". $_POST['phone'] ."', n_level = '". $_POST['level'] ."', n_birth = '". $_POST['date'] ."', n_sex = '". $_POST['sex'] ."', n_email = '". $_POST['email'] ."', n_realname = '". $_POST['fullname'] ."' WHERE id = '". $_POST['id_save'] ."'; ";
		$user -> update_delete_user( $sql );
	}
	else if( isset( $_POST['id_del'] ) && $_POST['action'] == "delete" ){
		$sql = " DELETE FROM tbl_user WHERE id = '". $_POST['id_del'] ."';";
		$user -> update_delete_user( $sql );
	}
?>
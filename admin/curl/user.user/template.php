<?php
	require_once( '../../autoload.php' );
	$user = new user( HOST, USER, PASS, DBNAME );
	$info = $user -> get_user();
	// paging
	$total_user = count( $info );
	$user_in_page = 1;
	$total_page = floor($total_user / $user_in_page);
	//phan trang
	if( ( $total_user % $user_in_page ) > 0 )
		$total_page++;
	if( !isset( $_POST['id_page'] ) )
		$_POST['id_page'] = 0;
	$info = $user -> get_user_page( $_POST['id_page'], $user_in_page );
	// search user
	if( isset( $_POST['keyword']) && $_POST['action']  == 'search' ){
		$info = $user -> search_user( $_POST['keyword'] );
	}
	echo '
<ul class="nn_toolbar">
	<span class="nn_toolbar_title">Công cụ</span>
	<li class="nn_toolbar_li">
		<ul id="_nn_toolbar_page" class="nn_menu">
			<li class="nn_menu_option">Chọn trang</li>';
			for( $i = 0; $i < $total_user; $i++ ){
				$j = $i + 1;
	$html2 ='<li data-mod="user.user" data-page='."$i".' class="nn_menu_item">Trang '."$j".'</li>';
				echo $html2;
			}
	echo 
		'</ul>
	</li>
	<li class="nn_toolbar_li"><input type"text" id="_nn_search_user" class="nn_text nn_font_medium" placeholder="Nhập tên thành viên" />
	</li>
</ul>
<table class="nn_col_12 nn_table">
	<tr class="nn_tr_header">
		<td>Thành viên</td>
		<td>Tên thành viên</td>
		<td>Ngày sinh</td>
		<td>Giới tính</td>
		<td>SĐT</td>
		<td>Email</td>
		<td>Cấp bậc</td>
		<td>Biên tập</td>
	</tr>';
	foreach ( $info as $key => $value) {
	$html = '
	<tr>
		<td><input class="name" type="text" value="'. $value['name'] .'" readonly /></td>
		<td><input class="fullname" type="text" value="'. $value['fullname'] .'" readonly /></td>
		<td><input class="date" type="date" value="'. $value['date'] .'" readonly /></td>
		<td><select class="nn_select sex" disabled>
				<option value="'. $value['sex'] .'">'. $user -> get_sex( $value['sex'] ) .'</option>
				<option value="0">Nữ</option>
				<option value="1">Nam</option>
			</select>
		</td>
		<td><input class="phone" type="text" value="'. $value['phone'] .'" readonly /></td>
		<td><input class="email" type="text" value="'. $value['email']. '" readonly /></td>
		<td>
			<select class="nn_select level" disabled>
				<option value="'. $value['level'] .'">'. $user -> get_level( $value['level'] ) .'</option>
				<option value="1">Admin</option>
				<option value="2">Thành viên</option>
			</select>
		</td>
		<td>
			<button class="nn_icon nn_icon_edit" title="Chỉnh sửa"></button>
			<button class="nn_icon nn_icon_save nn_hide" data-save="'. $value['id'] .'" title="Lưu"></button>
			<button class="nn_icon nn_icon_delete" title="Xóa"></button>
			<div class="nn_confirm nn_hide">
					<div class="nn_confirm_item">
						<span>Bạn muốn xóa <br>" '.$value['name'].' "</span>
						<button class="nn_confirm_ok" data-user="'.$value['id'].'">ok</button>
						<button class="nn_confirm_cancel">cancel</button>
					</div>
			</div>
		</td>
	</tr>';
	echo $html;
	}
	echo '
</table>';
?>
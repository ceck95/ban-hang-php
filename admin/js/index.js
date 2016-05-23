$( document ).ready( function(){
	$( '#_nn_toggle').on( 'click', function(){
		$( '#_nn_in_sidebar' ).toggleClass( 'nn_active' );
		$( '#_nn_in_container' ).toggleClass( 'nn_active' );
		$( '.nn_sidebar_item p' ).toggleClass( 'nn_hide' );
		$( this ).toggleClass( 'nn_active' );
	} )
	$( '.nn_sidebar_item' ).on( 'click', function(){
		var _id = $( this ).prop( 'id' );
		$( this ).parent().children().removeClass( 'nn_active' );
		$( this ).parent().children().children().removeClass( 'nn_active' );
		$( '#' + _id ).addClass( 'nn_active' );
		$( '#' + _id + ' span').addClass( 'nn_active' );
		var HtmlLoading = "<div id='_nn_loading'></div>";
		$.ajax({
			url: 'include/' + _id + '.inc.php',
			type: 'POST',
			beforeSend: function(){
				$( '#_nn_in_container' ).html( HtmlLoading );
			},
			success: function(data){
				$( '#_nn_in_container' ).html( data );
			}
		})
	} )
	$('#product').click();

} )
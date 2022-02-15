
// move slider
function move_slider( control, correct, offset ) {
	var slider = control.closest( '.slider_outer' ).find( '.slider' );
	var next_control = control.parent().find( '.slider_next' );
	var prev_control = control.parent().find( '.slider_prev' );
	var slide_count = slider.children().length;
	var slide_width = slider.children().outerWidth( true );
	var reverse = slider.data( 'reverse' );
	var rows = slider.data( 'rows' );
	var rows_m = slider.data( 'rowsM' );
	var end_cols = slider.data( 'endCols' );
	var end_cols_m = slider.data( 'endColsM' );
	var col_count = ( window.matchMedia( '(max-width: 500px)' ).matches ) ? ( Math.ceil( slide_count / rows_m ) - ( end_cols_m - 1 ) ) : ( Math.ceil( slide_count / rows ) - ( end_cols - 1 ) );
	var position = parseInt( slider.attr( 'data-position' ) );
	var is_next = control.hasClass( 'slider_next' );
	is_next = reverse ? ! is_next : is_next;
	var new_position = position + ( is_next ? 1 : -1 );
	new_position = ( offset !== undefined ) ? position + offset : new_position;
	new_position = correct ? position : new_position;
	new_position = ( new_position >= col_count ) ? ( col_count - 1 ) : new_position;
	var move_by = slide_width * new_position;
	move_by = reverse ? move_by : - move_by;
	if ( new_position < col_count && new_position >= 0 ) {
		slider.css( 'transform', 'translateX(' + move_by + 'px)' ).attr( 'data-position', new_position );
		var start = new_position == 0;
		var end = new_position >= ( col_count - 1 );
		if ( ! start && reverse || ! end && ! reverse )
			next_control.addClass( 'active' );
		if ( start && reverse || end && ! reverse )
			next_control.removeClass( 'active' );
		if ( ! end && reverse || ! start && ! reverse )
			prev_control.addClass( 'active' );
		if ( end && reverse || start && ! reverse )
			prev_control.removeClass( 'active' );
	}
	if ( col_count <= 1 )
		next_control.add( prev_control ).removeClass( 'active' );
}
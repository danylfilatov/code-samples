<?php

add_action( 'after_setup_theme', function() {
	register_nav_menu( 'primary', 'Главное меню' );
} );

add_action( 'after_setup_theme', function() {
	register_nav_menu( 'secondary', 'Второе меню' );
} );

add_action( 'wp_nav_menu_item_custom_fields', function( $item_id, $item, $depth, $args, $id ) {
	if ( $depth === 0 ) {
		echo '<p class="description description-wide"><label>Ссылка на иконку пункта меню<br><input type="text" class="widefat" name="menu-item-icon[' . $item_id . ']" value="' . get_post_meta( $item_id, '_menu_item_icon', true ) . '"><span class="description">(опционально)</span></label></p>';
	}
	if ( $depth === 1 && in_array( 'services', get_post_meta( (int) $item->menu_item_parent, '_menu_item_classes', true ) ) )
		echo '<p class="description description-wide"><label>Ссылка на картинку услуги<br><input type="text" class="widefat" name="menu-item-image[' . $item_id . ']" value="' . get_post_meta( $item_id, '_menu_item_image', true ) . '"></label></p>';
}, 10, 5 );

add_action( 'wp_update_nav_menu_item', function( $menu_id, $menu_item_db_id ) {
	if ( isset( $_POST[ 'menu-item-icon' ][ $menu_item_db_id ] ) )
		update_post_meta( $menu_item_db_id, '_menu_item_icon', $_POST[ 'menu-item-icon' ][ $menu_item_db_id ] );
	if ( isset( $_POST[ 'menu-item-image' ][ $menu_item_db_id ] ) )
		update_post_meta( $menu_item_db_id, '_menu_item_image', $_POST[ 'menu-item-image' ][ $menu_item_db_id ] );
}, 10, 2 );

if ( PLL_ON ) {
	$strings = [
		'footer_t' => [
			'Заголовок футера',
			'footer'
		],
		'footer_tx' => [
			'Краткий текст футера',
			'footer'
		],
		'footer_c_t' => [
			'Текст "Контакты"',
			'footer'
		],
		'footer_cf' => [
			'Шорткод контактной формы',
			'footer'
		],
		'footer_cp_t' => [
			'Текст копирайта',
			'footer'
		],
		'footer_pp_t' => [
			'Текст ссылки на страницу политики конфиденциальности',
			'footer'
		],
		'footer_pp_l' => [
			'Ссылка на страницу политики конфиденциальности',
			'footer'
		],
		'services_back' => [
			'Текст "Все услуги"',
			'services'
		],
	];
	foreach( $strings as $name => $data ) {
		pll_register_string( $name, $data[ 0 ], $data[ 1 ] );
	}
}
<?php

add_shortcode( 'button', 'get_button_shortcode' );
function get_button_shortcode( $atts ) {
	$newtab = isset( $atts['newtab'] ) ?: false;
	$nowrap = isset( $atts['nowrap'] ) ?: false;
	$a = shortcode_atts( [
		'text' => '',
		'link' => '#',
		'class' => '',
	], $atts );
	return get_button( $a['text'], $a['link'], $newtab, $a['class'], $nowrap );
}

function get_button( $text, $link, $newtab = false, $class = '', $nowrap = false ) {
	$button = '<a class="button'.($class?' '.$class:'').'" href="'.$link.'"'.($newtab?' target="_blank"':'').'>'.$text.'</a>';
	if ( ! $nowrap )
		$button = '<div class="button-wrap">'.$button.'</div>';
	return $button;
}

function get_video( $image, $link ) {
	ob_start()
	?>
	<div class="video closed" data-closed>
		<?php
		if ( $link !== '' ):
			?>
			<div class="play_button">
				<div class="play_button_inner play"><?= get_svg( 'play_button' ); ?></div>
				<div class="play_button_inner close"><?= get_svg( 'close_button' ); ?></div>
			</div>
			<?php
		endif;
		?>
		<div class="video_inner bg" style="background-image:url(<?= wp_get_attachment_image_url( $image, 'full' ); ?>);">
			<?php
			if ( $link !== '' ):
				$video_handle = ( strpos( $link, 'youtu.be' ) === false ) ? explode( '?v=', $link )[ 1 ] : explode( 'youtu.be/', $link )[ 1 ];
				?>
				<div class="youtube_video closed" data-src="https://www.youtube.com/embed/<?= $video_handle; ?>">
					<iframe src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

function get_arrow_link( $text, $link, $newtab = false, $class = '', $wrap = false ) {
	$arrow_link = '<a class="arrow-link'.($class?' '.$class:'').'" href="'.$link.'"'.($newtab?' target="_blank"':'').'><span>'.$text.'</span><br>'.get_svg('green_arrow').'</a>';
	if ( $wrap )
		$arrow_link = '<div class="arrow-link-wrap">'.$arrow_link.'</div>';
	return $arrow_link;
}
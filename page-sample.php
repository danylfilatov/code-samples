<?php
get_header();
$c = get_post_custom( $post->ID );
organize_fields( $c );
?>
<main class="front_page">
	<?php if ( ! $c['1_bool'] ): ?>
		<section id="s1" class="bg cols">
			<div class="bg absolute_bg" style="background-image: url(<?= get_theme_mod( 'loader_bg' ); ?>);"></div>
			<div class="left">
				<div class="container">
					<div class="logo_mobile"><?= $site_logo; ?></div>
					<h1><?= $c['1_t']; ?></h1>
					<h3 class="special"><?= $c['1_st']; ?></h3>
					<?= get_button( $c['1_bt'], $c['1_bl'] ); ?>
					<div class="primary_menu primary_menu_mobile">
						<?= get_primary_menu( false, true ); ?>
					</div>
				</div>
			</div>
			<div class="right bg green_bg" style="background-image: url(<?= wp_get_attachment_image_url( $c['1_bg'], 'full' ); ?>);"></div>
			<div class="bottom_header">
				<div class="bottom_header_inner">
					<?php wp_nav_menu( [
						'menu' => 'secondary',
						'menu_class' => 'secondary_menu',
					] ); ?>
					<div class="social_header">
						<a href="<?= get_theme_mod( 'con_fb' ); ?>" target="_blank"><?= get_svg( 'fb_icon' ); ?></a>
						<a href="<?= get_theme_mod( 'con_ig' ); ?>" target="_blank"><?= get_svg( 'ig_icon' ); ?></a>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
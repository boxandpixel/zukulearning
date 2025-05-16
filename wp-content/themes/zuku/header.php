<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zuku
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/bwz0ahv.css">
	<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=ycp3lincgyy6ijapb5lgxg" async="true"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php
	$promo_banner = get_field('promo_banner', 'option');

	if (!empty($promo_banner['promo_banner'])) : ?>
		<div class="promo-banner">
			<p class="promo-banner__text"><?php echo esc_html($promo_banner['promo_banner']); ?></p>
		</div>
	<?php endif; ?>

	


	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zuku' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header__utility-menu">
			<?php 
				wp_nav_menu(
					array(
						'theme_location' => 'header-utility-menu',
						'menu_id'        => 'header-utility-menu',
					)
				);
			?>	
		</div>
	
	<div class="site-header__menu">
		<div class="container">
			<div class="site-header__branding-nav">
				<button class="site-header__menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<?php esc_html_e( 'Primary Menu', 'zuku' ); ?>
				</button>				
				<div class="site-header__branding">
					<?php the_custom_logo(); ?>
				</div><!-- .site-header__branding -->
				
				<div class="site-header__nav-group">
					<nav id="site-navigation" class="site-header__nav">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'menu_id'        => 'main-menu',
								'walker'         => new Walker_Nav_Menu_MegaMenu(),	
							)
						);
						?>
					</nav><!-- .site-header__nav -->

					<div class="site-header__utility-menu--mobile">
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'header-utility-menu',
									'menu_id'        => 'header-utility-menu',
								)
							);
						?>	
					</div>	
				</div>			
			</div>

			<div class="site-header__account-controls">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'account-controls-menu',
						'menu_id'        => 'account-controls-menu',
					)
				);
				?>
			</div>
		</div>

	</div>

	<!-- Demo buttons -->
	<!-- <a href="" class="button button--primary">Primary</a>
	<a href="" class="button button--primary-fill">Primary Fill</a>
	<a href="" class="button button--disabled">Disabled</a>
	<a href="" class="button button--disabled-fill">Disabled</a>
	<a href="" class="button button--secondary">Secondary</a> -->
</header><!-- #masthead -->


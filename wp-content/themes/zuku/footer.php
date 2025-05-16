<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zuku
 */

	$footer = get_field('footer', 'option');
	$zuku_logo_typeface = $footer['zuku_logo_typeface'];
	$zuku_logo = $footer['zuku_logo'];
	$social_icons = $footer['social_icons'];

	/** Get Menu Names */
	$locations = get_nav_menu_locations();

	/** Menu Name: Test Prep */
	$footer_test_prep_menu_id = $locations['footer-test-prep-menu']; 
	$footer_test_prep_menu = wp_get_nav_menu_object($footer_test_prep_menu_id);

	/** Menu Name: Continuing Education */
	$footer_continuing_education_menu_id = $locations['footer-continuing-education-menu']; 
	$footer_continuing_education_menu = wp_get_nav_menu_object($footer_continuing_education_menu_id);	

	/** Menu Name: About */
	$footer_about_menu_id = $locations['footer-about-menu']; 
	$footer_about_menu = wp_get_nav_menu_object($footer_about_menu_id);		

	/** Menu Name: Resources */
	$footer_resources_menu_id = $locations['footer-resources-menu']; 
	$footer_resources_menu = wp_get_nav_menu_object($footer_resources_menu_id);			
	
	
?>

	<footer id="colophon" class="site-footer">
		<div class="footer-content">
			<div class="footer-branding">
				<div class="footer-branding__logo">
					<img src="<?php echo esc_url($zuku_logo['url']); ?>" alt="<?php echo esc_url($zuku_logo['alt']); ?>">
				</div>
				<ul class="footer-branding__social">

					<?php foreach($social_icons as $item): 
						$social_icon = $item['social_icon'];
						$social_url = $item['social_url'];
					?>
					<li>
						<a href="<?php echo esc_url($social_url); ?>" target="_blank">
							<img src="<?php echo esc_url($social_icon['url']); ?>" alt="<?php echo esc_url($social_icon['alt']); ?>">
						</a>
					</li>
					<?php endforeach; ?>
						
				</ul>
			</div>
			<div class="footer-menus">

				<div class="footer-menus__menu footer-menus__menu--test-prep">
					<h5 class="footer-menu-title caption"><?php echo esc_html($footer_test_prep_menu->name); ?></h5>
					<?php 
						wp_nav_menu([
							'theme_location' => 'footer-test-prep-menu',
							'menu_id'        => 'footer-test-prep-menu',
						]);
					?>
				</div>

				<div class="footer-menus__menu footer-menus__menu--continuing-education">
					<h5 class="footer-menu-title caption"><?php echo esc_html($footer_continuing_education_menu->name); ?></h5>
					<?php 
						wp_nav_menu([
							'theme_location' => 'footer-continuing-education-menu',
							'menu_id'        => 'footer-continuing-education-menu',
						]);
					?>
				</div>

				<div class="footer-menus__menu footer-menus__menu--about">
					<h5 class="footer-menu-title caption"><?php echo esc_html($footer_about_menu->name); ?></h5>
					<?php 
						wp_nav_menu([
							'theme_location' => 'footer-about-menu',
							'menu_id'        => 'footer-about-menu',
						]);
					?>
				</div>

				<div class="footer-menus__menu footer-menus__menu--resources">
					<h5 class="footer-menu-title caption"><?php echo esc_html($footer_resources_menu->name); ?></h5>
					<?php 
						wp_nav_menu([
							'theme_location' => 'footer-resources-menu',
							'menu_id'        => 'footer-resources-menu',
						]);
					?>
				</div>

				<?php
					// Get the menu object using the theme location
					$theme_location = 'footer-resources-menu';
					$locations = get_nav_menu_locations();

					$contact_us_item = null;

					if (isset($locations[$theme_location])) {
						$menu_id = $locations[$theme_location];
						$menu_items = wp_get_nav_menu_items($menu_id);

						if ($menu_items) {
							foreach ($menu_items as $item) {
								if ($item->ID == 112) {
									$contact_us_item = $item;
									break;
								}
							}
						}
					}
					?>

					<?php if ($contact_us_item): ?>
						<div class="footer-menus__contact show-on-mobile">
							<ul class="menu">
								<li class="footer-resources-menu__contact-us menu-item--button menu-item--primary">
									<a href="<?php echo esc_url($contact_us_item->url); ?>">
										<?php echo esc_html($contact_us_item->title); ?>
									</a>
								</li>
							</ul>
						</div>
					<?php endif; ?>				

			</div>


		</div>

		<?php 
			wp_nav_menu(
				array(
					'theme_location' => 'footer-utility-menu',
					'menu_id'        => 'footer-utility-menu',
				)
			);
		?>	


		<?php if($zuku_logo_typeface): ?>
		<div class="footer-content__zuku-logo">
			<img src="<?php echo $zuku_logo_typeface['url']; ?>" alt="<?php echo $zuku_logo_typeface['alt']; ?>">
		</div>
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>
        <div id="foot">
<?php

$args = array(
        'theme_location' => 'foot-nav',
        'container_id' => 'foot-nav',
    );

wp_nav_menu( $args );

?>

<div id="copy">Copyright 2010 Victoria Dahlia Society</div>

        </div><!-- #foot -->
    </div><!-- #wrap -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
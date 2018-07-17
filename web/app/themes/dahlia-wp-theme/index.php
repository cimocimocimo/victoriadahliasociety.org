<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="side">
	<h1>
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	</h1>
<?php get_sidebar(); ?>
</div><!-- #side -->
<div id="main">
<?php

    $args = array(
            'theme_location' => 'top-nav',
            'container_id' => 'top-nav',
        );
	wp_nav_menu( $args );

?>
    <div id="content">
<?php

			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
    get_template_part( 'loop', 'index' );

?>
    </div><!-- #content -->
</div><!-- #main -->
<?php get_footer(); ?>
<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<ul id="side-nav">
<?php

$args = array(
        'hide_empty' => false,
        'title_li' => '',
        'depth' => 2,
    );

wp_list_categories( $args );

?>
</ul><!-- #side-nav -->

<hr />

<?php if ( dynamic_sidebar( 'primary-widget-area' ) ) : ?>
<hr />
<?php endif; // end sidebar widget area ?>

<p>
<a href="https://www.facebook.com/pages/Victoria-Dahlia-Society/122367134614421">Find us on Facebook</a>
</p>

<hr />

<div id="ads-badge">
    <p>Member of the ADS</p>

    <a href="http://www.dahlia.org/">
    <img src="<?php bloginfo('template_url'); ?>/images/american-dahlia-society-logo.png" alt="Logo of the American Dahlia Society" height="160" width="160" />
    </a>

</div>

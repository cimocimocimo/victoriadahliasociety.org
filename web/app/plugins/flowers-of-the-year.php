<?php
/*
Plugin Name: Flowers Of The Year
Description: Displays the current Flowers o the Year in a widget in the sidebar
Author: Aaron Cimolini
Version: 0.1
Author URI: http://cimolini.com/
*/


add_action( 'init', 'create_foty_taxonomies', 0 );
function create_foty_taxonomies(){
  $labels = array(
		  'name' => _x( 'Years', 'taxonomy general name' ),
		  'singular_name' => _x( 'Year', 'taxonomy singular name' ),
		  'search_items' =>  __( 'Search Years' ),
		  'all_items' => __( 'All Years' ),
		  'parent_item' => null,
		  'parent_item_colon' => null,
		  'edit_item' => __( 'Edit Year' ), 
		  'update_item' => __( 'Update Year' ),
		  'add_new_item' => __( 'Add New Year' ),
		  'new_item_name' => __( 'New Writer Year' ),
		  'separate_items_with_commas' => __( 'Separate years with commas' ),
		  'add_or_remove_items' => __( 'Add or remove years' ),
		  'choose_from_most_used' => __( 'Choose from the most used years' ),
		  'menu_name' => __( 'FOTY Years' ),
		  ); 

  register_taxonomy('foty_years','foty',array(
					  'hierarchical' => true,
					  'labels' => $labels,
					  'show_ui' => true,
					  'update_count_callback' => '_update_post_term_count',
					  'query_var' => true,
					  ));
}


add_action( 'init', 'create_foty_post_type' );
function create_foty_post_type() {
  register_post_type( 'foty',
		      array(
			    'labels' => array(
					      'name' => __( 'Flowers Of The Year' ),
					      'singular_name' => __( 'Flower Of The Year' )
					      ),
			    'public' => true,
			    'supports' => array(
						'title',
						'thumbnail',
						'page-attributes',
						),
			    )
		      );
}


class FOTY_Widget extends WP_Widget {

  function FOTY_Widget() {
    $widget_ops = array( 'classname' => 'foty_widget', 'description' => 'Displays the Flowers Of The Year' );
    
    $control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'foty-widget' );
    
    $this->WP_Widget( 'foty-widget', 'Flowers Of The Year Widget', $widget_ops, $control_ops );
  }

  function widget( $args, $instance ) {
    extract( $args );

    //Our variables from the widget settings.
    $year = $instance['year'];
    
    echo $before_widget;

    $args = array(
		  'post_type' => 'foty',
		  'tax_query' => array(
				       array(
					     'taxonomy' => 'foty_years',
					     'field' => 'slug',
					     'terms' => $year,
					     )
				       ),
		  'orderby' => 'menu_order',
		  
		  );
    $loop = new WP_Query( $args );

?>
<div id="foty">
    <h3>Flowers of the Year</h3>
    <div class="year"><?php echo $year; ?></div>
<?php

  while ( $loop->have_posts() ) : $loop->the_post();

?>
    <div class="photo">
       <?php the_post_thumbnail('thumbnail'); ?>
    </div>
       <h4><?php the_title(); ?></h4>
<?php

				    endwhile;
?>
</div>
<?php

    echo $after_widget;

  }                        // display the widget  
  
  //Update the widget 
   
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    //Strip tags from title and name to remove HTML 
    $instance['year'] = strip_tags( $new_instance['year'] );

    return $instance;
  }
  
  function form( $instance ) {

    //Set up some default widget settings.
    $defaults = array( 'year' => '2011', );
    $instance = wp_parse_args( (array) $instance, $defaults );

?>
<p>
 <label for="<?php echo $this->get_field_id( 'year' ); ?>"><?php _e('Year:', 'year'); ?></label>
    <input id="<?php echo $this->get_field_id( 'year' ); ?>" name="<?php echo $this->get_field_name( 'year' ); ?>" value="<?php echo $instance['year']; ?>" style="width:100%;" />
    </p>

    <?php
   }
  
}

function register_foty() {
  register_widget( 'FOTY_Widget' );
}

add_action( 'widgets_init', 'register_foty' ); // function to load my widget  

?>
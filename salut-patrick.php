<?php
/*
Plugin Name: Salut Patrick
Plugin URI: https://salutpatrick.fr
Description: Intégrez Salut Patrick sur votre blog Wordpress via ce super Widget !
Version: 1.0
Author: Cabioch Sébastien
Author URI: https://cabreseaux.fr
License: GPL2
Testé & Validé sur Wordpress 5.4
*/

// The widget class
class Salut_Patrick extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'salut_patrick',
			__( 'Salut Patrick', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
				'description' => 'Les contrepèteries de salutpatrick.fr sur votre blog.' 
			)
		);
	}

	// The widget form (for the backend )
	public function form( $instance ) {
		
		if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = "";
        }
		
		if (isset($instance['select_height'])) {
            $select_height = $instance['select_height'];
        } else {
            $select_height = "530";
        }
		
		if (isset($instance['select_width'])) {
            $select_width = $instance['select_width'];
        } else {
            $select_width = "100";
        }
		
		if (isset($instance['select_type'])) {
            $select_type = $instance['select_type'];
        } else {
            $select_type = "iframedujour";
        }
		
		// Set widget defaults
		$defaults = array(
			'title'    => $title,
			'select_height'   => $select_height,
			'select_width'   => $select_width,
			'select_type'   => $select_type,
		);
		
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) );
		
		
		 ?>

		<?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Titre du Widget', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<?php // Select for height ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select_height' ); ?>"><?php _e( 'Hauteur', 'text_domain' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select_height' ); ?>" id="<?php echo $this->get_field_id( 'select_height' ); ?>" class="widefat">
			
			<?php
			// Your options array
			$options = array(
				'530'        => __( 'Hauteur par défaut (530px)', 'text_domain' ),
				'410' => __( 'Hauteur de 410px', 'text_domain' ),
				'440' => __( 'Hauteur de 440px', 'text_domain' ),
				'470' => __( 'Hauteur de 470px', 'text_domain' ),
				'500' => __( 'Hauteur de 500px', 'text_domain' ),
				'560' => __( 'Hauteur de 560px', 'text_domain' ),
				'590' => __( 'Hauteur de 590px', 'text_domain' ),
				'620' => __( 'Hauteur de 620px', 'text_domain' ),
				'650' => __( 'Hauteur de 650px', 'text_domain' ),
				'680' => __( 'Hauteur de 680px', 'text_domain' ),
			);

			// Loop through options and add each one to the select dropdown
			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select_height, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
		</p>
		
		<?php // Select for Width ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select_width' ); ?>"><?php _e( 'Largeur', 'text_domain' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select_width' ); ?>" id="<?php echo $this->get_field_id( 'select_width' ); ?>" class="widefat">
			
			<?php
			// Your options array
			$options = array(
				'100'        => __( 'Largeur par défaut (100%)', 'text_domain' ),
				'50' => __( 'Largeur de 50%', 'text_domain' ),
				'60' => __( 'Largeur de 60%', 'text_domain' ),
				'70' => __( 'Largeur de 70%', 'text_domain' ),
				'80' => __( 'Largeur de 80%', 'text_domain' ),
				'90' => __( 'Largeur de 90%', 'text_domain' ),
				'120' => __( 'Largeur de 120%', 'text_domain' ),
				'150' => __( 'Largeur de 150%', 'text_domain' ),
			);

			// Loop through options and add each one to the select dropdown
			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select_width, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
		</p>
		
		<?php // Select Type ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select_type' ); ?>"><?php _e( "Type d'affichage", 'text_domain' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select_type' ); ?>" id="<?php echo $this->get_field_id( 'select_type' ); ?>" class="widefat">
			
			<?php
			// Your options array
			$options = array(
				'iframedujour'        => __( 'La contrepèterie du jour, livrée directement tous les matins', 'text_domain' ),
				'iframecarouseltop' => __( 'Caroussel des 5 meilleures contrepèteries du site', 'text_domain' ),
				'iframecarouselrandom' => __( 'Caroussel de 5 contrepèteries, au hasard', 'text_domain' ),
			);

			// Loop through options and add each one to the select dropdown
			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select_type, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
		</p>

	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['select_height']   = isset( $new_instance['select_height'] ) ? wp_strip_all_tags( $new_instance['select_height'] ) : '';
		$instance['select_width']   = isset( $new_instance['select_width'] ) ? wp_strip_all_tags( $new_instance['select_width'] ) : '';
		$instance['select_type']   = isset( $new_instance['select_type'] ) ? wp_strip_all_tags( $new_instance['select_type'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$select_height   = isset( $instance['select_height'] ) ? $instance['select_height'] : '';
		$select_width   = isset( $instance['select_width'] ) ? $instance['select_width'] : '';
		$select_type   = isset( $instance['select_type'] ) ? $instance['select_type'] : '';

		// WordPress core before_widget hook (always include )
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

			// Display widget title if defined
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
			// Display iframe
			if ( $select_height ) {
				echo'<iframe style="margin-top: 1.5em; margin-bottom: 1.5em; border: 0px none; width: '. $select_width .'%; height: '. $select_height .'px;" src="https://salutpatrick.fr/'. $select_type .'" frameborder="0" scrolling="no"></iframe>';
			}

		echo '</div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;

	}

}

// Register the widget
add_action('widgets_init', create_function('', 'return register_widget("Salut_Patrick");'));
<?php
	class CustomPosts extends WP_Widget {
		/* this sets up some basic stuff about our widget */
		public function __construct() {
			$widget_ops = array(
				'classname'=>'widget_customposts',
				'description'=>'A set number of posts from a custom post type.'
				  );
			/* defining the widget name */
			parent::__construct('customposts','Custom Posts', $widget_ops);
		}

		/* How the widget will display on the site */
		public function widget( $args, $instance ) {
			// defining title variable of widget
			// apply_filters clears out bad code that someone may have entered to break your code
			$title = apply_filters('widget_title', 
				empty($instance['title']) ? 'CPT Posts' :
				 $instance['title'], $instance, $this->id_base);

			echo $args['before_widget'];
			 if ( $title ) {
			 	echo $args['before_title'] . $title . $args['after_title'];
			 } ?>

			<ul id="cpt-widget">
			<?php
			// what main area of widget will display
			$my_query = new WP_Query(array( 'post_type'=> 'cp_design', 'posts_per_page' => 4,
			 'orderby' => 'date', 'order' => 'ASC') );
			if ($my_query->have_posts()):
				while ($my_query->have_posts()): $my_query->the_post(); ?>
				
				<li class="list-item">
					<!-- this shows the featured image of each post in the widget -->
					<?php the_post_thumbnail(); ?>
					<!-- this makes the title of the posts link to the full
					corresponding blog posts -->
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<p class="cpt-link"><?php the_title(); ?></p>
					</a>
				</li>
				
				<?php endwhile; wp_reset_postdata(); // resets Post Data
				endif; // ending the if-statement
				?>
			</ul>

			<?php
			echo $args['after_widget'];
		}

		/* How the widget looks in the back end */
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array(
			 	 'title'=>'') );
			 	 $title = strip_tags($instance['title']);
			 	 ?>

			 	 <p>
			 	 	<!-- giving the widget a label when it appears in the dashboard -->
			 	 	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cpt_plugin'); ?>
			 	 	</label>
			 	 		<!-- giving user option to define title of the widget as it will appear on the site -->
			 	 		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo 
			 	 		$this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			 	 </p>
			 	 <?php
		}

		/* This function sanitizes widget form values as they are saved */
		public function update( $new_instance, $old_instance ) {
			 	$instance = $old_instance;
			 	$new_instance = wp_parse_args( (array) $new_instance, array( 'title'
			 		=>'') );
			 	$instance['title'] = strip_tags($new_instance['title']);
			 	return $instance;
		}
	}
	// this displays the widget in the list of available widgets in the dashboard
	add_action( 'widgets_init', function() {
		register_widget( 'CustomPosts' );
	});


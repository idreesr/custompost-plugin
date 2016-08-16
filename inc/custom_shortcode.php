<?php

/* this shortcode function creates a related posts section for posts */
function rp_shortcode() {
	ob_start();
	// this code is based off of code from this: https://wordpress.org/support/topic/wp_query-based-on-the-current-post-categories
	// declaring $post as global first
	global $post;
	// making new custom query that displays related posts (via category)
	$this_post_category = wp_get_post_categories($post->ID);
	// assigning the $current to the current post's ID
	$current = $post->ID;
	?>
	<div class="related-posts">
		<h2>Related Posts</h2>
	<?php
	// using post__not_in to ensure it doesn't display the current post
	$new_query = new WP_Query(array( 'category__in'=> $this_post_category,
	 'post__not_in' => array($current), 'posts_per_page' => 4) );
	if ($new_query->have_posts()):
		while ($new_query->have_posts()): $new_query->the_post(); ?>
			<li class="rp-list">
				<!-- this makes the captions link to the full
				corresponding blog posts -->
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<p><?php the_title(); ?></p>
				</a>
			</li>
		<?php endwhile; wp_reset_postdata(); // resets Post Data
		endif; // ending the if-statement
		?>
	</div>
	<?php
	return ob_get_clean();
}
// this function adds a hook for a shortcode tag
add_shortcode( 'rp_shortcode', 'rp_shortcode' );

/* this shortcode function creates a signature */
/* this is an extra shortcode that I made */
function signature_shortcode($atts) {
	// sets a default signature
	// sets default signature font color, border color, and background color
	extract( shortcode_atts
		(array(
			'statement'=>'Thanks for reading,',
			'author'=>'Author',
			'colour'=>'#9EAD68',
			'background'=>'transparent',
			), $atts )
		);
	return '<style type="text/css">

			.signature {
				background-color: '.$background.';
				border-color: '.$colour.';
				color: '.$colour.';
			}

			</style>
	<div class="signature">' .$statement. '<br />' .$author. '</div>';
}
// this function adds a hook for a shortcode tag
add_shortcode( 'signature_shortcode', 'signature_shortcode' );

?>
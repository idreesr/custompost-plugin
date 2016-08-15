<?php

// this function creates a form for users to input information in
function form_shortcode($atts , $content=null) {
	extract( shortcode_atts
		(array(
			'email'=>'me@me.com',
			), $atts )
		);
	// returns a form that contains two small text boxes and one large text box
	// also contains a submit and reset form button
	return '<div class="form">
		<form action="mailto:'.$email.'" method="post" name="theform" class="theform" enctype="text/plain">
			<p>
				<label for="fullname">Name:</label>
				<br />
				<input name="fullname" type="text" id="fullname" tabindex="1" placeholder="Enter your name here" size="50" />
			</p>

			<p>
				<label for="email">Email Address:</label>
				<br />
				<input name="email" type="text" id="email" tabindex="6" placeholder="Enter your email" size="50" />
			</p>

			<p>
				<label for="userinput">Your concern here:</label>
				<br />
				<textarea name="usertext" id="usertext" rows="8" col="60"></textarea>
			</p>

			<p>
				<input name="submit" type="submit" value="Submit" tabindex="11" id="submit" />
				<input name="reset" type="reset" value="Reset Form" tabindex="12" id="reset" />
			</p>
		</form>
	</div>';

}
// this function adds a hook for a shortcode tag
add_shortcode( 'form_shortcode', 'form_shortcode' );

?>
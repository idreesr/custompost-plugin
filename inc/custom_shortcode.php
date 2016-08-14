<?php

// this function creates a form for users to input information in
function form_shortcode() {
	return '<div class="form">
		<form action="mailto:me@me.com" method="post" name="theform" class="theform">
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
add_shortcode( 'form_shortcode', 'form_shortcode' );

?>
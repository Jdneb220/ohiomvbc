<!DOCTYPE HTML>

<html>
	<head>
		<title>Ohio Midwest Volleyball Club</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>

	
	

		<!-- Content -->
			<div id="content">
				<div class="inner">
					  <header>
								<nav id="nav2">
									<?php	require ('nav.php');?>
								</nav><br clear=all>
                      </header>
					<!-- Post -->
						<article class="box post post-excerpt">
						
					<?php
								if (isset($_POST['submit'])) {
									$name = $_POST['name'];
									$email = $_POST['email'];
									$message = $_POST['message'];
									$message = $message . "\nPhone:" . $_POST['phone'];
									$from = 'Ohio MVBC Website';
									$to = 'ohiomvbc@gmail.com'; 
									$subject = 'Message from Ohio MVBC';
									
									$body = "From: $name\n E-Mail: $email\n Message:\n $message";
							 
									// Check if name has been entered
									if (!$_POST['name']) {
										$errName = 'Please enter your name';
									}
									
									// Check if email has been entered and is valid
									if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
										$errEmail = 'Please enter a valid email address';
									}
									
									//Check if message has been entered
									if (!$_POST['message']) {
										$errMessage = 'Please enter your message';
									}

							 
									// If there are no errors, send the email
									if (!$errName && !$errEmail && !$errMessage) {
										if (mail ($to, $subject, $body, $from)) {
											echo '<h2>Thank You! We will be in touch!</h2>';
											$hideForm = true;
										} else {
											echo '<h2>Something went wrong with mailing this form.  Please try again later.</h2>';
										}
									}
									else{
										echo '<h2>Oops!  Your form was missing some info.</h2>';
									}
									
								}
								else
								{
										echo '<h2>Contact Ohio MVBC</h2>';
								}
							?>						
							<form method="post" id="contactform" name="contactform" action="" onsubmit="return confirmAndSend();"  class="STYLE-NAME"
							<?php if ($hideForm) { echo "style='display:none'"; }?>>
								<label style="margin-bottom:1em">
									<span>Your Name:</span>
									<input id="name" type="text" name="name" placeholder="Your Full Name"/>
								</label>
								
								<label style="margin-bottom:1em">
									<span>Your Email:</span>
									<input id="email" type="email" name="email" placeholder="Valid Email Address"/>
								</label>
								
								<label style="margin-bottom:1em">
									<span>Message:</span>
									<textarea id="message" name="message" placeholder="Your Message to Us"></textarea>
								</label style="margin-bottom:1em"> 
								
								<label>
									<span>Phone Number:</span>
									<input id="phone" type="text" name="phone" placeholder="Your Phone Number"/>
								</label>
   
								<div class="g-recaptcha" data-sitekey="6LeZ3Q0TAAAAAHdEzWmoE699877MzS0PHeGxO1q9"></div>	
									
							     <p align=right>
								 <input type="submit" name="submit" class="button" value="Send" /> </p>
		
							</form>
						</article>


				</div>
			</div>

			<script>
			function confirmAndSend(){
				if(grecaptcha.getResponse() == "")
				{
					alert("Please click the recaptcha!");
					return false;
				}
				else
					return true;
			}
			</script>
		<?php	require ('sidebar.php');?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
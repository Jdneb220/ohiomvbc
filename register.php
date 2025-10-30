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

									$name = $name . " " . $_POST['lastname'];

									$email = $_POST['email'];

									$message = $_POST['message'];

									$message = $message . "\nPhone: " . $_POST['phone'];

									$message = $message . "\nTeam Name: " . $_POST['teamname'] . "\nDivision: " . $_POST['teamdiv'];

									$from = 'Ohio MVBC Website';

									$to = 'ohiomvbc@gmail.com'; 

									$subject = 'Tournament Registration from Ohio MVBC';

									

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

										echo '<h2>Tournament Registration</h2>';

								}

							?>						

							<form method="post" id="contactform" name="contactform" action="" onsubmit="return confirmAndSend();"  class="STYLE-NAME"

							<?php if ($hideForm) { echo "style='display:none'"; }?>>

							

							<label>

									<span>Which tournament are you registering for?</span>

									<select id="message" name="message">

									<option value="">Choose a tournament...</option>

							<?php

							  require ('db_json.php');

							  $rows = getAllUpcomingTournaments();
							  foreach ($rows as $row) {
								echo "<option value='" . htmlspecialchars($row['Name']) . " (" . htmlspecialchars($row['StartDate']) . ")'>"  . htmlspecialchars($row['Name']) . " (" . tournamentShortDateFormat($row['StartDate']) . ")</option>";
							  }

							?>

							</select>

							</label>





								<label>

									<span>Your Name:</span>

									<table><tr><td>

									<input id="name" type="text" name="name" placeholder="First Name"/ style=""></td><td><input id="lastname" type="text" name="name" placeholder="Last Name"/ style=""></td></tr></table>

								</label>

								

								

								<label>

									<span>Team Info:</span>

									<table><tr><td width=66%>

									<input id="teamname" type="text" name="teamname" placeholder="Team Name"/></td><td>

									<select id="teamdiv" name="teamdiv">

									<option value="">Choose a division...</option>

									<option value="AA">AA</option>

									<option value="A">A</option>

									<option value="BB">BB</option>

									<option value="B">B</option>

									<option value="Higher">Higher</option>

									<option value="Lower">Lower</option>

									</select>

									</td></tr></table>

									

								</label>

								

								<label>

									<span>Your Email:</span>

									<input id="email" type="email" name="email" placeholder="Valid Email Address"/>

								</label>

								

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
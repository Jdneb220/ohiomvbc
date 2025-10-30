<!DOCTYPE HTML>



<html>

	<head>

		<title>Ohio Midwest Volleyball Club</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->

		<link rel="stylesheet" href="../assets/css/main.css" />

		<!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->

	</head>

	<body style="margin:40px;">

	<!-- Content -->







					

							

							<?php 

									$pwd = $_POST["password"]; 

									if ($pwd <> "discipline") {

								?>

								<!-- Post -->

						<article class="box">

							<header>

															<h2>Ohio MVBC Admin</h2>	

							</header>



								<form action="index.php" method="post" style="">





								<table><tr><td align=center valign=middle>

									<label for="password">

									<span>Password:</span>

											<input type="password" name="password" id="password" value="" autocomplete="off">

								</label>

							</td></tr><tr><td align=center valign=middle>

							

							<input type="submit" name="submit" class="button" value="Login" />

							</td></tr></table>

							

							</form>

							</article>

							

							<?php

							   }

							   else {

							   require ('../db_json.php');

							   ?>

							   <!-- Post -->

								<article class="box">

									<header>

										<h2>Welcome!  What do you need to do?</h2>	

									</header>

									

									<table><tr><td>

									<form action="tournaments.php" method="post">

									<input type="submit" name="submit" class="button" value="Edit Tournaments" />

									<input type="hidden" name="password" value="<? echo $pwd;?>">

									</form>

									</td><td>

									<form action="locations.php" method="post">

									<input type="submit" name="submit" class="button" value="Edit Locations" />

									<input type="hidden" name="password" value="<? echo $pwd;?>">

									</form>

									</td></tr></table>

								</article>

							   <?php

							   }

							 ?>				



	 </body>

 </html>
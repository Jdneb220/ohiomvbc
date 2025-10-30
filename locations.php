<!DOCTYPE HTML>



<html>

	<head>

		<title>Ohio Midwest Volleyball Club</title>

		<meta charset="utf-8" />

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->

		<link rel="stylesheet" href="assets/css/main.css" />

		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

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

<?php

				  require ('db_json.php');

				  $locations = getAllLocations();
				  foreach ($locations as $row) {

?>

						<!-- Post -->

						<article class="box">

							<header>

								<h2><a href="<?php echo $row[URL];?>"><?php echo $row[Name];?></a></h2>

								<p><?php echo $row[Address];?></p>

							</header>



							

							<a href="https://goo.gl/maps/Br5oD" class="image featured"><iframe src="https://maps.google.it/maps?q=<?php echo $row[Address]; ?>&output=embed" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe></a>



						</article>

<?php

						}

?>



					







				</div>

			</div>



		

		<?php	require ('sidebar.php');?>



		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>

			<script src="assets/js/skel.min.js"></script>

			<script src="assets/js/util.js"></script>

			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->

			<script src="assets/js/main.js"></script>



	</body>

</html>
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



					<!-- Post -->

						<article class="box">

							<header>



								<a href="#" class="image featured"><img src="images/pic02.png" alt="" /></a>						

								<nav id="nav2">

									<?php	require ('nav.php');?>

								</nav>

								<br clear=all>

							</header>


							

						<?php
							require ('db_json.php');

							$upcoming = false;
							$tourneys = getUpcomingTournaments(2);
							if (!empty($tourneys)){
								foreach ($tourneys as $row) {
									$upcoming = true;
							?>

							<!-- Post -->
							<article class="box post post-excerpt">

								<header>

									<p><a href="tournament.php?ID=<?php echo htmlspecialchars($row['ID']);?>"><?php echo htmlspecialchars($row['Name']);?></a> at <?php echo htmlspecialchars($row['Venue']);?></p>

								</header>

								<div class="info">

									<span class="date"><?php tournamentDateFormat($row['StartDate']); ?></span>

									<ul class="stats">

									<li><a href="register.php">Sign Up</a></li>

									</ul>

									<ul class="stats">

										<li><a href="https://www.facebook.com/groups/824257927695800/events/" target=_blank class="icon fa-facebook">Event Page on Facebook</a></li>

									</ul>

								</div>

								<a href="https://goo.gl/maps/Br5oD" class="image featured"><iframe src="https://maps.google.it/maps?q=<?php echo urlencode($row['Address']); ?>&output=embed" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe></a>
								<p>
									<?php echo htmlspecialchars($row['Details']); ?>
								</p>
							</article>
							<?php
								}
							} else {
							?>
							<article class="box post post-excerpt">
							<p>No upcoming tournaments scheduled at this time, check back later!</p>
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

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
							
							<p>
								<strong>Hello!</strong> Welcome to the new home of <strong>Ohio MVBC</strong>!  Ohio Midwest Volleyball Club's mission is to promote fun and fair indoor volleyball tournaments throughout the region.  Here you can find information about upcoming tournaments and other volleyball events in and around midwest Ohio.
							</p>
							<p>
								For questions please contact <a href="mailto:ohiomvbc@gmail.com">ohiomvbc@gmail.com</a>, or find us on Facebook.
							</p>

							
						</article>

						
							
						<h2><a href="http://www.teamlexvb.com/ohiomvbc/schedule.php">Upcoming Tournaments</a></h2>
						
<?php
					  require ('db_login.php');

					  $tourneyQuery = "SELECT tournaments.ID, tournaments.Name, tournaments.Venue, locations.Address, tournaments.StartDate, tournaments.EndDate, tournaments.Details from tournaments join locations on tournaments.Venue = locations.Name where StartDate >= '".date("Y-m-d H:i:s"). "' order by startdate asc Limit 2";
					  $tourneyQueryResult = mysql_query($tourneyQuery);
					    
					  while ($row = mysql_fetch_array($tourneyQueryResult, MYSQL_ASSOC)) { 
					  $upcoming = true;
?>
						<!-- Post -->
						<article class="box post post-excerpt">
							<header>
								<p><a href="tournament.php?ID=<?php echo $row[ID];?>"><?php echo $row[Name];?></a> at <?php echo $row[Venue];?></p>
							</header>
							<div class="info">
								<span class="date"><?php tournamentDateFormat($row[StartDate]); ?></span>
								<ul class="stats">
								<li><a href="register.php">Sign Up</a></li>
								</ul>
								
								<ul class="stats">
									<li><a href="https://www.facebook.com/groups/824257927695800/events/" target=_blank class="icon fa-facebook">Event Page on Facebook</a></li>
								</ul>
								
								
							</div>
							<a href="https://goo.gl/maps/Br5oD" class="image featured"><iframe src="https://maps.google.it/maps?q=<?php echo $row[Address]; ?>&output=embed" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe></a>
							<p>
								<?php echo $row[Details]; ?>
							</p>
						</article>
<?php
						}
					if (!$upcoming){
					 ?>
					 <article class="box post post-excerpt">
					 <p>No upcoming tournaments scheduled at this time, check back later!</p>
					 </article>
					 <?
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
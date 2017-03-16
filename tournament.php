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
					  require ('db_login.php');

					  $tourneyQuery = "SELECT tournaments.ID, tournaments.teams, tournaments.Format, tournaments.Level, tournaments.Cost, tournaments.Payout, tournaments.Name, tournaments.Venue, locations.Address, tournaments.StartDate, tournaments.EndDate, tournaments.Details from tournaments join locations on tournaments.Venue = locations.Name";
					  if ($_GET["ID"] <> ""){
						$tourneyQuery = $tourneyQuery . " where tournaments.ID = " . $_GET["ID"];
					  }
					  elseif ($_GET["d"] <> ""){
						$tourneyQuery = $tourneyQuery . " where tournaments.StartDate = '" . $_GET["d"] . "'";
					  }
					  $tourneyQueryResult = mysql_query($tourneyQuery);
					  
					  if (mysql_num_rows($tourneyQueryResult) == 0){
					  ?><article class="box post post-excerpt">
							<header style="padding:0px">
								<h2>Sorry, there were no tournaments found for this date.</h2>
								<p>Try visiting the <a href="schedule.php">schedule</a> for upcoming tournaments.</p>
							</header>
						</article>
					  <?php
					  }
					  
					  while ($row = mysql_fetch_array($tourneyQueryResult, MYSQL_ASSOC)) { 
?>
						<!-- Post -->
						<article class="box post post-excerpt">
							<header>
								<h2><a href="register.php"><?php echo $row[Name];?></a></h2>
								<p><?php echo $row[Venue];?></p>
							</header>
							<div class="info">
								<span class="date"><?php tournamentDateFormat($row[StartDate]); ?></span>
								<!--
								<ul class="stats">
								<li><a href="#">OVR Sanctioned</a></li>
								<li><a href="#">Single Elim</a></li>
								</ul>
								-->
								
								<!--
								<ul class="stats">
									<li><a href="#" class="icon fa-comment">16</a></li>
									<li><a href="#" class="icon fa-heart">32</a></li>
									<li><a href="#" class="icon fa-twitter">64</a></li>
									<li><a href="#" class="icon fa-facebook">128</a></li>
								</ul>
								-->
								<ul class="stats">
								<li><a href="register.php">Sign Up</a></li>
								</ul>
								<ul class="stats">
									<li><a href="https://www.facebook.com/groups/824257927695800/events/" target=_blank class="icon fa-facebook">Event Page on Facebook</a></li>
								</ul>
								
							</div>
							<a href="https://goo.gl/maps/Br5oD" class="image featured"><iframe src="https://maps.google.it/maps?q=<?php echo $row[Address]; ?>&output=embed" width="100%" frameborder="0" style="border:0" allowfullscreen></iframe></a>
							
							<table style="width:95%; margin:15px auto">
							<tr>
								<th>Format</th>
								<th>Level</th>
								<th>Cost</th>
								<th>Payout</th>
							</tr>
							<tr>
							<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Format]; ?></td>
							<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Level]; ?></td>
							<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Cost]; ?></td>
							<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Payout]; ?></td>
							</tr></table>
							
							
								<?php if ($row[Details] <> "") { echo "<p>" . $row[Details] . "</p>"; } ?>
							
							<p>
							<u><b>Registered Teams</b></u><br>
							
							<?php
							$teams = explode(",",$row[teams]);
							if ($teams[0] == "") {
								echo "There are no teams registered at this time.";
							}
							else {
								foreach ($teams as $team ){
									echo $team . "<br>";
								}
							}
							
						
							?>
							
							<div class="pagination">
							<a href="register.php" class="button next">Register Me!</a>
							</div>
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
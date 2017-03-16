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
					  <!-- Post -->
					  
						<article class="box post">
						<h2><a href="#">Tournament Schedule</a></h2>
						<p>All payouts based on tournament attendance. Subject to change.</p>
						
						<div style="overflow-x:scroll">
						<table style="width:95%; margin:15px auto; ">
						<tr><th>Date</th><th>Day</th>
						<th>Format</th>
						<th>Level</th>
						<th>Cost</th>
						<th>Payout</th>
						<th>Location</th>
						<th></th>
						
<?php
					  require ('db_login.php');

					  $tourneyQuery = "SELECT tournaments.ID, tournaments.Format, tournaments.Level, tournaments.Cost, tournaments.Payout, tournaments.Name as Name, tournaments.Venue, locations.Address as Address, tournaments.StartDate, tournaments.EndDate, tournaments.Details, locations.URL from tournaments join locations on tournaments.Venue = locations.Name where StartDate >= '".date("Y-m-d H:i:s"). "' order by StartDate asc";
					  $tourneyQueryResult = mysql_query($tourneyQuery);
					    
					  while ($row = mysql_fetch_array($tourneyQueryResult, MYSQL_ASSOC)) { 
?>
						<tr>
						
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo tournamentShortDateFormat($row[StartDate]); ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo tournamentDayOfTheWeek($row[StartDate]); ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Format]; ?>
						<?php if ($row[Details] <> "") {
						echo "<br>" . $row[Details];
						}
						?>
						
						</td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Level]; ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Cost]; ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Payout]; ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><?php echo $row[Venue]; ?></td>
						<td valign=middle style="padding:5px; border: 1px solid #222"><a href="tournament.php?ID=<?php echo $row[ID];?>"><!--<img style="margin:5px" src="https://ods.od.nih.gov/images/Common/externallink.png">-->Info</a><br><a href="register.php">Register</a></td>
						</tr>
<?php
						}
?>

						
						</table>
						</div>
						
						</article>

					<!-- Pagination 
						<div class="pagination">
							<!--<a href="#" class="button previous">Previous Page</a>
							<div class="pages">
								<a href="#" class="active">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<span>&hellip;</span>
								<a href="#">20</a>
							</div>
							<a href="#" class="button next">Next Page</a>
						</div>
					-->
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
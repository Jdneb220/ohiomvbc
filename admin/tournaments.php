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

	<body>

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

							   $venuesQuery = "SELECT Name from locations";

									$venuesQueryResult = mysql_query($venuesQuery);

									$venues = array();

									while ($row = mysql_fetch_array($venuesQueryResult, MYSQL_ASSOC)) { 

										array_push($venues, $row[Name]);

										}

										

							   if(isset($_POST['Add'])) {

								$piece = explode("/",$_POST['tdate']);

								if (count($piece) < 3){

								$newdate = date("Y") . "-" . $piece[0] . "-" . $piece[1];

								}

								else {

								$newdate = $piece[2] . "-" . $piece[0] . "-" . $piece[1];

								}

								$tourneyUpdateQuery = "INSERT INTO tournaments (Name, Venue, StartDate, EndDate, Details, Format, Level, Cost, Payout, teams) VALUES ('{$_POST['tname']}','{$_POST['tvenue']}','{$newdate}','{$newdate}','{$_POST['tdetails']}','{$_POST['tformat']}','{$_POST['tlevel']}','{$_POST['tcost']}','{$_POST['tpayout']}','{$_POST['tteams']}')";

								echo $tourneyUpdateQuery . "<br>";

								$tourneyUpdateQueryResult = mysql_query($tourneyUpdateQuery);

								echo $tourneyUpdateQueryResult . "<br>";

							   }

							   

							   

							   elseif(isset($_POST['Update'])) {

							    $piece = explode("/",$_POST['tdate']);

								if (count($piece) < 3){

								$newdate = date("Y") . "-" . $piece[0] . "-" . $piece[1];

								}

								else {

								$newdate = $piece[2] . "-" . $piece[0] . "-" . $piece[1];

								}

								$tourneyUpdateQuery = "UPDATE tournaments SET Name = '{$_POST['tname']}', Venue = '{$_POST['tvenue']}', StartDate = '{$newdate}', EndDate = '{$newdate}', Details = '{$_POST['tdetails']}', Format = '{$_POST['tformat']}', Level = '{$_POST['tlevel']}', Cost = '{$_POST['tcost']}', Payout = '{$_POST['tpayout']}', Teams = '{$_POST['tteams']}' WHERE ID = {$_POST['ID']}";

								$tourneyUpdateQueryResult = mysql_query($tourneyUpdateQuery);

							   }

							   elseif(isset($_POST['Delete'])) {

								$tourneyUpdateQuery = "DELETE FROM tournaments WHERE ID = {$_POST['ID']}";

								$tourneyUpdateQueryResult = mysql_query($tourneyUpdateQuery);

							   }

							   

							   ?>

							   <!-- Post -->

								<article class="box" style="padding:40px">

									<header>

										<h2>Tournaments Admin</h2>	

										<form action="index.php" method=post style="float:left">

										<input type="hidden" name="password" value="<?php echo $pwd;?>">

										<input type="submit" value="Back to Admin">

										</form>

										<br clear=all>

									</header>

									

									

									<form action="tournaments.php" method=post style="margin:20px; padding:10px; border: 1px solid #222; background: #eee">





									

									<table><tr><td>

									



										<span>Name:</span></td><td>

										<input type="text" name="tname" value="" required>



								

									</td></tr><tr><td>

									

							

										<span>Venue:</span></td><td>

									<select name="tvenue">

									<?php foreach ($venues as $venue){

										echo "<option value='" . $venue . "'";

										if ($venue == "TBA"){

										 echo " selected";

										}

										echo ">" . $venue . "</option>";

									}

									?>

									</select>

					

									</td></tr><tr><td>

									

									

										<span>Date:</span></td><td>

										<input type="text" name="tdate" placeholder="mm/dd/yyyy">

										

										</td></tr><tr><td>

										

										

										<span>Details:</span></td><td>

										

										<table>

										<tr>

											<th>Format</th>

											<th>Level</th>

											<th>Cost</th>

											<th>Payout</th>

										</tr>

										<tr>

											<td><input type="text" name="tformat" value=""></td>

											<td><input type="text" name="tlevel" value=""></td>

											<td><input type="text" name="tcost" value=""></td>

											<td><input type="text" name="tpayout" value=""></td>

										</tr>

										</table>

										<br>Extra Information:<br>

									<textarea name="tdetails" rows=4 cols=50></textarea>

									</td></tr>

									<tr><td>

									

									

										<span>Teams:</span></td><td>

										<input type="text" name="tteam" value="<?php echo $row[teams];?>" placeholder="Team Names separated by commas (ex: Team 1, Team 2, ...)">

										

										</td></tr>

									<tr><td colspan=2 style="padding-top:20px">

									

									<input type="hidden" name="password" value="<?php echo $pwd;?>">

									

									<input type="submit" name="Add" value="Add a Tournament" style="background-color:#519C11">



								    </td></tr></table>

									</form>

									

									

									<?php

									

										

									$tourneyQuery = "SELECT tournaments.ID, tournaments.teams, tournaments.Format, tournaments.Level, tournaments.Cost, tournaments.Payout, tournaments.Name as Name, tournaments.Venue, locations.Address as Address, tournaments.StartDate, tournaments.EndDate, tournaments.Details, locations.URL from tournaments join locations on tournaments.Venue = locations.Name  order by StartDate asc";

									$tourneyQueryResult = mysql_query($tourneyQuery);

										

									?>

									



									<?php

									while ($row = mysql_fetch_array($tourneyQueryResult, MYSQL_ASSOC)) { 

									?>



									<form action="tournaments.php" method=post style="margin:20px; padding:10px; border: 1px solid #222">





									

									<table><tr><td>

									



										<span>Name:</span></td><td>

										<input type="text" name="tname" value="<?php echo $row[Name];?>">



								

									</td></tr><tr><td>

									

							

										<span>Venue:</span></td><td>

									<select name="tvenue">

									<?php foreach ($venues as $venue){

										echo "<option value='" . $venue . "'";

										if ($venue == $row[Venue]){

										 echo " selected";

										}

										echo ">" . $venue . "</option>";

									}

									?>

									</select>

					

									</td></tr><tr><td>

									

									

										<span>Date:</span></td><td>

										<input type="text" name="tdate" value="<?php echo tournamentShortDateFormat($row[StartDate]);?>">

										

										</td></tr><tr><td>

										

										

										<span>Details:</span></td><td>

										

										<table>

										<tr>

											<th>Format</th>

											<th>Level</th>

											<th>Cost</th>

											<th>Payout</th>

										</tr>

										<tr>

											<td><input type="text" name="tformat" value="<?php echo $row[Format];?>"></td>

											<td><input type="text" name="tlevel" value="<?php echo $row[Level];?>"></td>

											<td><input type="text" name="tcost" value="<?php echo $row[Cost];?>"></td>

											<td><input type="text" name="tpayout" value="<?php echo $row[Payout];?>"></td>

										</tr>

										</table>

										<br>Extra Information:<br>

									<textarea name="tdetails" rows=4 cols=50><?php echo $row[Details];?></textarea>

									</td></tr>

									<tr><td>

									

									

										<span>Teams:</span></td><td>

										<input type="text" name="tteam" value="<?php echo $row[teams];?>" placeholder="Team Names separated by commas (ex: Team 1, Team 2, ...)">

										

										</td></tr>

									<tr><td colspan=2 style="padding-top:20px">

									

									<input type="hidden" name="ID" value="<?php echo $row[ID];?>">

									<input type="hidden" name="password" value="<?php echo $pwd;?>">

									

									<input type="submit" name="Update" value="Update">

									

									<input type="submit" name="Delete" value="Delete">

								    </td></tr></table>

									</form>



									<?php

									}

									?>



								</article>

							   <?php

							   }

							 ?>				



	 </body>

 </html>
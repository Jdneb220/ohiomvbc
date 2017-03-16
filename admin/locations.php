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
							   require ('../db_login.php');

										
							   if(isset($_POST['Add'])) {

								$locationsUpdateQuery = "INSERT INTO locations (Name, Address, URL) VALUES ('{$_POST['tname']}','{$_POST['taddress']}','{$_POST['turl']}')";

								$locationsUpdateQueryResult = mysql_query($locationsUpdateQuery);

							   }
							   
							   
							   elseif(isset($_POST['Update'])) {
								$locationsUpdateQuery = "UPDATE locations SET Name = '{$_POST['tname']}', Address = '{$_POST['taddress']}', URL = '{$_POST['turl']}' WHERE ID = {$_POST['ID']}";
								$locationsUpdateQueryResult = mysql_query($locationsUpdateQuery);
							   }
							   elseif(isset($_POST['Delete'])) {
								$locationsUpdateQuery = "DELETE FROM locations WHERE ID = {$_POST['ID']}";
								$locationsUpdateQueryResult = mysql_query($locationsUpdateQuery);
							   }
							   
							   ?>
							   <!-- Post -->
								<article class="box" style="padding:40px">
									<header>
										<h2>Locations Admin</h2>	
										<form action="index.php" method=post style="float:left">
										<input type="hidden" name="password" value="<?php echo $pwd;?>">
										<input type="submit" value="Back to Admin">
										</form>
										<br clear=all>
									</header>
									
									
									<form action="locations.php" method=post style="margin:20px; padding:10px; border: 1px solid #222">


									
									<table><tr><td>
									

										<span>Name:</span></td><td>
										<input type="text" name="tname" value="" required>

								
									</td></tr><tr><td>
									
							
									
									
										<span>Address:</span></td><td>
										<input type="text" name="taddress" placeholder="Street Address, City, State, Zip Code">
										
										</td></tr><tr><td>
										
										<span>URL:</span></td><td>
										<input type="text" name="turl" placeholder="http://wwww.example.com">
										
										</td></tr>
									<tr><td colspan=2>
									
									<input type="hidden" name="password" value="<?php echo $pwd;?>">
									
									<input type="submit" name="Add" value="Add a Location">

								    </td></tr></table>
									</form>
									
									
									<?php
									
										
									$tourneyQuery = "SELECT * from locations where Name <> 'TBA' order by Name asc";
									$tourneyQueryResult = mysql_query($tourneyQuery);
										
									?>
									

									<?php
									while ($row = mysql_fetch_array($tourneyQueryResult, MYSQL_ASSOC)) { 
									?>

									
									
									
									<form action="locations.php" method=post style="margin:20px; padding:10px; border: 1px solid #222">


									
									<table><tr><td>
									

										<span>Name:</span></td><td>
										<input type="text" name="tname" value="<?php echo $row[Name];?>"  required>

								
									</td></tr><tr><td>
									
							
									
									
										<span>Address:</span></td><td>
										<input type="text" name="taddress" placeholder="Street Address, City, State, Zip Code" value="<?php echo $row[Address];?>">
										
										</td></tr><tr><td>
										
										<span>URL:</span></td><td>
										<input type="text" name="turl" placeholder="http://wwww.example.com" value="<?php echo $row[URL];?>" >
										
										</td></tr>
									<tr><td colspan=2>
									
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
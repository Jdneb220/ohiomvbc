
		<!-- Sidebar -->
			<div id="sidebar">

				<!-- Logo -->
					<h1 id="logo"><a href="index.php">Ohio MVBC</a></h1>
				
				
				<!-- Nav 
					<nav id="nav">
						<?php	require ('nav.php');?>
					</nav>
				-->	

				<!-- Search -->
					<div class="box search">

						<form method="GET" action="search.php">
							<input type="text" class="text" name="search" placeholder="Search" />
						</form>
					</div>

					
				<!-- Text -->
					<section class="box text-style1">
						<div class="inner">
							<p>
								<strong>Ohio MVBC:</strong> Ohio Midwest Volleyball Club
							</p>
						</div>
					</section>

				<!-- Recent Posts -->
					<section class="box recent-posts">
						<header>
							<h2>Upcoming Tournaments</h2>
						</header>
						

						<ul>
						
						<?php
					require ('db_login.php');

					  $tourneysThisMonthQuery = "SELECT * from tournaments where StartDate >= '".date("Y-m-1 H:i:s"). "' ORDER BY StartDate Asc Limit 3";
					  $tourneysThisMonthQueryResult = mysql_query($tourneysThisMonthQuery);
					  while ($row = mysql_fetch_array($tourneysThisMonthQueryResult, MYSQL_ASSOC)) { 
						echo '<li><a href="tournament.php?ID='.$row[ID].'">'.$row[Name].'</a> ('.tournamentShorterDateFormat($row[StartDate]).')</li>'; 
					}
					  ?>
						</ul>
					</section>

				<!-- Recent Comments 
					<section class="box recent-comments">
						<header>
							<h2>Recent Comments</h2>
						</header>
						<ul>
							<li>case on <a href="#">Lorem ipsum dolor</a></li>
							<li>molly on <a href="#">Sed dolore magna</a></li>
							<li>case on <a href="#">Sed dolore magna</a></li>
						</ul>
					</section>

				<!-- Calendar -->
					<section class="box calendar">
					
					<?php

					  $tourneyDaysThisMonthQuery = "SELECT ID, Day(StartDate) as d from tournaments where Month(StartDate)=".date("n");
					  $tourneyDaysThisMonthQueryResult = mysql_query($tourneyDaysThisMonthQuery);
					  $tourneyDaysThisMonth = array();
					  $tourneyIDs = array();
					  while ($row = mysql_fetch_array($tourneyDaysThisMonthQueryResult, MYSQL_ASSOC)) { 
						array_push($tourneyDaysThisMonth, $row[d]);
						array_push($tourneyIDs, $row[ID]);
					  }
					  //print_r($tourneyDaysThisMonth);
					  //print_r($tourneyIDs);
					  //echo array_search(19,$tourneyDaysThisMonth);
					  
					  ?>
						<div class="inner">
							<table>
								<caption><?php echo date("F Y");?></caption>
								<thead>
									<tr>
										<th scope="col" title="Sunday">S</th>
										<th scope="col" title="Monday">M</th>
										<th scope="col" title="Tuesday">T</th>
										<th scope="col" title="Wednesday">W</th>
										<th scope="col" title="Thursday">T</th>
										<th scope="col" title="Friday">F</th>
										<th scope="col" title="Saturday">S</th>
										
									</tr>
								</thead>

						<?php
						$first = date('N', mktime(0,0,0,date("m"),1,date("Y")));
						if ($first == 7){
						 $first = 0;
						}
						$daysInMonth = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); 
						$finalSpan = 7;
						?>

								<tbody>
									<tr>
									<?php if ($first > 0){
									  echo '<td colspan="'. $first . '" class="pad"><span>&nbsp;</span></td>';
									}
									
									for ($i = 1; $i <= $daysInMonth; $i++){
	
									  if (in_array($i,$tourneyDaysThisMonth)){
										echo '<td><a href="tournament.php?d='.date("Y").'-'.date("m").'-'.$i.'">'.$i.'</a></td>';
									  }
									  elseif (date("j") == $i){
									   echo '<td class="today"><a href="tournament.php?d='.date("Y").'-'.date("m").'-'.$i.'">'.$i.'</a></td>';
									  }
									  else	{
									   echo '<td><span>'.$i.'</span></td>';
									  }
									  
									  $finalSpan--;
									  if ((date('N', mktime(0,0,0,date("m"),$i,date("Y"))) == 6) && ($i <> $daysInMonth)) {
									   echo '</tr><tr>';
									   $finalSpan = 7;
									  }
									}
									
									if ($finalSpan > 0){
									  echo '<td class="pad" colspan="'.$finalSpan.'"><span>&nbsp;</span></td>';
									}
									?>
									
									</tr>
									</tbody>

								
							</table>
							
							
						</div>
					</section>

				<!-- Copyright -->
					<ul id="copyright">
						<li>&copy; Ohio MVBC</li>
						<li><a href="https://www.facebook.com/groups/824257927695800/" target=_blank>Facebook group</a></li>
						<li>Design: <a href="mailto:scvlben@gmail.com">bdj design</a></li>
					</ul>

			</div>
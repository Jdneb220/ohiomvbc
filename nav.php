<ul>
										<li <?php if (strpos($_SERVER[REQUEST_URI],'index') !== false) { echo 'class=current'; } ?>><a href="index.php">Home</a></li>
										<li <?php if (strpos($_SERVER[REQUEST_URI],'schedule') !== false) { echo 'class=current'; } ?>><a href="schedule.php">Schedule</a></li>
										<li <?php if (strpos($_SERVER[REQUEST_URI],'locations') !== false) { echo 'class=current'; } ?>><a href="locations.php">Locations</a></li>
										<li <?php if (strpos($_SERVER[REQUEST_URI],'results') !== false) { echo 'class=current'; } ?>><a href="results.php">Results</a></li>
										<li <?php if (strpos($_SERVER[REQUEST_URI],'contact') !== false) { echo 'class=current'; } ?>><a href="contact.php">Contact Us</a></li>
									</ul>
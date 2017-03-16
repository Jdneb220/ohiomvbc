<?php

$db_host='ohiomvbc.db.10830125.hostedresource.com';
$db_database='ohiomvbc';
$db_username='ohiomvbc';
$db_password='Oh!0mvbc';


$connection = mysql_connect($db_host, $db_username, $db_password);
	if (!connection) {
		die ("Could not connect to the database: <br />". mysql_error());
		}
	
	$db_select = mysql_select_db($db_database);
	if (!$db_select){
		die ("Could not select the database: <br />". mysql_error());
		}

function tournamentDateFormat($date){
	$month = substr($date, 5, 2);
	$day = '<span class="day">' . substr($date, 8, 2) . '</span>';
	$year = '<span class="year">, ' .substr($date, 0, 4) . '</span>';
	switch ($month){
		case	'01'	:	$month =	'<span class="month">Jan<span>uary</span></span>'	; break;
		case	'02'	:	$month =	'<span class="month">Feb<span>ruary</span></span>'	; break;
		case	'03'	:	$month =	'<span class="month">Mar<span>ch</span></span>'	; break;
		case	'04'	:	$month =	'<span class="month">Apr<span>il</span></span>'	; break;
		case	'05'	:	$month =	'<span class="month">May</span>'	; break;
		case	'06'	:	$month =	'<span class="month">Jun<span>e</span></span>'	; break;
		case	'07'	:	$month =	'<span class="month">Jul<span>ember</span></span>'	; break;
		case	'08'	:	$month =	'<span class="month">Aug<span>ust</span></span>'	; break;
		case	'09'	:	$month =	'<span class="month">Sept<span>ember</span></span>'	; break;
		case	'10'	:	$month =	'<span class="month">Oct<span>ober</span></span>'	; break;
		case	'11'	:	$month =	'<span class="month">Nov<span>ember</span></span>'	; break;
		case	'12'	:	$month =	'<span class="month">Dec<span>ember</span></span>'	; break;

	}
	echo $month . " " . $day . $year;
}

function tournamentShortDateFormat($date){
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	$year = substr($date, 0, 4);
	return ltrim($month,'0') . "/" . ltrim($day,'0') . "/" . $year;
}

function tournamentShorterDateFormat($date){
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	return ltrim($month,'0') . "/" . ltrim($day,'0');
}

function tournamentDayOfTheWeek($date){
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	$year = substr($date, 0, 4);
	return date("l", mktime(0, 0, 0, $month, $day, $year));
}
	
?>
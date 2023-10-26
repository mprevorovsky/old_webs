<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
		body {color:black;font-family: "Geneva CE", "Arial CE", sans-serif;background-color:#90d085;}
		table {background-color: #90d085; border: 0px; padding: 0px; border-spacing:20px;}
		
		td {border: 1px solid black; padding: 5px; vertical-align:top; font-size:80%;background-color:white;}
		
		img {border: #000000 2px solid; margin:0px;}
	</style>
</head>

<body>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
include(DIR_LIB.'graphics.php');

//připojí se k přednastavené databázi
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
if (!$con)
{
die('Could not connect: ' . mysql_error());
}
mysql_select_db(DB_NAME,$con);

$sql = 'SELECT * FROM `'.TB_SPERKY.'` WHERE zobrazovat="Y"';
$result = mysql_query($sql) or die(mysql_error());

$counter = 1;
	echo '<table align="center"><tr>';
	while($row = mysql_fetch_array($result)) {
		$thumb = URL_THUMB.'id'.$row['id'].'_1_thumb.jpg';
		$pic = URL_PIC.'id'.$row['id'].'_1.jpg';
		echo '<td align="center" width="160"><b>'.$row['nazev'].'</b><br>'."\n";
		echo '<br><a href="'.$pic.'"><image src="'.$pic.'" width="150" height="150"></a>'."\n";
		$cena=explode('.', $row['prodej_cena']);
		echo '<br><br>Cena: '.$cena[0].' Kč</td>'."\n";
		if(($counter % 4) == 0) {echo '</tr><tr>';}
		$counter += 1;		
	}
	echo '</tr></table>';
		
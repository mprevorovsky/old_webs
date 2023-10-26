<?php include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php') ?>

<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo URL_CSS; ?>sprava.css" charset="UTF-8" rel="stylesheet" type="text/css">
	<title>Správa | Kolekce</title>
</head>

<body>
<?php
//připojí se k přednastavené databázi
include_once(DIR_LIB.'dbase.php');
$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);


// zahlavi tabulky
$header = array('Produktové kolekce', 'Novinka');
$keys = array('kolekce', 'novinka');
$n_cols = count($header);
$result = mysql_query('SELECT * FROM `'.TB_KOLEKCE.'` ORDER BY kolekce ASC') or die(mysql_error());	
echo '<a href="'.URL_SPRAVA.'"><b>Zpět na hlavní menu Správy</b></a></p>'."\n";
echo '<table width="100%"><tr><td>#</td>'."\n";
for($i=0; $i<$n_cols; $i++) 
{	
	echo '<td><b>'.$header[$i].'</b></td>'."\n";
}
// zobrazi kolekce
$count = 1;
while($row = mysql_fetch_array($result)) 
{
	echo '<tr><td>'.$count.'</td>'."\n";
	$count += 1;
	for($i=0; $i<($n_cols); $i++) 
	{
		echo '<td>'.htmlspecialchars($row[$keys[$i]], ENT_QUOTES, 'UTF-8').'</td>'."\n";
	}
	echo '</tr>'."\n";
}
echo '</table>'."\n";


mysql_close($con);
?>
</body>
</html>
<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
	include_once(DIR_LIB.'dbase.php');
	$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	
//////////
// KATEGORIE
//////////

	echo '<b>Kategorie</b><br>--old table<br>';
	$result = mysql_query('SELECT * FROM '.TB_KATEGORIE) or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo(htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').'<br>');
	}


	echo '<br>--nacitani kategorii z databaze sperku<br>';
	$result = mysql_query('SELECT DISTINCT kategorie FROM '.TB_SPERKY) or die(mysql_error());
	$kategorie = array();
	$counter = 1;
	while($row = mysql_fetch_array($result))
	{
		if($row['kategorie']) // ignore 'empty' records
		{
			$all_kategorie = explode(';', $row['kategorie']); // split if annotated to multiple categories
			for($i=0; $i<count($all_kategorie); $i++)
			{
				$kategorie[$counter] = trim($all_kategorie[$i]); // remove white spaces
				echo $kategorie[$counter].'<br>';
				$counter += 1;
			}
		}
	}


	echo '<br>--plne zpracovane hodnoty<br>';
	$result = mysql_query('TRUNCATE TABLE '.TB_KATEGORIE, $con) or die(mysql_error()); // empty the current table
	$unique_kategorie = array_unique($kategorie); // get unique values
	$unique_kategorie = array_values($unique_kategorie); // reindex the array
	for($i=0; $i<count($unique_kategorie); $i++)
	{
		echo $i.' - '.$unique_kategorie[$i].'<br>';
		$sql = 'INSERT INTO '.TB_KATEGORIE.' (kategorie) VALUES ("'.mysql_real_escape_string($unique_kategorie[$i]).'")';
		echo $sql.'<br>';
		$result = mysql_query($sql, $con) or die(mysql_error());
	}	


	echo '<br>--new table<br>';
	$result = mysql_query('SELECT * FROM '.TB_KATEGORIE) or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo(htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').'<br>');
	}
	

//////////
// KOLEKCE
//////////

	echo '<br><br><b>Kolekce</b><br>--old table<br>';
	$result = mysql_query('SELECT * FROM '.TB_KOLEKCE) or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo(htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').'<br>');
	}


	echo '<br>--nacitani kolekci z databaze sperku<br>';
	$result = mysql_query('SELECT DISTINCT kolekce FROM '.TB_SPERKY) or die(mysql_error());
	$kolekce = array();
	$counter = 1;
	while($row = mysql_fetch_array($result))
	{
		if($row['kolekce']) // ignore 'empty' records
		{
			$all_kolekce = explode(';', $row['kolekce']); // split if annotated to multiple collections
			for($i=0; $i<count($all_kolekce); $i++)
			{
				$kolekce[$counter] = trim($all_kolekce[$i]); // remove white spaces
				echo $kolekce[$counter].'<br>';
				$counter += 1;
			}
		}
	}


	echo '<br>--plne zpracovane hodnoty<br>';
	$result = mysql_query('TRUNCATE TABLE '.TB_KOLEKCE, $con) or die(mysql_error()); // empty the current table
	$unique_kolekce = array_unique($kolekce); // get unique values
	$unique_kolekce = array_values($unique_kolekce); // reindex the array
	for($i=0; $i<count($unique_kolekce); $i++)
	{
		echo $i.' - '.$unique_kolekce[$i].'<br>';
		$sql = 'INSERT INTO '.TB_KOLEKCE.' (kolekce) VALUES ("'.mysql_real_escape_string($unique_kolekce[$i]).'")';
		echo $sql.'<br>';
		$result = mysql_query($sql, $con) or die(mysql_error());
	}	


	echo '<br>--new table<br>';
	$result = mysql_query('SELECT * FROM '.TB_KOLEKCE) or die(mysql_error());
	while($row = mysql_fetch_array($result))
	{
		echo(htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').'<br>');
	}


	mysql_close($con);
?>

</body>
</html>
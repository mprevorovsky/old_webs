<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');


function db_connect($db_server, $db_user, $db_password, $db_name) 
//připojí se k přednastavené databázi
{
	$con = mysql_connect($db_server, $db_user, $db_password);
	if (!$con)
		{
		die('Could not connect: ' . mysql_error());
		}
	mysql_select_db($db_name, $con);
	return $con;
}


function create_values_table($table) 
//vytvoří tabulku s výčtem unikátních kategorií/kolekcí produktů v databázi Šperky
{
	$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysql_query('SELECT DISTINCT '.$table.' FROM '.TB_SPERKY. 
		' WHERE zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE()') or die(mysql_error());
	$values = array();
	$counter = 1;
	while($row = mysql_fetch_array($result))
	{
		if($row[$table]) // ignore 'empty' records
		{
			$all_values = explode(';', $row[$table]); // split if annotated to multiple categories
			for($i=0; $i<count($all_values); $i++)
			{
				$values[$counter] = trim($all_values[$i]); // remove white spaces
				$counter += 1;
			}
		}
	}
	$result = mysql_query('TRUNCATE TABLE '.$table, $con) or die(mysql_error()); // empty the current table
	$unique_values = array_unique($values); // get unique values
	$unique_values = array_values($unique_values); // reindex the array
	for($i=0; $i<count($unique_values); $i++)
	{
		// vybere zobrazovatelne zaznamy dane kolekce/kategorie a najde z nich ty, ktere jsou starsi nez limit pro novinky
		// pokud takove produkty neexistují, kolekce/kategorie je oznacena jako NOVA
		$new = mysql_query('SELECT * FROM '.TB_SPERKY. 
			' WHERE zobrazovat="Y" && obrazku > 0 && '.$table.'="'.$unique_values[$i].'" 
			&& datum_zobraz < DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
		if(mysql_fetch_array($new)) 
		{
			$novinka = 'N'; // stary zaznam nalezen
		}
		else 
		{
			$novinka = 'Y'; // stary zaznam nenalezen -> NOVA
		}
		//
		$sql = 'INSERT INTO '.$table.' ('.$table.', novinka) 
			VALUES ("'.mysql_real_escape_string($unique_values[$i]).'", "'.$novinka.'")';
		$result = mysql_query($sql, $con) or die(mysql_error());
	}
	mysql_close($con);
}


function get_relevant_kategorie($kolekce) 
//vytvoří pole s výčtem unikátních kategorií produktů v rámci dané kolekce v databázi Šperky
//používá "=" pro filtrování
{
	$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysql_query('SELECT DISTINCT kategorie FROM '.TB_SPERKY. 
		' WHERE zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE() 
		&& kolekce="'.mysql_real_escape_string($kolekce).'"') or die(mysql_error());
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
				$counter += 1;
			}
		}
	}
	$unique_kategorie = array_unique($kategorie); // get unique values
	$unique_kategorie = array_values($unique_kategorie); // reindex the array
	return $unique_kategorie;
}


function get_relevant_kolekce($kategorie)
//vytvoří pole s výčtem unikátních kolekcí produktů v rámci dané kategorie v databázi Šperky
//používá "LIKE" pro filtrování
{
	$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	$result = mysql_query('SELECT DISTINCT kolekce FROM '.TB_SPERKY. 
		' WHERE zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE() 
		&& kategorie LIKE "%'.mysql_real_escape_string($kategorie).'%"') or die(mysql_error());
	$kolekce = array();
	$counter = 1;
	while($row = mysql_fetch_array($result))
	{
		if($row['kolekce']) // ignore 'empty' records
		{
			$all_kolekce = explode(';', $row['kolekce']); // split if annotated to multiple categories
			for($i=0; $i<count($all_kolekce); $i++)
			{
				$kolekce[$counter] = trim($all_kolekce[$i]); // remove white spaces
				$counter += 1;
			}
		}
	}
	$unique_kolekce = array_unique($kolekce); // get unique values
	$unique_kolekce = array_values($unique_kolekce); // reindex the array
	return $unique_kolekce;
}

?>
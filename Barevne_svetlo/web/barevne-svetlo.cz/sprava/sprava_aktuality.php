<?php include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php') ?>

<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo URL_CSS; ?>sprava.css" charset="UTF-8" rel="stylesheet" type="text/css">
	<title>Správa | Aktuality</title>
</head>

<body>
<?php
//připojí se k přednastavené databázi
include_once(DIR_LIB.'dbase.php');
$con = db_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

//Zobrazí formulář pro vkládání/úpravu záznamů do databáze 
//po odeslání vložených informací zavolá vkládací rutinu (níže) pomocí POST
//(GET může mít problém s příliš dlouhou URL)
if(isset($_GET['vlozit']) || isset($_GET['upravit']))
{
	//set defaults
	if (isset($_GET['vlozit'])) 
	{
		$row=array('id' => NULL, 
		'datum_vloz' => NULL,
		'datum_uprav' => NULL,
		'datum' => date('Y-m-d'),
		'nadpis' => NULL,
		'text' => NULL,
		'zobrazovat' => "Y");
	}
	elseif (isset($_GET['upravit']))
	{
		$result = mysql_query('SELECT * FROM '.TB_AKTUALITY.' WHERE id='.$_GET['id']) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$prev_row = mysql_fetch_array(mysql_query('SELECT id FROM '.TB_AKTUALITY.' WHERE id < '.$_GET['id'].' ORDER BY id DESC LIMIT 1'));
		if($prev_row) 
		{
			echo '<b><a href="'.URL_SPRAVA_AKTUALITY.'?upravit=&id='.$prev_row['id'].'">Předchozí</a></b> --'."\n";
		}
		$next_row = mysql_fetch_array(mysql_query('SELECT id FROM '.TB_AKTUALITY.' WHERE id > '.$_GET['id'].' ORDER BY id ASC LIMIT 1'));
		if($next_row) 
		{
			echo '-- <b><a href="'.URL_SPRAVA_AKTUALITY.'?upravit=&id='.$next_row['id'].'">Následující</a></b>'."\n";
		}
	}
	echo '<table><tr><td width="500" valign="top">'."\n";
	echo '<form method="post" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
	echo '<b>ID: <font color="blue">'.$row['id'].'</font><br><br>'."\n";
	echo '<input type="hidden" name="id" value="'.$row['id'].'">'."\n";
	echo 'Datum vložení: <font color="blue">'.$row['datum_vloz'].'</font><br><br>'."\n";
	echo 'Datum poslední editace: <font color="blue">'.$row['datum_uprav'].'</font><br><br>'."\n";
	echo 'Zobrazované datum: <input type="text" name="datum" size="20" value="'
		.htmlspecialchars($row['datum'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Nadpis:<br><input type="text" name="nadpis" size="40" value="'
		.htmlspecialchars($row['nadpis'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Text:<br><textarea name="text" cols="64" rows="8">'.$row['text'].'</textarea><br><br>'."\n";
	if($row['zobrazovat']=='Y') { $checked='checked="checked"';} else { $checked='';}
	echo '<input type="checkbox" name="zobrazovat" '.$checked.'> Zobrazovat zákazníkům?<br><br>'."\n";
	echo '</td><td><br>'."\n";
	if(isset($_GET['vlozit'])) 
	{
		echo '<input type="submit" name="vlozeno" value="Vložit záznam"><br><br>'."\n";
		echo '<input type="reset" name="reset" value="Reset"><br><br>'."\n";
	}
	elseif(isset($_GET['upravit']))
	{
		echo '<input type="submit" name="upraveno" value="Upravit záznam"><br><br>'."\n";
		echo '<input type="reset" name="reset" value="Reset"><br><br></form>'."\n";
		echo '<form method="get" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
		echo '<input type="submit" name="smazat" value="Smazat záznam"><br><br>'."\n";
		echo '<input type="hidden" name="id" value="'.$row['id'].'">'."\n";
		echo '<input type="hidden" name="nadpis" value="'.htmlspecialchars($row['nadpis'],ENT_QUOTES,'UTF-8').'">'."\n";
		echo '<input type="hidden" name="text" value="'.htmlspecialchars($row['text'],ENT_QUOTES,'UTF-8').'">'."\n";
	}
	echo '<p><a href='.URL_SPRAVA_AKTUALITY.'>Zpět na hlavní menu Aktualit</a></p>'."\n";
	if(isset($_GET['upravit'])) 
	{
		echo '<br><form method="get" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
		echo '<input type="submit" name="vlozit" value="Nový záznam"><p> </p></form>'."\n";
	}
	echo '</form></b></td></tr></table>'."\n";
}


//Vkládací rutina pro nové /upravené záznamy do mySQL databáze
elseif(isset($_POST['vlozeno']) || isset($_POST['upraveno'])) 
{
	if($_POST['zobrazovat']) 
	{
		$zobrazovat='Y';
	}
	else 
	{
		$zobrazovat='N';
	}
	// nove zaznamy
	if(isset($_POST['vlozeno'])) 
	{
		$sql = 'INSERT INTO '.TB_AKTUALITY.' (datum_vloz,datum,nadpis,text,zobrazovat) 
 		VALUES (NOW(),
 		"'.mysql_real_escape_string($_POST["datum"]).'",
 		"'.mysql_real_escape_string($_POST["nadpis"]).'",
 		"'.mysql_real_escape_string($_POST["text"]).'",
 		"'.$zobrazovat.'")';
		$result = mysql_query($sql) or die(mysql_error()); 	
 	 	$result = mysql_query('SELECT * FROM '.TB_AKTUALITY.' WHERE id = (SELECT MAX(id) FROM '.TB_AKTUALITY.')') or die(mysql_error());
 	}
 	// editace stavajicich zaznamu
 	elseif(isset($_POST['upraveno'])) 
 	{
		$sql = 'UPDATE '.TB_AKTUALITY.' SET 
		datum="'.mysql_real_escape_string($_POST['datum']).'",
		nadpis="'.mysql_real_escape_string($_POST['nadpis']).'",
		text="'.mysql_real_escape_string($_POST['text']).'",
		zobrazovat="'.$zobrazovat.'" 
		WHERE id="'.$_POST['id'].'"';
		//echo($sql.'<br>'); exit();
		$result = mysql_query($sql) or die(mysql_error()); 	
 	 	$result = mysql_query('SELECT * FROM '.TB_AKTUALITY.' WHERE id = '.$_POST['id']) or die(mysql_error());	 
 	}	
 	$row = mysql_fetch_array($result);
	header('Refresh: 0; url="'.URL_SPRAVA_AKTUALITY.'?upravit=&id='.$row['id'].'"');
}


// Smaže produkt z databáze (ID předáno pomocí GET)
elseif(isset($_GET['smazat'])) 
{
	// smazat (potvrzena akce)
	if($_GET['potvrzeno']=='Ano') 
	{
		mysql_query('DELETE FROM '.TB_AKTUALITY.' WHERE id='.$_GET['id']) or die(mysql_error());
		header('Refresh: 0; url="'.URL_SPRAVA_AKTUALITY.'"');	
	}
	// navrat na predchozi stranku pokud akce negovana
	elseif($_GET['potvrzeno']=='Ne') 
	{
		header('Refresh: 0; url="'.$_GET['referer'].'"');
	}
	// vyzadat si potvrzeni akce
	else 
	{
		echo '<table><tr><td width="500" valign="center" align="center">'."\n";
		echo '<b><font color="red"><form method="get" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
		echo 'Tento krok nejde vrátit!<br><br>Opravdu chcete z databáze smazat tuto aktualitu?<br><br>"'
			.htmlspecialchars($_GET['nadpis'], ENT_QUOTES, 'UTF-8').'"<br>('
			.htmlspecialchars($_GET['text'],ENT_QUOTES,'UTF-8').')<br><br>'."\n";
		echo '<input type="hidden" name="smazat" value="'.$_GET['smazat'].'">'."\n";
		echo '<input type="hidden" name="referer" value="'.htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES,'UTF-8').'">'."\n";	
		echo '<input type="hidden" name="id" value="'.$_GET['id'].'">'."\n";
		//echo '<input type="hidden" name="nazev" value="'.htmlspecialchars($_GET['nazev'],ENT_QUOTES,'UTF-8').'">'."\n";
		echo '<input type="submit" name="potvrzeno" value="Ne"> '."\n";
		echo '<input type="submit" name="potvrzeno" value="Ano">'."\n";
		echo '</form></font></b></td></tr></table>'."\n";
	}
}	


//Zobrazí náhled obsahu databáze a umožní detailní zobrazení/editaci/mazání
else 
{
	// filtrovane nacitani databaze
	if(isset($_GET['radit'])) 
	{
		$orderby = $_GET['radit'];
	}
	else 
	{
		$orderby = 'datum'; //default
	}
	if(isset($_GET['ascdesc'])) 
	{
		$order_ascdesc = $_GET['ascdesc'];
	}
	else 
	{
		$order_ascdesc = 'DESC';  //default
	}
	if (isset($_GET['filtrovat']) && !isset($_POST['resetovat'])) 
	{
		// nastavit defaultní hodnoty pro filtr
		$filtr=array('datum' => $_GET['datum'],
		'nadpis' => $_GET['nadpis'],
		'text' => $_GET['text']);
		// cteni
		$sql = 'SELECT * FROM `'.TB_AKTUALITY.'` WHERE 
			datum LIKE "%'.mysql_real_escape_string($filtr['datum']).'%" &&
			nadpis LIKE "%'.mysql_real_escape_string($filtr['nadpis']).'%" &&
			text LIKE "%'.mysql_real_escape_string($filtr['text']).'%"
			ORDER BY '.mysql_real_escape_string($orderby).' '.mysql_real_escape_string($order_ascdesc);
		$result = mysql_query($sql) or die(mysql_error());		
	}
	else 
	{
		$result = mysql_query('SELECT * FROM `'.TB_AKTUALITY.'` ORDER BY '.mysql_real_escape_string($orderby)
			.' '.mysql_real_escape_string($order_ascdesc)) or die(mysql_error());	
	}
	// zahlavi tabulky
	$header = array('Datum', 'Nadpis', 'Text');
	$keys = array('datum', 'nadpis', 'text');
	$n_cols = count($header);
	echo '<form method="get" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
	echo '<p><input type="submit" name="vlozit" value="Nový záznam"></form>'."\n";
	echo '<a href="'.URL_SPRAVA.'"><b>Zpět na hlavní menu Správy</b></a></p>'."\n";
	echo '<table width="100%"><tr><td>#</td>'."\n";
	for($i=0; $i<$n_cols; $i++) {	
		echo '<td><b>'.$header[$i].'</b></td>'."\n";
	}
	echo '<td colspan="2" align="center"><form method="post" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
	echo '<input type="submit" name="resetovat" value="Resetuj filtr"></form></td></tr>'."\n";
	// filtr
	echo '<tr><form method="get" action="'.URL_SPRAVA_AKTUALITY.'">'."\n";
	echo '<td></td><td colspan="3"><select name="radit">'."\n";
	if($orderby=='datum_vloz') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="datum_vloz" '.$selected.'>Datum vložení</option>'."\n";
	if($orderby=='datum_uprav') { $selected='selected="selected"';} else { $selected='';}	
	echo '<option value="datum_uprav" '.$selected.'>Datum poslední editace</option>'."\n";
	if($orderby=='datum') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="datum" '.$selected.'>Zobrazované datum</option>'."\n";
	if($orderby=='nadpis') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="nadpis" '.$selected.'>Nadpis</option>'."\n";
	if($orderby=='text') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="text" '.$selected.'>Text</option>'."\n";
	if($orderby=='zobrazovat') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="zobrazovat" '.$selected.'>Zobrazovat zákazníkům</option>'."\n";
	echo '</select>'."\n";	
	echo '<select name="ascdesc">'."\n";
	if($order_ascdesc=='ASC') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="ASC" '.$selected.'>vzestupně</option>'."\n";
	if($order_ascdesc=='DESC') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="DESC" '.$selected.'>sestupně</option>'."\n";
	echo '</select></td>'."\n";
	echo '<td colspan="2" rowspan="2" align="center"><input type="submit" name="filtrovat" value="Filtruj"></td></tr>'."\n";
	echo '<tr><td></td>'."\n";
	echo '<td><input type="text" name="datum" size="10" value="'.
		htmlspecialchars($filtr['datum'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="nadpis" size="10" value="'.
		htmlspecialchars($filtr['nadpis'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="text" size="10" value="'.
		htmlspecialchars($filtr['text'], ENT_QUOTES, 'UTF-8').'"></form></td>'."\n";
	// zobrazi aktuality
	$count = 1;
	while($row = mysql_fetch_array($result)) 
	{
		if($row['zobrazovat']!='Y') { $td_col = 'class="hidden"';} else {$td_col ='';}
		echo '<tr '.$td_col.'><td>'.$count.'</td>'."\n";
		$count += 1;
		for($i=0; $i<($n_cols); $i++) 
		{
			//echo '<td>'.htmlspecialchars($row[$keys[$i]], ENT_QUOTES, 'UTF-8').'</td>'."\n";
			//
			// ***** THIS ALLOWS FOR HTML (FORMATING, LINKS) TO BE USED *****
			echo '<td>'.$row[$keys[$i]].'</td>'."\n";
			// **************************************************************
		}
		echo '<td><a href="'.URL_SPRAVA_AKTUALITY.'?upravit=&id='.$row['id'].'">uprav</a></td>'."\n";
		echo '<td><a href="'.URL_SPRAVA_AKTUALITY.'?smazat=&id='.$row['id'].'&nadpis='.htmlspecialchars($row['nadpis'], ENT_QUOTES,
			'UTF-8').'&text='.htmlspecialchars($row['text'], ENT_QUOTES, 'UTF-8').'">smaž</a></td>'."\n";
		echo '</tr>'."\n";
	}
	echo '</table>'."\n";
}


mysql_close($con);
?>
</body>
</html>
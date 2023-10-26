<?php include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php') ?>

<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo URL_CSS; ?>sprava.css" charset="UTF-8" rel="stylesheet" type="text/css">
	<title>Správa | Šperky</title>
</head>

<body>
<?php
include_once(DIR_LIB.'graphics.php');
include_once(DIR_LIB.'math.php');
include_once(DIR_LIB.'dbase.php');
//include(DIR_LIB.'text.php');


//připojí se k přednastavené databázi
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
		'datum_uprav' => NULL,
		'datum_vloz' => NULL,
		'datum_zobraz' => date('Y-m-d', strtotime('+1 week')),
		'kat_cislo' => NULL,
		'nazev' => NULL,
		'kolekce' => NULL,
		'kategorie' => NULL,
		'popis' => NULL,
		'velikost' => NULL,
		'material' => NULL,
		'poznamka_int' => NULL,
		'poznamka_ext' => NULL,
		'akce' => NULL,
		'vyr_naklady' => NULL,
		'vyr_cas' => NULL,
		'kalk_cena' => NULL,
		'prodej_cena' => NULL,
		'dodaci_lhuta' => 5,
		'postovne' => 1,
		'kusu_skladem' => 1,
		'obrazku' => 0,
		'zobrazovat' => 'Y');
	}
	elseif (isset($_GET['upravit']))
	{
		$result = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id='.$_GET['id']) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$prev_row = mysql_fetch_array(mysql_query('SELECT id FROM '.TB_SPERKY.' WHERE id < '.$_GET['id'].' ORDER BY id DESC LIMIT 1'));
		if($prev_row) 
		{
			echo '<b><a href="'.URL_SPRAVA_SPERKY.'?upravit=&id='.$prev_row['id'].'">Předchozí</a></b> --'."\n";
		}
		$next_row = mysql_fetch_array(mysql_query('SELECT id FROM '.TB_SPERKY.' WHERE id > '.$_GET['id'].' ORDER BY id ASC LIMIT 1'));
		if($next_row) 
		{
			echo '-- <b><a href="'.URL_SPRAVA_SPERKY.'?upravit=&id='.$next_row['id'].'">Následující</a></b>'."\n";
		}
	}
	echo '<table><tr><td width="500" valign="top">'."\n";
	echo '<form method="post" action="'.URL_SPRAVA_SPERKY.'">'."\n";
	echo '<b>ID: <font color="blue">'.$row['id'].'</font><br><br>'."\n";
	echo '<input type="hidden" name="id" value="'.$row['id'].'">'."\n";
	echo 'Datum vložení: <font color="blue">'.$row['datum_vloz'].'</font><br><br>'."\n";
	echo 'Datum poslední editace: <font color="blue">'.$row['datum_uprav'].'</font><br><br>'."\n";
	echo 'Datum zveřejnění: <input type="text" name="datum_zobraz" size="10" value="'
		.htmlspecialchars($row['datum_zobraz'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Katalogové číslo: <input type="text" name="kat_cislo" size="20" value="'
		.htmlspecialchars($row['kat_cislo'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Název:<br><input type="text" name="nazev" size="40" value="'
		.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Kolekce:<br><input type="text" name="kolekce" size="40" value="'
		.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Kategorie zboží:<br><input type="text" name="kategorie" size="40" value="'
		.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Popis:<br><textarea name="popis" cols="64" rows="5">'.$row['popis'].'</textarea><br><br>'."\n";
	echo 'Délka:<br><textarea name="velikost" cols="64" rows="2">'.$row['velikost'].'</textarea><br><br>'."\n";
	echo 'Materiál:<br><textarea name="material" cols="64" rows="2">'.$row['material'].'</textarea><br><br>'."\n";
	echo 'Interní poznámka:<br><textarea name="poznamka_int" cols="64" rows="2">'.$row['poznamka_int'].'</textarea><br><br>'."\n";	
	echo '</td></b><td width="350" valign="top">'."\n";
	echo '<b>Externí poznámka:<br><textarea name="poznamka_ext" cols="64" rows="2">'.$row['poznamka_ext'].'</textarea><br><br>'."\n";
	echo 'Akce: <input type="text" name="akce" size="20" value="'
		.htmlspecialchars($row['akce'], ENT_QUOTES, 'UTF-8').'"><br><br>'."\n";
	echo 'Výrobní náklady: <input type="text" name="vyr_naklady" size="5" value="'.$row['vyr_naklady'].'"> Kč<br><br>'."\n";
	echo 'Čas na výrobu 1 ks: <input type="text" name="vyr_cas" size="5" value="'.$row['vyr_cas'].'"> hod<br><br>'."\n";
	echo 'Kalkulovaná cena: <font color="blue">'.$row['kalk_cena'].' Kč</font><br><br>'."\n";
	echo 'Prodejní cena: <input type="text" name="prodej_cena" size="5" value="'.$row['prodej_cena'].'"> Kč<br><br>'."\n";
	echo 'Dodací lhůta: <input type="text" name="dodaci_lhuta" size="3" value="'.$row['dodaci_lhuta'].'"> dny<br><br>'."\n";
	echo 'Typ poštovného: <input type="text" name="postovne" size="3" value="'.$row['postovne'].'"><br><br>'."\n";
	echo 'Počet kusů skladem: <input type="text" name="kusu_skladem" size="3" value="'.$row['kusu_skladem'].'"><br><br>'."\n";
	echo 'Počet obrázků: <input type="text" name="obrazku" size="2" value="'.$row['obrazku'].'"><br><br>'."\n";
	if($row['zobrazovat']=='Y') { $checked='checked="checked"';} else { $checked='';}
	echo '<input type="checkbox" name="zobrazovat" '.$checked.'> Zobrazovat zákazníkům?<br><br>'."\n";
	if(isset($_GET['vlozit'])) 
	{
		echo '<input type="submit" name="vlozeno" value="Vložit záznam"><br><br>'."\n";
		echo '<input type="reset" name="reset" value="Reset"><br><br>'."\n";
	}
	elseif(isset($_GET['upravit']))
	{
		echo '<input type="submit" name="upraveno" value="Upravit záznam"><br><br>'."\n";
		echo '<input type="reset" name="reset" value="Reset"><br><br></form>'."\n";
		echo '<form method="get" action="'.URL_SPRAVA_SPERKY.'">'."\n";
		echo '<input type="submit" name="smazat" value="Smazat záznam"><br><br>'."\n";
		echo '<input type="hidden" name="id" value="'.$row['id'].'">'."\n";
		echo '<input type="hidden" name="kat_cislo" value="'.htmlspecialchars($row['kat_cislo'],ENT_QUOTES,'UTF-8').'">'."\n";
		echo '<input type="hidden" name="nazev" value="'.htmlspecialchars($row['nazev'],ENT_QUOTES,'UTF-8').'">'."\n";
	}
	echo '<p><a href='.URL_SPRAVA_SPERKY.'>Zpět na hlavní menu Šperků</a></p>'."\n";
	if(isset($_GET['upravit'])) 
	{
		echo '<br><form method="get" action="'.URL_SPRAVA_SPERKY.'">'."\n";
		echo '<input type="submit" name="vlozit" value="Nový záznam"><p> </p></form>'."\n";
	}
	echo '</form></b></td></tr></table>'."\n";
	// editace asociovaných obrázků
	if(isset($_GET['upravit'])) 
	{	
		echo '<br><table valign="top">'."\n";
		for($i=1; $i<=$row['obrazku']; $i++) 
		{
			$thumb = URL_PIC_PROD_THUMB.'id'.$row['id'].'_'.$i.'_thumb.jpg';
			$pic = URL_PIC_PROD_FULL.'id'.$row['id'].'_'.$i.'.jpg';
			echo '<tr><td width=70"><a href='.$pic.'><img src="'.$thumb.'"></a></td>'."\n";
			echo '<td width="600"><font color="red">'."\n";
			echo '<form enctype="multipart/form-data" method="post" action='.URL_SPRAVA_SPERKY.'>'."\n";
			if (file_exists(DIR_ROOT.$pic)) 
			{
				echo '<input type="file" name="pic_source" size="40"> '."\n";
				echo '<input type="submit" name="obrazek" value="Změnit obrázek č. '.$i.'">'."\n";
			}
			else 
			{
				echo '<p>Obrázek nenalezen, můžete jej vložit:</p><input type="file" name="pic_source" size="40"> '."\n";
				echo '<input type="submit" name="obrazek" value="Vlož obrázek č. '.$i.'">'."\n";
			}
			echo '<input type="hidden" name="pic_target" value="'.DIR_ROOT.$pic.'">'."\n";
			echo '<input type="hidden" name="thumb_target" value="'.DIR_ROOT.$thumb.'">'."\n";
			echo '</font></form></td></tr>'."\n";
		}
	}
}


// Vloží (=přejmenuje a překopíruje) soubor s obrázkem k produktu
// (výchozí a cílové jméno/cesta k souboru předáno pomocí POST)
elseif (isset($_POST['obrazek'])) 
{
	move_uploaded_file($_FILES['pic_source']['tmp_name'], $_POST['pic_target']) or die('Chyba při načítání souboru!');
	//Create the thumbnail
	//$newThumb = cropped_thumbnail($_POST['pic_target'],70,70); //include lib/graphics.php CENTERED THUMBNAIL
	$newThumb = cropped_thumbnail_BR($_POST['pic_target'],70,70); //include lib/graphics.php BOTTOM RIGHT THUMBNAIL
	// And display the image...
	imagejpeg($newThumb, $_POST['thumb_target'], 100);
	header('Refresh: 0; url="'.$_SERVER['HTTP_REFERER'].'"');
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
	//zameni desetinnou carku za tecku
	$post_vyr_naklady = str_replace(',','.',$_POST['vyr_naklady']);
	$post_vyr_cas = str_replace(',','.',$_POST['vyr_cas']);
	//
	$vypocet = new EvalMath;	// include lib/math.php (trida EvalMath; safe calculations)
	$vyr_naklady = $vypocet -> evaluate($post_vyr_naklady);
	$kalk_cena = ((CENA_HOD * $post_vyr_cas * FAKTOR_CAS) + ($post_vyr_naklady * FAKTOR_MATERIAL)) * FAKTOR_PREZENTACE;
	// nove zaznamy
	if(isset($_POST['vlozeno'])) 
	{
		$sql = 'INSERT INTO '.TB_SPERKY.' (datum_vloz,datum_zobraz,kat_cislo,nazev,kolekce,kategorie,popis,velikost,material,
		poznamka_int,poznamka_ext,akce,vyr_naklady,vyr_cas,kalk_cena,prodej_cena,dodaci_lhuta,postovne,kusu_skladem,obrazku,zobrazovat) 
 		VALUES (NOW(),
 		"'.mysql_real_escape_string($_POST["datum_zobraz"]).'",
 		"'.mysql_real_escape_string($_POST["kat_cislo"]).'",
 		"'.mysql_real_escape_string($_POST["nazev"]).'",
 		"'.mysql_real_escape_string($_POST["kolekce"]).'",
 		"'.mysql_real_escape_string($_POST["kategorie"]).'",
 		"'.mysql_real_escape_string($_POST["popis"]).'",
 		"'.mysql_real_escape_string($_POST["velikost"]).'",
 		"'.mysql_real_escape_string($_POST["material"]).'",
 		"'.mysql_real_escape_string($_POST["poznamka_int"]).'",
 		"'.mysql_real_escape_string($_POST["poznamka_ext"]).'",
 		"'.mysql_real_escape_string($_POST["akce"]).'",
 		"'.$vyr_naklady.'",
 		"'.mysql_real_escape_string($post_vyr_cas).'",
 		"'.$kalk_cena.'",
 		"'.mysql_real_escape_string($_POST["prodej_cena"]).'",
 		"'.mysql_real_escape_string($_POST["dodaci_lhuta"]).'",
 		"'.mysql_real_escape_string($_POST["postovne"]).'",
 		"'.mysql_real_escape_string($_POST["kusu_skladem"]).'",
 		"'.mysql_real_escape_string($_POST["obrazku"]).'",
 		"'.$zobrazovat.'")';
		$result = mysql_query($sql) or die(mysql_error()); 	
 	 	$result = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = (SELECT MAX(id) FROM '.TB_SPERKY.')') or die(mysql_error());
 	}
 	// editace stavajicich zaznamu
 	elseif(isset($_POST['upraveno'])) 
 	{
		$sql = 'UPDATE '.TB_SPERKY.' SET 
		datum_zobraz="'.mysql_real_escape_string($_POST['datum_zobraz']).'",	
		kat_cislo="'.mysql_real_escape_string($_POST['kat_cislo']).'",
		nazev="'.mysql_real_escape_string($_POST['nazev']).'",
		kolekce="'.mysql_real_escape_string($_POST['kolekce']).'",
		kategorie="'.mysql_real_escape_string($_POST['kategorie']).'",
		popis="'.mysql_real_escape_string($_POST['popis']).'",
		velikost="'.mysql_real_escape_string($_POST['velikost']).'",
		material="'.mysql_real_escape_string($_POST['material']).'",
		poznamka_int="'.mysql_real_escape_string($_POST['poznamka_int']).'",
		poznamka_ext="'.mysql_real_escape_string($_POST['poznamka_ext']).'",
		akce="'.mysql_real_escape_string($_POST['akce']).'",
		vyr_naklady="'.$vyr_naklady.'",
		vyr_cas="'.mysql_real_escape_string($post_vyr_cas).'",
		kalk_cena="'.$kalk_cena.'",
		prodej_cena="'.mysql_real_escape_string($_POST['prodej_cena']).'",
		dodaci_lhuta="'.mysql_real_escape_string($_POST['dodaci_lhuta']).'",
		postovne="'.mysql_real_escape_string($_POST['postovne']).'",
		kusu_skladem="'.mysql_real_escape_string($_POST['kusu_skladem']).'",
		obrazku="'.mysql_real_escape_string($_POST['obrazku']).'",
		zobrazovat="'.$zobrazovat.'" 
		WHERE id="'.$_POST['id'].'"';
		//echo($sql.'<br>'); exit();
		$result = mysql_query($sql) or die(mysql_error()); 	
 	 	$result = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$_POST['id']) or die(mysql_error());	 
 	}	
 	$row = mysql_fetch_array($result); 
	//$page = URL_SPRAVA_SPERKY.'?upravit=&id='.$row['id'];
	create_values_table('kategorie');
	create_values_table('kolekce');
	header('Refresh: 0; url="'.URL_SPRAVA_SPERKY.'?upravit=&id='.$row['id'].'"');
}


// Smaže produkt z databáze (ID předáno pomocí GET)
elseif(isset($_GET['smazat'])) 
{
	// smazat (potvrzena akce)
	if($_GET['potvrzeno']=='Ano') 
	{
		mysql_query('DELETE FROM '.TB_SPERKY.' WHERE id='.$_GET['id']) or die(mysql_error());
		create_values_table('kategorie');
		create_values_table('kolekce');
		header('Refresh: 0; url="'.URL_SPRAVA_SPERKY.'"');	
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
		echo '<b><font color="red"><form method="get" action="'.URL_SPRAVA_SPERKY.'">'."\n";
		echo 'Tento krok nejde vrátit!<br><br>Opravdu chcete z databáze smazat tento produkt?<br><br>"'
			.htmlspecialchars($_GET['nazev'], ENT_QUOTES, 'UTF-8').'"<br>('
			.htmlspecialchars($_GET['kat_cislo'],ENT_QUOTES,'UTF-8').')<br><br>'."\n";
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
		$orderby = 'datum_uprav';  //default
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
		$filtr=array('kat_cislo' => $_GET['kat_cislo'],
		'nazev' => $_GET['nazev'],
		'kolekce' => $_GET['kolekce'],
		'kategorie' => $_GET['kategorie'],
		'popis' => $_GET['popis']);
		// cteni
		$sql = 'SELECT * FROM `'.TB_SPERKY.'` WHERE 
			kat_cislo LIKE "%'.mysql_real_escape_string($filtr['kat_cislo']).'%" &&
			nazev LIKE "%'.mysql_real_escape_string($filtr['nazev']).'%" &&
			kolekce LIKE "%'.mysql_real_escape_string($filtr['kolekce']).'%" &&
			kategorie LIKE "%'.mysql_real_escape_string($filtr['kategorie']).'%" &&
			popis LIKE "%'.mysql_real_escape_string($filtr['popis']).'%"
			ORDER BY '.mysql_real_escape_string($orderby).' '.mysql_real_escape_string($order_ascdesc);
		$result = mysql_query($sql) or die(mysql_error());		
	}
	else 
	{
		$result = mysql_query('SELECT * FROM `'.TB_SPERKY.'` ORDER BY '.mysql_real_escape_string($orderby)
			.' '.mysql_real_escape_string($order_ascdesc)) or die(mysql_error());	
	}
	// zahlavi tabulky
	$header = array('Obrázky', 'Kat. č.', 'Název', 'Kolekce', 'Kategorie', 'Popis', 'Cena');
	$keys = array('kat_cislo', 'nazev', 'kolekce', 'kategorie', 'popis', 'prodej_cena');
	$n_cols = count($header);
	echo '<form method="get" action="'.URL_SPRAVA_SPERKY.'">'."\n";
	echo '<p><input type="submit" name="vlozit" value="Nový záznam"></form>'."\n";
	echo '<a href="'.URL_SPRAVA.'"><b>Zpět na hlavní menu Správy</b></a></p>'."\n";
	echo '<table width="100%"><tr><td>#</td>'."\n";
	for($i=0; $i<$n_cols; $i++) {	
		echo '<td><b>'.$header[$i].'</b></td>'."\n";
	}
	echo '<td colspan="2" align="center"><form method="post" action="'.URL_SPRAVA_SPERKY.'">'."\n";
	echo '<input type="submit" name="resetovat" value="Resetuj filtr"></form></td></tr>'."\n";
	// filtr
	echo '<tr><form method="get" action="'.URL_SPRAVA_SPERKY.'">'."\n";
	
	echo '<td></td><td colspan="7"><select name="radit">'."\n";
	if($orderby=='datum_vloz') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="datum_vloz" '.$selected.'>Datum vložení</option>'."\n";
	if($orderby=='datum_uprav') { $selected='selected="selected"';} else { $selected='';}	
	echo '<option value="datum_uprav" '.$selected.'>Datum poslední editace</option>'."\n";
	if($orderby=='datum_zobraz') { $selected='selected="selected"';} else { $selected='';}	
	echo '<option value="datum_zobraz" '.$selected.'>Datum zveřejnění</option>'."\n";
	if($orderby=='kat_cislo') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="kat_cislo" '.$selected.'>Katalogové číslo</option>'."\n";
	if($orderby=='nazev') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="nazev" '.$selected.'>Název</option>'."\n";
	if($orderby=='kolekce') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="kolekce" '.$selected.'>Kolekce</option>'."\n";
	if($orderby=='kategorie') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="kategorie" '.$selected.'>Kategorie zboží</option>'."\n";
	if($orderby=='popis') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="popis" '.$selected.'>Popis</option>'."\n";
	if($orderby=='velikost') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="velikost" '.$selected.'>Délka</option>'."\n";	
	if($orderby=='material') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="material" '.$selected.'>Materiál</option>'."\n";
	if($orderby=='poznamka_int') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="poznamka_int" '.$selected.'>Interní poznámka</option>'."\n";
	if($orderby=='poznamka_ext') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="poznamka_ext" '.$selected.'>Externí poznámka</option>'."\n";
	if($orderby=='akce') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="akce" '.$selected.'>Akce</option>'."\n";
	if($orderby=='vyr_naklady') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="vyr_naklady" '.$selected.'>Výrobní náklady</option>'."\n";
	if($orderby=='vyr_cas') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="vyr_cas" '.$selected.'>Čas na výrobu</option>'."\n";	
	if($orderby=='kalk_cena') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="kalk_cena" '.$selected.'>Kalkulovaná cena</option>'."\n";	
	if($orderby=='prodej_cena') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="prodej_cena" '.$selected.'>Prodejní cena</option>'."\n";
	if($orderby=='dodaci_lhuta') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="dodaci_lhuta" '.$selected.'>Dodací lhůta</option>'."\n";
	if($orderby=='postovne') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="postovne" '.$selected.'>Typ poštovného</option>'."\n";
	if($orderby=='kusu_skladem') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="kusu_skladem" '.$selected.'>Počet kusů skladem</option>'."\n";
	if($orderby=='obrazku') { $selected='selected="selected"';} else { $selected='';}
	echo '<option value="obrazku" '.$selected.'>Počet obrázků</option>'."\n";	
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
	echo '<td></td></td><td></td>'."\n";
	echo '<td><input type="text" name="kat_cislo" size="10" value="'.
		htmlspecialchars($filtr['kat_cislo'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="nazev" size="10" value="'.
		htmlspecialchars($filtr['nazev'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="kolekce" size="10" value="'.
		htmlspecialchars($filtr['kolekce'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="kategorie" size="10" value="'.
		htmlspecialchars($filtr['kategorie'], ENT_QUOTES, 'UTF-8').'"></td>'."\n";
	echo '<td><input type="text" name="popis" size="15" value="'.
		htmlspecialchars($filtr['popis'], ENT_QUOTES, 'UTF-8').'"></form></td>'."\n";
	// zobrazi produkty
	$count = 1;
	while($row = mysql_fetch_array($result)) 
	{
		if($row['zobrazovat']!='Y') { $td_col = 'class="hidden"';} 
		elseif($row['kusu_skladem']==0) { $td_col = 'class="vyprodano"';}
		else {$td_col ='';}
		echo '<tr '.$td_col.'><td>'.$count.'</td>'."\n";
		$count += 1;
		$thumb = URL_PIC_PROD_THUMB.'id'.$row['id'].'_1_thumb.jpg';
		$pic = URL_PIC_PROD_FULL.'id'.$row['id'].'_1.jpg';
		echo '<td><a href="'.$pic.'"><image src="'.$thumb.'"></a> '.$row['obrazku'].'</td>'."\n";		
		for($i=0; $i<($n_cols-1); $i++) 
		{
			echo '<td>'.htmlspecialchars($row[$keys[$i]], ENT_QUOTES, 'UTF-8').'</td>'."\n";
		}
		echo '<td><a href="'.URL_SPRAVA_SPERKY.'?upravit=&id='.$row['id'].'">uprav</a></td>'."\n";
		echo '<td><a href="'.URL_SPRAVA_SPERKY.'?smazat=&id='.$row['id'].'&nazev='.htmlspecialchars($row['nazev'], ENT_QUOTES,
			'UTF-8').'&kat_cislo='.htmlspecialchars($row['kat_cislo'], ENT_QUOTES, 'UTF-8').'">smaž</a></td>'."\n";
		echo '</tr>'."\n";
	}
	echo '</table>'."\n";
}


mysql_close($con);
?>
</body>
</html>
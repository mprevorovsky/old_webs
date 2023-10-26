<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
	
	include_once(DIR_TEMPLATE.'_includes.php');

	// page-specific meta data
	$result = mysql_query('SELECT * FROM `'.TB_SPERKY.'` WHERE id="'.mysql_real_escape_string($_GET['id']).'"') or die(mysql_error());
	$row = mysql_fetch_array($result);

	//pokud se někdo pokusí o přímý přístup ke schovaným záznamům, bude přesměrován na přehled všech produktů 	
	if(($row['zobrazovat'] == "N") || ($row['obrazku'] < 1) || ($row['datum_zobraz'] > date('Y-m-d'))) 
	{
		header( 'Location: /sperky-prehled.php' ) ;
	}
	
	$pagetitle = $row['kategorie'].' '.$row['nazev'].' | Ručně vyráběné šperky z polodrahokamů a korálků';
	$keywords = str_replace(';', ',', $row['kategorie'].' , '.$row['material']);
	$description = $row['kategorie'].': '.$row['nazev'].' | '.$row['popis'].' | Cena: '.$row['prodej_cena'].' Kč';

	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_sperky_detail">	
	<?php
		$result = mysql_query('SELECT * FROM `'.TB_SPERKY.'` WHERE id="'.mysql_real_escape_string($_GET['id']).'"') or die(mysql_error());
		$row = mysql_fetch_array($result);
		$cena = explode('.', $row['prodej_cena']);
		
		// pokud je daný produkt novinka, bude označen watermarkem pro novinky
		$novinka = '';
		$result_new = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$row['id'].' 
			&& datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
		if(mysql_fetch_array($result_new))			
		{
			$novinka = '&new=Y';
		}
		
		if(isset($_GET['pic_no'])) //implicitně použije obrázek č. 1 
		{
			$pic_no = mysql_real_escape_string($_GET['pic_no']);
		}
		else 
		{
			$pic_no = 1;
		}
		$source_pic = DIR_ROOT.URL_PIC_PROD_FULL.'id'.$row['id'].'_'.$pic_no.'.jpg'; 
		echo '<table width="100%"><tr valign="top"><td colspan="2">'."\n";
		echo '<h1>'.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'</h1><p style="font-size:85%;margin:-12px 0px -6px 0px">
			Katalogové číslo: '.htmlspecialchars($row['kat_cislo'], ENT_QUOTES, 'UTF-8').'</p>'."\n";
		echo '</td></tr><tr valign="top"><td width="410">'."\n";
		if(file_exists($source_pic)) //přidá odkaz na obrázek v plné velikosti pouze pokud cílový soubor existuje
		{
			echo '<a href="/watermark.php?id='.$row['id'].'&pic_no='.htmlspecialchars($pic_no, ENT_QUOTES, 'UTF-8')
				.'" title="Klikni pro plnou velikost" target="_blank">'."\n";
		}
		echo '<image src="/generate_thumb.php?id='.$row['id'].'&pic_no='.htmlspecialchars($pic_no, ENT_QUOTES, 'UTF-8')
			.'&width=400&height=400'.$novinka.'" class="sperky_detail" 
			width="400" height="400" alt="Obrázek šperku: '.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'">'."\n";
		if(file_exists($source_pic)) //ukončení odkazu
		{
			echo '</a>';
		}
		if($row['obrazku'] > 1) 
		{
			for($i = 1; $i <= $row['obrazku']; $i += 1)
			{
				if($i != $pic_no) 
				{
					echo '<a href="/sperky-detail.php?id='.$row['id'].'&pic_no='.$i.'" title="Zobrazit obrázek č. '.$i.'">';
					echo '<image src="/generate_thumb.php?id='.$row['id'].'&pic_no='.$i.'&width=70&height=70" 
						class="sperky_detail" width="70" height="70" alt="Obrázek č. '.$i.'"></a>'."\n";
				}
			}
		}				
		echo '</td><td>'."\n";
		echo '<p style="margin-top:-10px;"><b>Typ šperku: </b>'.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').'</p>'."\n";		
		echo '<p><b>Popis:</b> '.str_replace("\n",'<br>',htmlspecialchars($row['popis'], ENT_QUOTES, 'UTF-8')).'</p>'."\n";

		if($row['velikost']) 
		{
			echo '<p><b>Délka:</b> '.str_replace("\n",'<br>',htmlspecialchars($row['velikost'], ENT_QUOTES, 'UTF-8')).'</p>'."\n";
		}
		
		echo '<p><b>Materiál:</b> '.str_replace("\n",'<br>',htmlspecialchars($row['material'], ENT_QUOTES, 'UTF-8')).'</p>'."\n";
		echo '<p><b>Kolekce:</b> '.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').'</p>'."\n";

		if($row['poznamka_ext']) 
		{
			echo '<p><b>Poznámka:</b> '.str_replace("\n",'<br>',htmlspecialchars($row['poznamka_ext'], ENT_QUOTES, 'UTF-8')).'</p>'."\n";;
		}

		if($row['kolekce'] == 'Zakázková') // zobrazí poznámku o špatné dostupnosti u této kolekce
		{
			echo '<p><b>Poznámka:</b> Šperky z této kolekce obsahují obtížně dostupné, popř. nenahraditelné materiály a jsou zde 
				vystaveny především pro ilustraci naší tvorby.</p>'."\n";;
		}

		echo '<p><b>Dostupnost:</b> ';
		if($row['kusu_skladem'] < 1)
		{
			echo 'Pro dostupnost zboží nás, prosím, <a href="/kontakt.php" title="Kontaktní informace, adresa prodejny">kontaktujte</a>.</p>'."\n";
		}
		else 
		{
			echo 'skladem</p>'."\n";	
		}

		echo '<p style="font-size:110%;"><b>Cena: </b>';
		if($cena[0] > 0) 
		{
			echo $cena[0].' Kč';
		}
		else 
		{
			echo 'neuvedena';
		}
		echo '</p><p style="font-size:110%;text-align:center;font-weight:bold;"><a href="mailto:objednavky&#64;barevne-svetlo&#46;cz?subject=Objednávka&
				body=Z nabídky prodejní galerie Barevné světlo objednávám%0A%0ANázev výrobku:&nbsp;'.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'%0A
				Katalogové číslo:&nbsp;'.htmlspecialchars($row['kat_cislo'], ENT_QUOTES, 'UTF-8').'%0A
				Počet kusů:&nbsp;1%0A%0ADoručovací adresa (pro zásilkový prodej):&nbsp;%0A%0APoznámka:&nbsp;%0A%0A
				Potvrďte prosím obratem mou objednávku a zašlete instrukce pro provedení platby.%0A%0AS pozdravem%0A%0A" 
				title="objednavky&#64;barevne-svetlo&#46;cz">Objednat</a></p>'."\n";

		// odkaz Zpět
		if(strpos(strtolower($_SERVER['HTTP_REFERER']), 'sperky-prehled.php') != false)
		{ //pokud jde o přímý přechod z Přehledu šperků, vrátí se na REFERER stránku (nejde použít pro ostatní případy, došlo by k zacyklení)
			$zpet = $_SERVER['HTTP_REFERER'];
		}
		else //defaultne přejde na příslušnou kolekci
		{
			$zpet = '/sperky-prehled.php?kolekce='.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8');
		}
		echo '<p style="position:absolute;top:0px;right:0px;">';
		echo '<a href="'.$zpet.'" title="Zpět na katalog šperků">Zpět</a></p>'."\n";
		echo '<p></p><p style="position:absolute;bottom:0px;right:0px;">';
		echo '<a href="'.$zpet.'" title="Zpět na katalog šperků">Zpět</a></p>'."\n";
		echo '</td></tr></table>'."\n";
	?>
</div>

<!-- Procházení katalogu vpřed/vzad -->
<div id="katalog_browse">
	<?php
		$result = mysql_query('SELECT * FROM `'.TB_SPERKY.'` WHERE kat_cislo<"'.$row['kat_cislo'].'" 
			&& zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE() 
			ORDER BY kat_cislo DESC LIMIT 1') or die(mysql_error());
		$prev = mysql_fetch_array($result);
		if($prev['id']) //pokud existuje záznam s nižším katalogovým číslem
		{
			// pokud je daný produkt novinka, bude označen watermarkem pro novinky
			$novinka = '';
			$result_new = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$prev['id'].' 
				&& datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
			if(mysql_fetch_array($result_new))			
			{
				$novinka = '&new=Y';
			}
			
			echo '<a href="/sperky-detail.php?id='.$prev['id'].'" title="Zobrazit předcházející šperk v katalogu"><p><b>‹‹‹</b></p></a>'."\n";
			echo '<a href="/sperky-detail.php?id='.$prev['id'].'" title="'.htmlspecialchars($prev['nazev'], ENT_QUOTES, 'UTF-8')
				.' (kolekce '.$prev['kolekce'].')">';
			echo '<image src="/generate_thumb.php?id='.$prev['id'].'&width=101&height=101'.$novinka.'" class="katalog_browse"
				width="101" height="101" alt="'.htmlspecialchars($prev['nazev'], ENT_QUOTES, 'UTF-8').'"></a>'."\n";
		}
		echo '<p>Procházet katalog šperků</p>'."\n";
		$result = mysql_query('SELECT * FROM `'.TB_SPERKY.'` WHERE kat_cislo>"'.$row['kat_cislo'].'" 
			&& zobrazovat="Y"  && obrazku > 0 && datum_zobraz <= CURDATE() 
			ORDER BY kat_cislo ASC LIMIT 1') or die(mysql_error());
		$next = mysql_fetch_array($result);
		if($next['id'])  //pokud existuje záznam s vyšším katalogovým číslem
		{
			// pokud je daný produkt novinka, bude označen watermarkem pro novinky
			$novinka = '';
			$result_new = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$next['id'].' 
				&& datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
			if(mysql_fetch_array($result_new))			
			{
				$novinka = '&new=Y';
			}
			
			echo '<a href="/sperky-detail.php?id='.$next['id'].'" title="'.htmlspecialchars($next['nazev'], ENT_QUOTES, 'UTF-8')
				.' (kolekce '.$next['kolekce'].')">';
			echo '<image src="/generate_thumb.php?id='.$next['id'].'&width=101&height=101'.$novinka.'" class="katalog_browse"
				width="101" height="101" alt="'.htmlspecialchars($next['nazev'], ENT_QUOTES, 'UTF-8').'"></a>'."\n";
			echo '<a href="/sperky-detail.php?id='.$next['id'].'" title="Zobrazit následující šperk v katalogu"><p><b>›››</b></p></a>'."\n";
		}
	?>
</div>

<?php 
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

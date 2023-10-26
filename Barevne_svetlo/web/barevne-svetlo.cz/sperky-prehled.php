<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');

	include_once(DIR_TEMPLATE.'_includes.php');

	// nastavení stránkování	
	if(isset($_GET["page"])) 
	{
		$page = intval($_GET["page"]);
	}
	else
	{
		$page = 1;
	}
	$page_offset = SPERKU_NA_STRANKU * ($page - 1); // posun v zobrazených záznamech dle stránkování
	$from = SPERKU_NA_STRANKU * ($page - 1) + 1; // zobrazit záznamy č. $from až č. $to
	$to = SPERKU_NA_STRANKU * ($page - 1) + SPERKU_NA_STRANKU;

	// page-specific meta data (escaping by htmlspecialchars is done in _header.php !!!
	$pagetitle = 'Ručně vyráběné šperky z polodrahokamů a korálků | '.$page;
	if(isset($_GET['novinky']))
	{
		$pagetitle = 'Nejnovější šperky v naší nabídce | '.$pagetitle;
	}
	elseif(isset($_GET['kategorie'])) 
	{
		$pagetitle = 'Typ šperku: '.$_GET['kategorie'].' | '.$pagetitle;
	}
	elseif(isset($_GET['kolekce'])) 
	{
		$pagetitle = 'Kolekce: '.$_GET['kolekce'].' | '.$pagetitle;
	}	
	$keywords = 'katalog šperků';
	$description = 'Zalistujte katalogem šperků v nabídce naší prodejní galerie. 
		Polodrahokamy, korálky - ruční výroba, originální designy, limitované série (str. '.$page.').';

	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_sperky_prehled">	
	<?php
		if(isset($_GET['orderby'])) // nastavení řazení produktů
		{
			$orderby = $_GET['orderby'];
		}
		else 
		{
			$orderby = 'datum_zobraz';
		}
		if(isset($_GET['orderby'])) 
		{
			$order_ascdesc = $_GET['ascdesc'];
		}
		else 
		{
			$order_ascdesc = 'DESC';
		}
		$zahlavi = '<a href="/sperky-prehled.php" title="Kompletní katalog šperků">Šperky</a>'; // defaultní záhlaví
		$filtr_by = 'No'; // defaultně nezobrazovat filtr produktů
		
		// výsledky vyhledávání
		if($_GET['searchfor'] != '')
		{
			$display_by = 'searchfor';
			$zahlavi= $zahlavi.' » <a href="'.$_SERVER['HTTP_referer'].'"
				title="Výsledky hledání pro výraz &quot;'.htmlspecialchars($_GET['searchfor'], ENT_QUOTES, 'UTF-8')
				.'&quot;">"'.htmlspecialchars($_GET['searchfor'], ENT_QUOTES, 'UTF-8').'"</a>';
			$query_searchfor = '	&& (popis LIKE "%'.mysql_real_escape_string($_GET['searchfor']).'%" OR
				nazev LIKE "%'.mysql_real_escape_string($_GET['searchfor']).'%" OR
				material LIKE "%'.mysql_real_escape_string($_GET['searchfor']).'%" OR 
				kat_cislo LIKE "%'.mysql_real_escape_string($_GET['searchfor']).'%") ';
		}		
		
		// novinky
		elseif(isset($_GET['novinky'])) 
		{
			$display_by = 'novinky';
			$zahlavi= $zahlavi.' » <a href="/sperky-prehled.php?novinky=yes" title="Nejnovější šperky v naší nabídce">Novinky</a>';
			$query_novinky = ' && datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month) ';
		}

		// kolekce
		elseif(isset($_GET['kolekce'])) 
		{
			$zahlavi= $zahlavi.' » <a href="/sperky-prehled.php?kolekce='.htmlspecialchars($_GET['kolekce'], ENT_QUOTES, 'UTF-8')
				.'" title="Autorská kolekce: '.htmlspecialchars($_GET['kolekce'], ENT_QUOTES, 'UTF-8').'">'
				.htmlspecialchars($_GET['kolekce'], ENT_QUOTES, 'UTF-8').'</a>';
			$filtr_by = 'kategorie';
			$display_by = 'kolekce';
			
			$filtr_result = mysql_query('SELECT '.$filtr_by.' FROM `'.$filtr_by) or die(mysql_error());
			$filtr_query = ' && (';
			$counter = 0;
			while($filtr_row = mysql_fetch_array($filtr_result)) 
			{			
				if(isset($_GET['filtr_'.str_replace(' ', '+', $filtr_row[$filtr_by])])) // pozitivní filtr (přidávání záznamů)
				{
					if($counter > 0) 
					{
						$filtr_query = $filtr_query.' OR '; // alespoň jedna podmínka splněna
					}
					$filtr_query = $filtr_query.$filtr_by.' LIKE "%'.mysql_real_escape_string($filtr_row[$filtr_by]).'%"';
					$counter += 1;
				}
			}
			if($filtr_query == ' && (') // pokud odškrtnuta všechna políčka filtru, nezobrazuj nic
			{
				$filtr_query = $filtr_query.'kategorie = "nicnezobrazovat")';
			}
			else // pokud filtr aktivní a něco zaškrtnuto
			{
				$filtr_query = $filtr_query.') ';
			}
			if(!isset($_GET['filtrovat'])) // pokud filtr neaktivní, zobraz vše
			{
				$filtr_query = '';
			}
			//echo '<p>'.$filtr_query.'</p>';

			$query_kolekce = ' && kolekce="'.mysql_real_escape_string($_GET['kolekce']).'" '.$filtr_query.' ';
		}
		
		// kategorie
		elseif(isset($_GET['kategorie'])) 
		{
			$filtr_by = 'kolekce';
			$display_by = 'kategorie';
			
			$filtr_result = mysql_query('SELECT '.$filtr_by.' FROM `'.$filtr_by) or die(mysql_error());
			$filtr_query = ' && (';
			$counter = 0;
			while($filtr_row = mysql_fetch_array($filtr_result)) 
			{			
				if(!isset($_GET['filtr_'.str_replace(' ', '+', $filtr_row[$filtr_by])]))  // negativní filtr (vylučování záznamů)
				{
					if($counter > 0) 
					{
						$filtr_query = $filtr_query.' && '; // všechny podmínky platí zároveň
					}
					$filtr_query = $filtr_query.$filtr_by.' != "'.mysql_real_escape_string($filtr_row[$filtr_by]).'"';
					$counter += 1;
				}
			}
			if(($filtr_query == ' && (') || (!isset($_GET['filtrovat']))) 
			{
				$filtr_query = '';
			}
			else 
			{
				$filtr_query = $filtr_query.') ';
			}
			//echo '<p>'.$filtr_query.'</p>';
			
			$zahlavi= $zahlavi.' » <a href="/sperky-prehled.php?kategorie='.htmlspecialchars($_GET['kategorie'], ENT_QUOTES, 'UTF-8')
				.'" title="Typ šperku: '.htmlspecialchars($_GET['kategorie'], ENT_QUOTES, 'UTF-8')
				.'">'.htmlspecialchars($_GET['kategorie'], ENT_QUOTES, 'UTF-8').'</a>';
			$query_kategorie = ' && kategorie LIKE "%'.mysql_real_escape_string($_GET['kategorie']).'%" '.$filtr_query.' ';
		}
		
		$query_full = 'SELECT * FROM `'.TB_SPERKY.'` WHERE zobrazovat="Y" && obrazku > 0	&& datum_zobraz <= CURDATE() '
			.$query_searchfor
			.$query_novinky
			.$query_kolekce
			.$query_kategorie
			.' ORDER BY '.mysql_real_escape_string($orderby).' '.mysql_real_escape_string($order_ascdesc);
		//echo $query_full;
		$result = mysql_query($query_full) or die(mysql_error());
		$no_found= mysql_num_rows($result);
		
		// záhlaví hlavního obsahu a filtr
		// + stránkování
		if($no_found > SPERKU_NA_STRANKU) // jen pokud má stránkování význam 
		{
			parse_str($_SERVER['QUERY_STRING'], $query_string);
			$query_string['page'] = 1;
			$first_page_query = http_build_query($query_string); // querystring pro první stránku
			$query_string['page'] = intval($no_found / SPERKU_NA_STRANKU);
			if($no_found % SPERKU_NA_STRANKU > 0) 
			{
				$query_string['page'] += 1;
			}
			$last_page_query = http_build_query($query_string); // querystring pro poslední stránku
			if($no_found >= (($page * SPERKU_NA_STRANKU) + 1)) 
			{		
				$query_string['page'] = $page + 1;
				$next_page_query = http_build_query($query_string); // querystring pro následující stránku
			}
			if((($page - 1) * SPERKU_NA_STRANKU) > 0)
			{
				$query_string['page'] = $page - 1;
				$prev_page_query = http_build_query($query_string); // querystring pro předcházející stránku
			}
		}
		echo '<table width="100%">';
		echo '<tr><td class="sperky_prehled" colspan="4" style="text-align:left;">'."\n";
		echo '<p><b>'.$zahlavi.'</b><br>Nalezených produktů: <b>'.$no_found.'</b> (';
		if($no_found == 0) // pokud nic nenalezeno, zobrazí se nula
		{
			echo $no_found;
		}
		else 
		{
			echo $from;	
		}
		if($from != $no_found && $no_found > 0) // pokud je na stránce jen 0-1 záznam, nezobrazí se rozpětí od-do
		{
			echo '-'.min($to, $no_found);
		}
		echo ')'."\n";
		if(isset($last_page_query)) // stránkování jen pokud je co stránkovat
		{
			echo '<b><span style="font-size:130%;position:absolute;top:10px;right:10px;">';
			if(isset($prev_page_query)) 
			{
				echo '<a href="/sperky-prehled.php?'.$first_page_query.'" title="Přejít na první stránku">«</a>&nbsp;'."\n";
				echo '<a href="/sperky-prehled.php?'.$prev_page_query.'" title="Přejít o 1 stránku zpět">‹</a>&nbsp;'."\n";
			}
			else 
			{
				echo '«&nbsp;&nbsp;‹&nbsp;'."\n"; //neaktivní verze navigačních symbolů
			}
			if(isset($next_page_query)) 
			{
				echo '&nbsp;<a href="/sperky-prehled.php?'.$next_page_query.'" title="Přejít o 1 stránku vpřed">›</a>'."\n";
				echo '&nbsp;<a href="/sperky-prehled.php?'.$last_page_query.'" title="Přejít na poslední stránku">»</a>'."\n";
			}
			else 
			{
				echo '&nbsp;›&nbsp;&nbsp;»'."\n"; //neaktivní verze navigačních symbolů
			}
			echo '</span></b>';
		}	
		echo '</p><form method="get" action="/sperky-prehled.php" class="filtr">'."\n";
		if($filtr_by != "No") // zobrazení filtru
		{
			if($filtr_by == 'kategorie')
			{
				$relevant = get_relevant_kategorie($_GET[$display_by]);
			}
			elseif($filtr_by == 'kolekce') 
			{
				$relevant = get_relevant_kolekce($_GET[$display_by]);
			}
			echo '<table cellspacing="0"><tr><td nowrap valign="top"><b>Filtrovat zobrazení:</b>&nbsp;</td><td>'."\n";
			$filtr_result = mysql_query('SELECT '.$filtr_by.' FROM `'.$filtr_by.'` ORDER BY '.$filtr_by.' ASC') or die(mysql_error());
			while($filtr_row = mysql_fetch_array($filtr_result)) 
			{	
				if(in_array($filtr_row[$filtr_by], $relevant)) 
				{
					$checked = 'checked="checked"';			
					if(isset($_GET['filtrovat'])) 
					{
						if(!isset($_GET['filtr_'.str_replace(' ', '+', $filtr_row[$filtr_by])])) 
						{
							$checked='';
						}
					}
					echo '<input type="checkbox" name="filtr_'.htmlspecialchars(str_replace(' ', '+', $filtr_row[$filtr_by]), ENT_QUOTES, 'UTF-8')
						.'" value="" class="" '.$checked.'><i>'.htmlspecialchars($filtr_row[$filtr_by], ENT_QUOTES, 'UTF-8').'</i>'."\n";
				}
			}	
			echo '</td></tr></table>';		
		}
			 // pro zapamatování obsahu stráky (novinky, kolekce...)
		echo '<input type="hidden" name="'.$display_by.'" value="'.htmlspecialchars($_GET[$display_by], ENT_QUOTES, 'UTF-8').'">'."\n";
		echo '<b>Řadit podle:</b>&nbsp;';
		echo '<select name="orderby">'."\n"; 
			// roletové menu pro řazení
		if($orderby=='datum_zobraz') { $selected='selected="selected"';} else { $selected='';}
		echo '<option value="datum_zobraz" '.$selected.'>Data vložení</option>'."\n";
		if($orderby=='nazev') { $selected='selected="selected"';} else { $selected='';}
		echo '<option value="nazev" '.$selected.'>Názvu</option>'."\n";
		if($orderby=='prodej_cena') { $selected='selected="selected"';} else { $selected='';}
		echo '<option value="prodej_cena" '.$selected.'>Ceny</option>'."\n";
		echo '</select>'."\n";	
		echo '<select name="ascdesc">'."\n";
		if($order_ascdesc=='ASC') { $selected='selected="selected"';} else { $selected='';}
		echo '<option value="ASC" '.$selected.'>vzestupně</option>'."\n";
		if($order_ascdesc=='DESC') { $selected='selected="selected"';} else { $selected='';}
		echo '<option value="DESC" '.$selected.'>sestupně</option>'."\n";
		echo '</select>'."\n";
		echo '<table style="float:right; margin:-2px -8px 2px 0px;"><tr><td align="right">
			<input type="submit" name="filtrovat" value="" class="submit_zobraz" title="Upravit vlastnosti zobrazení"></td></tr></table>'."\n";
		echo '</form></td></tr><tr>'."\n";
		
		// zobrazení vyhledaných produktů
		$counter = 1;
		while($row = mysql_fetch_array($result)) 
		{
			if($counter >= $from && $counter <= $to)
			{	
				if((($counter % 4) == 1) && ($counter != $from)) { echo '</tr><tr>'."\n"; } // zalomí řádek po každém 4. produktu 
				echo '<td class="sperky_prehled"><p><a href="/sperky-detail.php?id='.$row['id'].'" title="Zobrazit detailní informace o šperku">'
					.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'</a></p>'."\n";
				echo '<a href="/sperky-detail.php?id='.$row['id'].'" title="'.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8')
					.' (kolekce '.$row['kolekce'].')">'."\n";
				
				// pokud je daný produkt novinka, bude označen watermarkem pro novinky
				$novinka = '';
				$result_new = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$row['id'].' 
					&& datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
				if(mysql_fetch_array($result_new))			
				{
					$novinka = '&new=Y';
				}

				echo '<image src="/generate_thumb.php?id='.$row['id'].'&pic_no=1&width=146&height=146'.$novinka.'" 
					class="sperky_prehled" alt="'.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').'" width="146" height="146"></a>'."\n";
				echo '<p style="font-size:90%">'.$row['kategorie'].'<br>'."\n";

				$cena=explode('.', $row['prodej_cena']);
				// pokud cena=0 -> zobrazí text 'neuvedena'
				echo 'Cena:<b> ';
				if($cena[0] > 0) 
				{
					echo $cena[0].' Kč';
				}
				else 
				{
					echo 'neuvedena';
				}
				echo '</b></p></td>'."\n";				
			}	
			$counter += 1;
		}
		while(($counter % 4) != 1 && $counter <= $to) // doplní až 3 prázdné buňky pro správné formátování daného řádku s produkty
		{
			echo '<td>&nbsp;</td>';
			$counter += 1;
		}
	?>	
	</tr></table>
</div>

<?php 
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

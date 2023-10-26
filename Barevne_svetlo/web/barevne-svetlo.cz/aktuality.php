<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');	
		
	include_once(DIR_TEMPLATE.'_includes.php'); 

	// page-specific meta data
	$pagetitle = 'Kompletní přehled aktuálního dění';
	$keywords = 'aktuality';
	$description = 'Zalistujte v kompletním přehledu aktualit z prodejní galerie ručně vyráběných 
		šperků z polodrahokamů a korálků.';
	
	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">	
	<img src="<?php echo URL_PIC; ?>napis_aktuality.png" alt="Aktuality" 
		style="margin: 6px; width:97px; height:28px; float:right;">
	<p class="content_head">Kompletní archiv aktualit</p>
	
	<?php
		if(isset($_GET["page"])) // nastavení stránkování
		{
			$page = intval($_GET["page"]);
		}
		else
		{
			$page = 1;
		}
		$page_offset = AKTUALIT_NA_STRANKU * ($page - 1); // posun v zobrazených záznamech dle stránkování
		$from = AKTUALIT_NA_STRANKU * ($page - 1) + 1; // zobrazit záznamy č. $from až č. $to
		$to = AKTUALIT_NA_STRANKU * ($page - 1) + AKTUALIT_NA_STRANKU;		
		
		// databázový dotaz
		$result = mysql_query('SELECT * FROM '.TB_AKTUALITY.' WHERE zobrazovat = "Y"
			ORDER BY datum DESC') or die(mysql_error());
		$no_found= mysql_num_rows($result);	
		
		// stránkování
		if($no_found > AKTUALIT_NA_STRANKU) // jen pokud má stránkování význam 
		{
			parse_str($_SERVER['QUERY_STRING'], $query_string);
			$query_string['page'] = 1;
			$first_page_query = http_build_query($query_string); // querystring pro první stránku
			$query_string['page'] = intval($no_found / AKTUALIT_NA_STRANKU);
			if($no_found % AKTUALIT_NA_STRANKU > 0) 
			{
				$query_string['page'] += 1;
			}			
			$last_page_query = http_build_query($query_string); // querystring pro poslední stránku
			if($no_found >= (($page * AKTUALIT_NA_STRANKU) + 1)) 
			{		
				$query_string['page'] = $page + 1;
				$next_page_query = http_build_query($query_string); // querystring pro následující stránku
			}
			if((($page - 1) * AKTUALIT_NA_STRANKU) > 0)
			{
				$query_string['page'] = $page - 1;
				$prev_page_query = http_build_query($query_string); // querystring pro předcházející stránku
			}

			echo '<b><span style="font-size:130%;position:absolute;top:40px;right:10px;">';
			if(isset($prev_page_query)) 
			{
				echo '<a href="/aktuality.php?'.$first_page_query.'" title="Přejít na první stránku">«</a>&nbsp;'."\n";
				echo '<a href="/aktuality.php?'.$prev_page_query.'" title="Přejít o 1 stránku zpět">‹</a>&nbsp;'."\n";
			}
			else 
			{
				echo '«&nbsp;&nbsp;‹&nbsp;'."\n"; //neaktivní verze navigačních symbolů
			}
			if(isset($next_page_query)) 
			{
				echo '&nbsp;<a href="/aktuality.php?'.$next_page_query.'" title="Přejít o 1 stránku vpřed">›</a>'."\n";
				echo '&nbsp;<a href="/aktuality.php?'.$last_page_query.'" title="Přejít na poslední stránku">»</a>'."\n";
			}
			else 
			{
				echo '&nbsp;›&nbsp;&nbsp;»'."\n"; //neaktivní verze navigačních symbolů
			}
			echo '</span></b>';
		}	
		
		// výpis aktualit
		$counter = 1;
		while($row = mysql_fetch_array($result)) 
		{
			if($counter >= $from && $counter <= $to)
			{	
				$datum = explode('-', $row['datum']);
				echo '<p class="content_head">'.$row['nadpis']."\n"; 
				echo '<p class="content_small">'.$datum[2].'. '.$datum[1].'. '.$datum[0].'</p>'."\n";
				echo '<p class="content">'.$row['text'].'</p>'."\n";	
			}	
			$counter += 1;
		}			
	?>
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

	<!-- rozcestník v zápatí textu -->

	<p class="content" style="clear:both;">&nbsp;</p>	
	<p class="content_head">Kam dál?</p>
	<p class="content">Prohlédněte si nabídku šperků Barevného světla:</p>
		
		<?php
			$result = mysql_query('SELECT id, obrazku, nazev, kolekce FROM '.TB_SPERKY.' 
				WHERE zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE()') or die(mysql_error());
			srand();
			$count = rand(1, mysql_num_rows($result));
			for ($i=1; $i<=$count; $i++) //random number between 1 and the number of rows retrieved
			{
				$row = mysql_fetch_array($result);
				$id = $row['id'];
				$obrazku = $row['obrazku'];
				$nazev = $row['nazev'];
				$kolekce = $row['kolekce'];
			}	
			//pick random selection of images available for the particular id			
			$pic_no = rand(1, $obrazku);
			echo '<a href="/sperky-detail.php?id='.$id.'" title="'.htmlspecialchars($nazev, ENT_QUOTES, 'UTF-8')
				.' (kolekce '.$kolekce.')">'."\n";
			
			// pokud je daný produkt novinka, bude označen watermarkem pro novinky
			$novinka = '';
			$result_new = mysql_query('SELECT * FROM '.TB_SPERKY.' WHERE id = '.$id.' 
				&& datum_zobraz >= DATE_SUB(CURDATE(),INTERVAL '.NOVINKY_MAX_STARI.' month)') or die(mysql_error());
			if(mysql_fetch_array($result_new))			
			{
				$novinka = '&new=Y';
			}
			
			echo '<img src="/generate_thumb.php?id='.$id.'&pic_no='.$pic_no.'&width=45&height=45'.$novinka.'" 
				alt="Obrázek šperku: '.htmlspecialchars($nazev, ENT_QUOTES, 'UTF-8').'" class="rand_pic_small" width="45" height="45"></a>'."\n";
			?>	
			
	<ul class="links_bottom">
		<li><a href="/sperky-prehled.php" title="Kompletní katalog šperků z polodrahokamů">Kompletní katalog</a></li>
		<li><a href="/sperky-prehled.php?novinky=yes" title="Novinky v nabídce ručně vyráběných šperků">Novinky</a></li>
	</ul>
	<p class="content" style="clear:both;">Přečtěte si více o:</p>
	<ul class="links_bottom">

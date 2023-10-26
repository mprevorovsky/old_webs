	<!-- zobrazí náhodný produkt z nabídky --> 
	<div id="rand_pic">
		<img src="<?php echo URL_PIC; ?>napis_z_nasi_nabidky.png" alt="Z naší nabídky" style="margin: 6px 0px 6px 10px; width:149px; height:30px;">
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
			
			echo '<img src="/generate_thumb.php?id='.$id.'&pic_no='.$pic_no.'&width=146&height=146'.$novinka.'" 
				alt="Obrázek šperku: '.htmlspecialchars($nazev, ENT_QUOTES, 'UTF-8').'" class="rand_pic" width="146" height="146"></a>'."\n";
			echo '<p style="text-align:center;font-style:italic;font-size:90%;">
				<a href="/sperky-detail.php?id='.$id.'" title="Zobrazit detailní informace o šperku">'
				.htmlspecialchars($nazev, ENT_QUOTES, 'UTF-8').'.</a></p>'."\n";
			?>
	</div>
	<!-- pravý sloupec Aktuality -->
	<div id="aktuality">
		<img src="<?php echo URL_PIC; ?>napis_aktuality.png" alt="Aktuality" style="margin: 6px 0px 6px 51px; width:97px; height:29px;">
		<?php
			$latest = mysql_query('SELECT * FROM '.TB_AKTUALITY.' WHERE zobrazovat = "Y" &&
				datum >= DATE_SUB(CURDATE(),INTERVAL '.AKTUALITY_MAX_STARI.' month)
				ORDER BY datum DESC LIMIT '.AKTUALITY_MAX_POCET) or die(mysql_error());
			while($row = mysql_fetch_array($latest)) 
			{
				$datum = explode('-', $row['datum']); 
				echo '<p>'.$datum[2].'. '.$datum[1].'. '.$datum[0].'<br>'."\n";
				echo '<b>'.$row['nadpis'].'</b><br>'."\n";
				echo $row['text'].'</p>'."\n";
			}
			echo '<p align="right"><a href="/aktuality.php" 
				title="Zalistujte v kompletním přehledu aktualit"><b>Archiv aktualit</b></a></p>'."\n";
		?>
	</div>
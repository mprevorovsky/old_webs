
	<!-- levé menu s nabídkou produktů -->
	<div id="menu_left">
		<img src="<?php echo URL_PIC; ?>napis_nabidka_sperku.png" alt="Nabídka šperků" style="margin: 6px 0px 0px 1px; width:165px; height:34px;">
		<?php
			echo '<a href="/sperky-prehled.php" title="Prohlédněte si kompletní katalog našich šperků"><h2>Všechny šperky</h2></a>'."\n";
			echo '<a href="/sperky-prehled.php?novinky=yes" title="Nejnovější šperky v naší nabídce"><h2>Novinky</h2></a>'."\n";
			echo '<h2>Podle kolekce</h2>'."\n";
			echo '<ul class="menu_left">'."\n";
			$result = mysql_query('SELECT kolekce, novinka FROM `'.TB_KOLEKCE.'` ORDER BY kolekce ASC') or die(mysql_error());
			while($row = mysql_fetch_array($result)) 
			{
				if($row['novinka'] == 'Y') 				
				{
					$novinka = '<img src="'.URL_PIC.'menu_novinka.jpg" style="margin-left:6px; width:36px; height:13px;" alt="Nové">';
				}
				else 
				{
					$novinka = '';
				}
				echo '<li><a href="/sperky-prehled.php?kolekce='.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8')
					.'"><h3>'.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').$novinka.'</h3></a></li>'."\n";
			}
			echo '</ul>'."\n";
			echo '<h2>Podle typu</h2>'."\n";
			echo '<ul class="menu_left">'."\n";
			$result = mysql_query('SELECT kategorie, novinka FROM `'.TB_KATEGORIE.'` ORDER BY kategorie ASC') or die(mysql_error());
			while($row = mysql_fetch_array($result)) 
			{
				if($row['novinka'] == 'Y') 				
				{
					$novinka = '<img src="'.URL_PIC.'novinka.jpg" style="margin-left:6px;">';
				}
				else 
				{
					$novinka = '';
				}
				echo '<li><a href="/sperky-prehled.php?kategorie='.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8')
					.'"><h3>'.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').$novinka.'</h3></a></li>'."\n";
			}
			echo '</ul>'."\n";
		?>
<!-- 		
		<p class="content" align="center">------------</p>
 -->		
 		<h2>Více o špercích</h2>
		<ul class="menu_left">
			<li class="filled"><a href="/o-kolekcich-sperku.php" title="Představujeme Vám autorské kolekce šperků Barevného světla">
				<h3><b>O kolekcích</b></h3></a></li>
			<li class="filled"><a href="/material-sperky.php" title="Materiály, ze kterých jsou vyrobeny naše šperky">
				<h3><b>Používané materiály</b></h3></a></li>
		</ul>
		<br>
	</div>

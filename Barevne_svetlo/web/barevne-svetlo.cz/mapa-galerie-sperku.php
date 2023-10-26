<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');	
		
	include_once(DIR_TEMPLATE.'_includes.php'); 

	// page-specific meta data
	$pagetitle = 'Mapa stránek';
	//$keywords = 'keywords';
	$description = 'Projděte se prodejní galerií ručně vyráběných šperků z polodrahokamů a korálků. 
		Originální designy v autorských kolekcích Lenky Převorovské, limitované série.';
	
	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">	
	<p class="content_head">Mapa stránek</li>
	<h2>Hlavní menu</h2></h2>
	<ul class="menu_left">	
		<li class="filled"><a href="/index.php" title="Přejít na úvodní stránku"><b>Úvodní stránka galerie</a></b></li>
		<li class="filled"><a href="/o-autorce-sperku.php" title="Lenka Převorovská a její tvorba"><b>O autorce a designérce šperků</b></a></li>
		<li class="filled"><a href="/obchod.php" title="Jak objednat vybrané zboží"><b>Obchodní podmínky - jak nakupovat</a></b></li>
		<li class="filled"><a href="/kontakt.php" title="Kontaktní informace, adresa prodejny"><b>Kontaktní informace</a></b></li>
		<li class="filled"><a href="/napoveda.php" title="Jak efektivně používat tyto stránky" target="_blank"><b>Nápověda</b></a></li>
	</ul>

	<h2>Nabídka ručně vyráběných šperků</h2></a>
	<ul class="menu_left">
		<li class="filled"><a href="/sperky-prehled.php?novinky=yes" title="Nejnovější šperky v naší nabídce"><b>Novinky v nabídce</b></a></li>
		<li class="filled"><a href="/sperky-prehled.php" title="Prohlédněte si kompletní katalog našich šperků"><b>Katalog všech šperků</b></a></li>
		<ul>
			<?php
				$result = mysql_query('SELECT * FROM `sperky` WHERE zobrazovat="Y" && obrazku > 0 && datum_zobraz <= CURDATE() 
					ORDER BY datum_zobraz DESC') or die(mysql_error());
				while($row = mysql_fetch_array($result)) 
				{
					echo '<li><a href="/sperky-detail.php?id='.$row['id'].'">'
						.htmlspecialchars($row['nazev'], ENT_QUOTES, 'UTF-8').$novinka.'</a></li>'."\n";
				}
			?>
		</ul>
		<li class="filled"><b>Šperky podle kolekce</b></li>
		<ul>		
			<?php
				$result = mysql_query('SELECT kolekce, novinka FROM `'.TB_KOLEKCE.'` ORDER BY kolekce ASC') or die(mysql_error());
				while($row = mysql_fetch_array($result)) 
				{
					echo '<li><a href="/sperky-prehled.php?kolekce='.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8')
						.'">'.htmlspecialchars($row['kolekce'], ENT_QUOTES, 'UTF-8').$novinka.'</a></li>'."\n";
				}
			?>
		</ul>
		<li class="filled"><b>Šperky podle typu</b></li>
		<ul>		
			<?php
				$result = mysql_query('SELECT kategorie, novinka FROM `'.TB_KATEGORIE.'` ORDER BY kategorie ASC') or die(mysql_error());
				while($row = mysql_fetch_array($result)) 
				{
					echo '<li><a href="/sperky-prehled.php?kategorie='.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8')
						.'">'.htmlspecialchars($row['kategorie'], ENT_QUOTES, 'UTF-8').$novinka.'</a></li>'."\n";
				}
			?>
		</ul>		
	</ul>

	<h2>Více informací o špercích</h2>
	<ul class="menu_left">
		<li class="filled"><a href="/o-kolekcich-sperku.php" title="Představujeme Vám autorské kolekce šperků Barevného světla">
			<b>O kolekcích šperků z polodrahokamů</b></a></li>
		<li class="filled"><a href="/material-sperky.php" title="Materiály, ze kterých jsou vyrobeny naše šperky">
			<b>Materiály používané při výrobě šperků</b></a></li>
	</ul>
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_aktuality.php');
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

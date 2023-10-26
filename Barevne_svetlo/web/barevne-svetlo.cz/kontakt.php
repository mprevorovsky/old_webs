<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
	
	include_once(DIR_TEMPLATE.'_includes.php');

	// page-specific meta data
	$pagetitle = 'Kam zasílat objednávky šperků a směřovat dotazy a připomínky';
	$keywords = 'kontaktní údaje';
	$description = 'Kontaktujte nás - kam zasílat objednávky a směřovat dotazy a připomínky. Kde si můžete prohlédnout a koupit šperky z naší nabídky.';

	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">	
	<img src="<?php echo URL_PIC; ?>napis_kontakt.png" alt="Kontaktní údaje" style="margin: 6px; width:86px; height:30px; float:right;">
	<p class="content_head">Jak nás můžete kontaktovat</p>	
	
	<table style="border: #679a51 1px solid;margin: 20px 0px 0px 20px;"><tr><td>
	<p class="content" style="font-size:120%;font-weight:bold;">Prodejní galerie Barevné světlo</p>
	<p class="content" style="font-size:120%;font-weight:bold;">Mgr. Lenka Převorovská</p>
	<p class="content_small">Sídliště V Zátiší 1024, 278 01, Kralupy nad Vltavou, Česká republika
		<br>IČO: 75425050<br>DIČ: CZ8457099904
		<br>Fyzická osoba zapsaná v Živnostenském rejstříku od 26. 4. 2010
		<br>Evidenční číslo živnostenského oprávnění 31004/U2010/9109/HRU</p>
	</td></tr></table>
	
	<ul>	
		<li class="kontakt_filled"><b>Objednávejte na e-mailové adrese</b> 
			<table style="width:80%;margin:8px;"><tr><td style="text-align:right;">
				<b><a href="mailto:objednavky&#64;barevne-svetlo&#46;cz?subject=Objednávka&
				body=Z nabídky prodejní galerie Barevné světlo objednávám%0A%0AKatalogové číslo:&nbsp;%0A
				Počet kusů:&nbsp;%0A%0ADoručovací adresa (pro zásilkový prodej):&nbsp;%0A%0APoznámka:&nbsp;%0A%0A
				Potvrďte prosím obratem mou objednávku a zašlete instrukce pro provedení platby.%0A%0AS pozdravem%0A%0A">
				objednavky&#64;barevne-svetlo&#46;cz</a></b>.
			</td></tr></table></li>
		<li class="kontakt_filled"><b>Veškeré dotazy a připomínky směřujte, prosím, přednostně na e-mailovou adresu</b>
			<table style="width:80%;margin:8px;"><tr><td style="text-align:right;">
			<b><a href="mailto:info&#64;barevne-svetlo&#46;cz?subject=Dotaz/připomínka">
			info&#64;barevne-svetlo&#46;cz</a></b>.
			</td></tr></table></li>			
		<li class="kontakt">V naléhavějších případech nás můžete kontaktovat na telefonním čísle 
			<b>607 619 154</b>. Vzhledem k pracovnímu vytížení však máme omezenou možnost přijímat hovory. 
			Pokud nejsme zrovna k zastižení, ozveme se Vám, jakmile to bude možné. Děkujeme za pochopení.</li>
		<li class="kontakt">Šperky z naší nabídky si můžete osobně prohlédnout, zakoupit nebo vyzvednout v masážním salonu <b>Duhová brána</b> 
			(<a href="http://www.mapy.cz/#d=firm_2615483_1&t=s&x=14.463201&y=50.069742&z=15&c=23-14-30-28-29-27" target="_blank" 
				title="Navštivte nás - interaktivní mapa okolí Duhové brány">Náměstí Svatopluka Čecha 1351/6, Praha 10 - Vršovice</a>). 
			Rádi bychom Vás upozornili, že návštěvu je z provozních důvodů nutné dohodnout předem. Těšíme se na Vás!</li>
	</ul>
	<table class="content_l"><tr><td>
	<a href="http://www.mapy.cz/#d=firm_2615483_1&t=s&x=14.463201&y=50.069742&z=15&c=23-14-30-28-29-27" target="_blank" 
		title="Navštivte nás - interaktivní mapa okolí Duhové brány">
	<img src="<?php echo URL_PIC; ?>kontakt_mapa.jpg" alt="Mapa okolí masážního salonu Duhová brána" 
		style="float:left;border: #ae8846 1px solid;margin: -5px 10px 4px 35px; width:350px; height:350px;"></a>
	</td></tr><tr><td><a href="http://www.mapy.cz/#d=firm_2615483_1&t=s&x=14.463201&y=50.069742&z=15&c=23-14-30-28-29-27" target="_blank" 
		title="Navštivte nás - interaktivní mapa okolí Duhové brány">Navštivte nás v Duhové bráně.</a></td></tr></table>
	<p class="content_small"><b>Nejbližší zastávky:</b><br>Čechovo náměstí<br>Slovinská<br>Kodaňská<br>Koh-i-noor.</p>
	
	<?php 
		include_once(DIR_TEMPLATE.'_kam_dal.php');
		
		include_once(DIR_TEMPLATE.'_kam_dal_obchod.php');		
	?>	

	</ul>	
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_aktuality.php');
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

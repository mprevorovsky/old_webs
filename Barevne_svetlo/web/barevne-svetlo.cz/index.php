<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');	
		
	include_once(DIR_TEMPLATE.'_includes.php'); 

	// page-specific meta data
	$pagetitle = 'Vítejte v galerii ručně vyráběných šperků z polodrahokamů a korálků';
	//$keywords = 'keywords';
	$description = 'Šperky přesně pro Vás! Ručně vyrobené z polodrahokamů a korálků. Navštivte prodejní galerii autorských kolekcí. 
		Originální designy Lenky Převorovské, limitované série i zakázková tvorba.';
	
	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">
	<img src="<?php echo URL_PIC; ?>napis_uvod.png" alt="Úvod" style="margin: 6px; width:62px; height:30px; float:right;">	
	<p class="content_head">Vítejte v Barevném světle!</p>
	<p class="content"><b>Pro všechny dívky a ženy, které rády podtrhují svou jedinečnost a osobitost originálním doplňkem 
		nabízíme ručně vyráběné šperky z polodrahokamů v <a href="/o-kolekcich-sperku.php" title="Představujeme Vám kolekce šperků z polodrahokamů">
		autorských designech</a></b>. 
		<table class="content_l" width="150"><tr><td>
		<a href="/sperky-detail.php?id=103" title="Sluneční náhrdelník (kolekce Pestrá)">
		<img src="<?php echo URL_PIC; ?>uvod_slunecni.jpg" alt="Sluneční náhrdelník" class="content_l" width="150" height="121"></a>
		</td></tr><tr><td><a href="/sperky-detail.php?id=103" title="Sluneční náhrdelník">
		Sluneční náhrdelník.</a></td></tr></table>		
		Ať už raději nosíte šperky jemné, či výraznější, nebo hledáte krásný a neobyčejný dárek, který potěší Vaše blízké – prodejní 
		galerie Barevné světlo je tu pro Vás.</p>
	<p class="content" style="margin-top:15px;">
		Udělejte si radost... <a href="/sperky-prehled.php" title="Kompletní přehled ručně vyráběných šperků"> 
		Naše šperky</a> jsou navrženy a vytvořeny s láskou a péčí, v <b>limitovaném počtu kusů</b> od každého designu. 
		Vyberte si ozdoby pro každodenní nošení i klenoty a talismany pro speciální příležitosti. 
		<b>Vyjádřete svůj osobitý styl krásným šperkem. Symbolem oznamujícím světu: „Tohle jsem já!“</b></p>

	<p class="content_head_clear" style="margin-top:10px;">Šperky z polodrahokamů...</p>
	<p class="content">Designy z dílny Barevného světla se zaměřují na detail. Jejich klíčový princip spočívá v souladu kamenů s ostatními 
		<a href="/material-sperky.php" title="Přečtěte si o materiálech, ze kterých jsou vyrobeny naše šperky">
		použitými prvky</a> tak, aby vždy vznikla <b>dokonalá harmonie tvarů a barev</b>, která zažene šeď a prozáří Váš den.</p>
	<p class="content">Všechny naše 
		<a href="/sperky-prehled.php?kategorie=náhrdelník" title="Přehled náhrdelníků z polodrahokamů">náhrdelníky</a>, 
		<a href="/sperky-prehled.php?kategorie=náramek" title="Přehled náramků z polodrahokamů">náramky</a> a 
		<a href="/sperky-prehled.php?kategorie=náušnice" title="Přehled náušnic z polodrahokamů">náušnice</a> 
		vycházejí z kombinace polodrahokamů s dalšími materiály, 
		<table class="content_r" width="200"><tr><td> 
		<a href="/sperky-detail.php?id=53" title="Náhrdelník Večerní citrín (kolekce S drahým kamenem v přívěsku)">
		<img src="<?php echo URL_PIC; ?>uvod_citrin.jpg" alt="Večerní citrín" class="content_r" width="200" height="158"></a>
		</td></tr><tr><td><a href="/sperky-detail.php?id=53" title="Večerní citrín">
		Večerní citrín.</a></td></tr></table>
		nejčastěji tolik oblíbenými korálky. <b>Přírodní charakter</b> kamenů dodává šperkům osobnost, odlišuje je od běžné bižuterie a dává tak 
		vyniknout jejich nositelce. Kameny jsou jako lidé: <b>každý je originál.</b> Zejména to platí pro kameny nebroušené, které v podobě 
		<a href="/sperky-prehled.php?kolekce=S drahým kamenem v přívěsku" title="Kolekce šperků S drahým kamenem v přívěsku">
		přívěsků</a> dominují některým náhrdelníkům.</p>
	<p class="content"><b>Díky neopakovatelnému tvaru a odstínu kamene tak vždy získáváte jedinečný šperk, který zanechá jedinečný dojem.</b></p>

	<?php 
		include_once(DIR_TEMPLATE.'_kam_dal.php');
		
		include_once(DIR_TEMPLATE.'_kam_dal_kolekce.php');
		include_once(DIR_TEMPLATE.'_kam_dal_autorka.php');		
		include_once(DIR_TEMPLATE.'_kam_dal_materialy.php');
		include_once(DIR_TEMPLATE.'_kam_dal_obchod.php');
	?>

	</ul>	
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_aktuality.php');
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

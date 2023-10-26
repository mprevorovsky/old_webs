<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');	
		
	include_once(DIR_TEMPLATE.'_includes.php'); 

	// page-specific meta data
	$pagetitle = 'Stránka nenalezena (Chyba 404)';
	//$keywords = 'keywords';
	$description = 'Šperky – ruční výroba z polodrahokamů a korálků. Navštivte prodejní galerii autorských kolekcí. 
		Originální designy, limitované série.';
	
	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">	
	<p class="content_head">Požadovaná stránka nebyla nalezena! (Chyba 404)</p>
	<p class="content">&nbsp;</p>
	
	<table class="content_r" width="200"><tr><td> 
	<a href="/sperky-detail.php?id=19" title="Náhrdelník Ztracené a nalezené (kolekce Zakázková)">
	<img src="<?php echo URL_PIC; ?>404.jpg" alt="Ztracené a nalezené" class="content_r" width="200" height="200"></a>
	</td></tr><tr><td><a href="/sperky-detail.php?id=19" title="Ztracené a nalezené">
	Ztracené a nalezené.</a></td></tr></table>
	
	<p class="content">Ale nic není ztraceno... :-)</p>
	<p class="content">Na místo určení se dostanete pomocí:</p>
	<ul>	
		<li class="filled">odkazů v záhlaví</li> 
		<li class="filled">odkazů v levém menu</li>
		<li class="filled">pomocí políčka pro vyhledávání v pravém horním rohu stránky</li>
	</ul>
	<p class="content">&nbsp;</p>
	<p class="content">Děkujeme za pochopení.</p>
	<p class="content">&nbsp;</p>
	<p class="content">&nbsp;</p>
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_aktuality.php');
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	

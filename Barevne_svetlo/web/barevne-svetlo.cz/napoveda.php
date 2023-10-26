<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
	include_once(DIR_TEMPLATE.'_includes.php');
?>

<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Nápověda - jak efektivně používat tyto stránky | Prodejní galerie Barevné světlo</title>
	<meta name="description" content="Přečtěte si, jak efektivně používat tyto stránky - vyhledávání šperků a filtrování zobrazených výsledků.">
	<meta name="keywords" content="šperky, autorský design, limitované kolekce, ruční výroba, originální doplňky, 
		polodrahokamy, korálky, kůže, dárky, nápověda">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href="<?php echo URL_CSS; ?>main.css" charset="UTF-8" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Google Analytics code -->
	<?php include_once(DIR_TEMPLATE.'_analyticstracking.php') ?> 

	<table width="700"><tr><td width="60">
		<img src="<?php echo URL_PIC; ?>help_logo.jpg" alt="logo Barevné světlo" style="margin-left:10px; width:50px; height:50px;">
	</td><td valign="center">
		<p class="content_head"><u>Nápověda k používání webu Barevné světlo</u></p>
	</td></tr><tr><td colspan="2">
	
	<p class="content_head">Jak najít šperk podle Vašich představ</p>
	<ul>	
		<li class="kontakt"><b>Novinky</b> – Pokud Vás zajímají šperky, které do nabídky přibyly za poslední měsíc, 
			klikněte na  položku “Novinky” v levém menu. Takové šperky jsou v katalogu označeny logem: 
			<img src="<?php echo URL_PIC; ?>help_novinka.gif" alt="logo novinka" width="20" height="20">. 
		</li>
		<li class="kontakt"><b>Kolekce</b> – Jednotlivé kolekce šperků jsou představeny 
			<a href="/o-kolekcich-sperku.php" title="Přečtěte si více o jednotlivých kolekcích šperků z naší nabídky">zde</a>. 
			Obsah příslušné kolekce zobrazíte kliknutím na její název v sekci „Podle kolekce“ v levém menu.
		</li>
		<li class="kontakt"><b>Typy šperků</b> – Sháníte náhrdelník, náušnice nebo snad náramek? Stačí kliknout na 
			název typu šperku v levém menu (sekce „Podle typu“).
		</li>
		<li class="kontakt"><b>Vyhledávání</b> – V katalogu je možno vyhledávat podle slov vyskytujících se v názvu a 
			popisu šperku a u použitého materiálu. Vyhledávat lze navíc i podle katalogového čísla. Stačí zadat hledaný 
			výraz do bílého políčka v pravé horní části stránky a kliknout na tlačítko „Hledej...“.
		</li>
	</ul>

	<p class="content_head">Nastavení zobrazení</p>
	<ul>	
		<li class="kontakt"><b>Filtrování podle kolekce/typu šperků</b> – Procházíte nabídkou náhrdelníků a chtěli 
			byste zobrazit jen ty, které patří do určitých kolekcí. Anebo si prohlížíte nějakou větší kolekci a rádi 
			byste v ní vyhledali např. náušnice. K tomu slouží lišta „Filtrovat zobrazení“ v záhlaví katalogu. Stačí 
			zrušit zaškrtnutí políček u kolekcí/typů šperků, které chcete skrýt, a kliknout na tlačítko „Zobraz“.
		</li>
		<li class="kontakt"><b>Řazení</b> – Položky v katalogu lze řadit podle data vložení, názvu a ceny a to buď 
			sestupně, nebo vzestupně. Zvolte příslušné nastavení v liště „Řadit podle“ v záhlaví katalogu a klikněte 
			na tlačítko „Zobraz“.
		</li>
		<li class="kontakt"><b>Stránkování</b> – Na jednu stránku katalogu se zobrazuje maximálně 12 výrobků. Pokud 
			daná sekce obsahuje více položek, lze mezi jednotlivými stránkami přecházet pomocí navigačních symbolů 
			&nbsp;&nbsp;«&nbsp;&nbsp;‹&nbsp;&nbsp;&nbsp;›&nbsp;&nbsp;»&nbsp;&nbsp; v pravé horní části záhlaví katalogu.
		</li>
	</ul>	
	</td></tr></table>
</body>
</html>

<?php mysql_close($con); ?>
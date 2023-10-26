<html 
	xmlns:og="http://ogp.me/ns#"
	xmlns:fb="http://www.facebook.com/2008/fbml">
	
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php if (isset($pagetitle)) {echo htmlspecialchars($pagetitle, ENT_QUOTES, 'UTF-8').' | '; } ?>Prodejní galerie Barevné světlo</title>
	<?php 
		if (isset($description)) 
		{	
			echo '<meta name="description" content="'.htmlspecialchars($description, ENT_QUOTES, 'UTF-8').'">'."\n";
		} 
	?>
	<meta name="keywords" content="prodejní galerie, šperky, autorský design, limitované kolekce, ruční výroba, originální doplňky, polodrahokamy, korálky, kůže, dárky
		<?php if (isset($keywords)) {	echo ', '.htmlspecialchars($keywords, ENT_QUOTES, 'UTF-8');} ?>">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href="<?php echo URL_CSS; ?>main.css" charset="UTF-8" rel="stylesheet" type="text/css">
	
	<meta property="og:title" content="Šperky z polodrahokamů a korálků" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.barevne-svetlo.cz" />
	<meta property="og:image" content="http://www.barevne-svetlo.cz/images/logo_fb.jpg" />
	<meta property="og:site_name" content="Barevné světlo Lenky Převorovské" />
	<meta property="fb:admins" content="100000256823191" />
	<meta property="og:description" content="Prodejní galerie autorských kolekcí. Originální designy, limitované série."/>
</head>

<body>
	<!-- Google Analytics code -->
	<?php include_once(DIR_TEMPLATE.'_analyticstracking.php') ?> 
	
	<table width="100%"><tr><td width="25%"><p>&nbsp;</p></td><td class="main">
	
	<!-- záhlaví stránky -->
	<div id="header">
		<img src="<?php echo URL_PIC; ?>blank0.gif" width="185" height="185" usemap ="#logo" 
			style="position:absolute; top:0px; left:0px;">
		<map name="logo">
			<area shape="circle" coords="93,93,83" href="/index.php">
		</map>
	
		<table><tr><td class="menu_top1">
			<a href="/index.php" title="Přejít na úvodní stránku">
			<img src="<?php echo URL_PIC; ?>blank1.gif" alt="Úvod"></a></td></tr></table>
		<table><tr><td class="menu_top2">
			<a href="/o-autorce-sperku.php" title="Lenka Převorovská a její tvorba">
			<img src="<?php echo URL_PIC; ?>blank2.gif" alt="O autorce"></a></td></tr></table>
		<table><tr><td class="menu_top3">
			<a href="/obchod.php" title="Objednat vybrané zboží">
			<img src="<?php echo URL_PIC; ?>blank3.gif" alt="Obchod"></a></td></tr></table>
		<table><tr><td class="menu_top4">
			<a href="/kontakt.php" title="Kontaktní informace, adresa prodejny">
			<img src="<?php echo URL_PIC; ?>blank4.gif" alt="Kontakt"></a></td></tr></table>

		<!-- help button -->
		<table><tr><td class="menu_help">
			<a href="/napoveda.php" title="Jak efektivně používat tyto stránky" target="_blank">
			<img src="<?php echo URL_PIC; ?>blank5.gif" alt="Nápověda"></a></td></tr></table>
	
		<form method="get" action="/sperky-prehled.php"><input type="text" name="searchfor" class="text_search" title="Zadejte hledané slovo">
		<input type="submit" name="search" value="" class="submit_search" title="Vyhledat v katalogu"></form>
	</div>

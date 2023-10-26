<?php include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php') ?>

<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?php echo URL_CSS; ?>sprava.css" charset="UTF-8" rel="stylesheet" type="text/css">
	<title>Správa</title>
</head>

<body>
<?php

echo '<table><tr><td align="center">'."\n";
echo '<br>Pochybuji, že by pan Garison kdy řekl, cituji:<br><br><i>Mrdej tučnáka do ucha, ty buzno.</i><br>'."\n";
echo '<br><a href="'.URL_SPRAVA_SPERKY.'"><b>Šperky</b></a><br>'."\n";
echo '<br><a href="'.URL_SPRAVA_AKTUALITY.'"><b>Aktuality</b></a><br>'."\n";
echo '<br><a href="'.URL_SPRAVA_KATEGORIE.'"><b>Kategorie produktů (pouze čtení)</b></a><br>'."\n";
echo '<br><a href="'.URL_SPRAVA_KOLEKCE.'"><b>Produktové kolekce (pouze čtení)</b></a><br><br>'."\n";
echo '</td></tr></table>'."\n";

?>
</body>
</html>
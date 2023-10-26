<?php
/*
ZÁLOHA DATABÁZE
při vytváření zálohy databáze v myphpadmin přidat "DROP TABLE"
pak spustit:
mysql barevne-svetlo_cz_01 -u root -p <barevne-svetlo_cz_01.sql
*/

// přepíná nastavení pro web / local
// **** change as needed ****
// 0 : www / 1 : local hdd
if($_SERVER['SERVER_NAME'] == 'localhost') 
{ 
	$local = 1;
}

//konstanty pro práci s databází
define('TB_SPERKY', 'sperky');
define('TB_AKTUALITY', 'aktuality');
define('TB_KATEGORIE', 'kategorie');
define('TB_KOLEKCE', 'kolekce');
if($local == 0) 
{
	define('DB_NAME', 'barevne-svetlo_cz_01');
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'barevne-svetl_cz');
	define('DB_PASSWORD', 'Bumlicek1');
}
else 
{
	define('DB_NAME', 'barevne-svetlo_cz_01');
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
}


//konstanty pro cesty/adresy
//for PHP internal use
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR_TEMPLATE', DIR_ROOT.'/../templates/');
define('DIR_CONF', DIR_ROOT.'/../config/');
define('DIR_LIB', DIR_ROOT.'/../lib/');
//for browser use
define('URL_SPRAVA', '/sprava/sprava.php');
define('URL_SPRAVA_SPERKY', '/sprava/sprava_sperky.php');
define('URL_SPRAVA_AKTUALITY', '/sprava/sprava_aktuality.php');
define('URL_SPRAVA_KATEGORIE', '/sprava/sprava_kategorie.php');
define('URL_SPRAVA_KOLEKCE', '/sprava/sprava_kolekce.php');
define('URL_CSS', '/css/');
define('URL_PIC', '/images/');
define('URL_PIC_PROD_FULL', '/images/products_full/');
define('URL_PIC_PROD_THUMB', '/images/products_thumb/');


//konstanty pro výpočty
define('CENA_HOD', 250);
define('FAKTOR_CAS', 1.5);
define('FAKTOR_MATERIAL', 2);
define('FAKTOR_PREZENTACE', 1.05); //5% na prezentaci (foto, web), expedici)
define('POSTOVNE_CR', 30);
define('POSTOVNE_EU', 62);
define('POSTOVNE_LIMIT', 1500); //pokud celková výše objednávky přesáhne tuto částku, poštovné a balné je zdarma


//konstanty pro aktuality 
define('AKTUALITY_MAX_POCET', 3); //počet zobrazovaných aktualit
define('AKTUALITY_MAX_STARI', 1); //počet měsíců


//konstanty pro novinky u šperků
define('NOVINKY_MAX_STARI', 1); //počet měsíců


//konstanty pro stránkování
define('SPERKU_NA_STRANKU', 12);
define('AKTUALIT_NA_STRANKU', 7);

/*
echo DIR_SPRAVA.'<br>';
echo URL_SPRAVA.'<br>';
echo DIR_CSS.'<br>';
echo DIR_PIC.'<br>';
echo DIR_THUMB.'<br>';
echo DIR_TEMPLATE.'<br>';
echo DIR_CONF.'<br>';
echo DIR_LIB.'<br>';
*/

?>



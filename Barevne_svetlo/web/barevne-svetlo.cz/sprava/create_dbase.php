<?php
include($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');

$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }


/*
// Create database
if (mysql_query('CREATE DATABASE `'.DB_NAME.'`',$con))
  {
  echo 'Database '.DB_NAME.' created<br>';
  }
else
  {
  echo 'Error creating database: ' . mysql_error().'<br>';
  }
*/
/*
// Create table
mysql_select_db(DB_NAME, $con);
$sql = 'CREATE TABLE `'.TB_SPERKY.'`
(
	id INT NOT NULL AUTO_INCREMENT,
	datum_uprav TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	datum_vloz DATETIME,
	kat_cislo VARCHAR(20), 
	nazev VARCHAR(255),
	kolekce VARCHAR(255),
	kategorie VARCHAR(255),
	popis TEXT,
	material VARCHAR(255),
	poznamka_int TEXT,
	poznamka_ext TEXT,
	akce VARCHAR(50),
	vyr_naklady DECIMAL(7,2),
	vyr_cas DECIMAL(5,2),
	kalk_cena DECIMAL(7,2),
	prodej_cena DECIMAL(7,2),
	dodaci_lhuta TINYINT(3) UNSIGNED,
	postovne TINYINT(3) UNSIGNED,
	kusu_skladem TINYINT(4) UNSIGNED,
	obrazku TINYINT(3) UNSIGNED,
	zobrazovat ENUM("Y","N"),
   PRIMARY KEY (id),
	UNIQUE id (id)
)';
*/
/*
	id - unikátní identifikátor položky v databázi
	datum_uprav - datum poslední aktualizace položky
	datum_vloz - datum vložení položky do databáze
	kat_cislo - katalogové číslo
	nazev - název produktu
	kolekce - kolekce, do které produkt patří
	kategorie - zařazení produktu
	popis - popis produktu
	material - použitý materiál
	poznamka_int - interní poznámka (výrobní postup...); nezobrazuje se zákazníkům
	poznamka_ext - externí poznámka (např. rezervace...); zobrazuje se zákazníkům
	akce - slevy... (S;)
	vyr_naklady - výrobní náklady
	vyr_cas - čas potřebný k výrobě 1 ks produktu
	kalk_cena - cena kalkulovaná dle výrobních nákladů a čas potřebného k výrobě
	prodej_cena - cena stanovená pro prodej
	dodaci_lhuta - dodací lhůta (počet dnů)
	postovne - kategorie poštovného (nikoli jeho konkrétní výše!)
	kusu_skladem - počet kusů produktu skladem
	obrazku - počet asociovaných obrázků
	zobrazovat - zobrazovat zákazníkům (Y/N)
*/
/*
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Table '.TB_SPERKY.' created<br>';
  }
else 
	{
	echo 'Error creating table: ' . mysql_error().'<br>';
	}
*/



/*
// rename table
mysql_select_db(DB_NAME, $con);
$sql = 'RENAME TABLE produkty TO sperky';
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Table '.TB_SPERKY.' renamed<br>';
  }
else 
	{
	echo 'Error renaming table: '.mysql_error().'<br>';
	}
*/


/*
// rename column
mysql_select_db(DB_NAME, $con);
$sql = 'ALTER TABLE sperky CHANGE poznamka poznamka_int TEXT';
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Column renamed<br>';
  }
else 
	{
	echo 'Error renaming column: '.mysql_error().'<br>';
	}

//add column
$sql = 'ALTER TABLE sperky ADD kolekce VARCHAR(255) AFTER nazev';
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Column added<br>';
  }
else 
	{
	echo 'Error renaming column: '.mysql_error().'<br>';
	}
//add column
$sql = 'ALTER TABLE sperky ADD poznamka_ext TEXT AFTER poznamka_int';
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Column added<br>';
  }
else 
	{
	echo 'Error renaming column: '.mysql_error().'<br>';
	}
//add column
$sql = 'ALTER TABLE sperky ADD akce VARCHAR(50) AFTER poznamka_ext';
// Execute query
if (mysql_query($sql,$con))
  {
  echo 'Column added<br>';
  }
else 
	{
	echo 'Error renaming column: '.mysql_error().'<br>';
	}
*/



//////////////////////////////////////////
/////////////////////////////////////////
//create table AKTUALITY
/*
mysql_select_db(DB_NAME, $con);
$sql = 'CREATE TABLE `'.TB_AKTUALITY.'`
(
	id INT NOT NULL AUTO_INCREMENT,
	datum_uprav TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
	datum_vloz DATETIME,
	datum DATE, 
	nadpis VARCHAR(255),
	text TEXT,
	zobrazovat ENUM("Y","N"),
   PRIMARY KEY (id),
	UNIQUE id (id)
)';
*/
/*
	id - unikátní identifikátor položky v databázi
	datum_uprav - datum poslední aktualizace položky
	datum_vloz - datum vložení položky do databáze
	datum - datum, které bude zobrazeno
	nazev - nadpis aktuality
	text - text aktuality
	zobrazovat - zobrazovat zákazníkům (Y/N)
*/

// Execute query
/*
if (mysql_query($sql,$con))
  {
  echo 'Table '.TB_AKTUALITY.' created<br>';
  }
else 
	{
	echo 'Error creating table: ' . mysql_error().'<br>';
	}
*/




//////////////////////////////////////////
/////////////////////////////////////////
//create table KATEGORIE
/*
mysql_select_db(DB_NAME, $con);
$sql = 'CREATE TABLE `'.TB_KATEGORIE.'`
(
	id INT NOT NULL AUTO_INCREMENT,
	kategorie VARCHAR(255),
   PRIMARY KEY (id),
	UNIQUE id (id)
)';
*/
/*
	id - unikátní identifikátor položky v databázi
	kategorie - kategorie, do které šperk patří
*/

// Execute query
/*
if (mysql_query($sql,$con))
  {
  echo 'Table '.TB_KATEGORIE.' created<br>';
  }
else 
	{
	echo 'Error creating table: ' . mysql_error().'<br>';
	}
*/



//////////////////////////////////////////
/////////////////////////////////////////
//create table KOLEKCE
/*
mysql_select_db(DB_NAME, $con);
$sql = 'CREATE TABLE `'.TB_KOLEKCE.'`
(
	id INT NOT NULL AUTO_INCREMENT,
	kolekce VARCHAR(255),
   PRIMARY KEY (id),
	UNIQUE id (id)
)';
*/
/*
	id - unikátní identifikátor položky v databázi
	kolekce - kolekce, do které šperk patří
*/

// Execute query
/*
if (mysql_query($sql,$con))
  {
  echo 'Table '.TB_KOLEKCE.' created<br>';
  }
else 
	{
	echo 'Error creating table: ' . mysql_error().'<br>';
	}
*/



mysql_close($con);

//mysql_query('DROP TABLE '.TB_SPERKY,$con); #WOULD DELETE THE WHOLE TABLE!!!!
//mysql_query('DROP DATABASE '.DB_NAME,$con); #WOULD DELETE THE WHOLE DATABASE!!!!
?>
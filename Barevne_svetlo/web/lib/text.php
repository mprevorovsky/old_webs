<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');


function bez_diakritiky($str) {
//source http://interval.cz/clanky/php-prace-s-retezci-a-php/
	$bez_diakritiky = StrTr($str, "áäčďéěëíňóöřšťúůüýžÁÄČĎÉĚËÍŇÓÖŘŠŤÚŮÜÝŽ", "aacdeeeinoorstuuuyzAACDEEEINOORSTUUUYZ");
	return $bez_diakritiky;
}

?>
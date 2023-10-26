<html>
<head>
	<meta http-equiv="Content-language" content="cs">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<?php
	if(isset($_POST['ratio'])) {
		$ratio = $_POST['ratio'];
	}
	else {
		$ratio = 60;
	}
	if(isset($_POST['opacity'])) {
		$opacity = $_POST['opacity'];
	}
	else {
		$opacity = 30;
	}	
	if($_POST['orient']==2) {
		$checked2 = 'checked="checked"';
		$orient=2;
	}
	else {
		$checked1 = 'checked="checked"';
		$orient=1;
	}		
	
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
	echo 'Zvětšení (1-100): <input type="text" name="ratio" size="3" value="'.$ratio.'"><br>';
	echo 'Průhlednost vodoznaku (0-100): <input type="text" name="opacity" size="3" value="'.$opacity.'"><br>';
	echo 'Orientace vodoznaku: <input type="radio" name="orient" value="1" '.$checked1.'> L ';
	echo '<input type="radio" name="orient" value="2" '.$checked2.'> P <br>';
	echo '<input type="submit" name="zobrazit" value="Zobrazit" class="button"></form>';
	echo '<img src="./watermark.php?ratio='.$ratio.'&opacity='.$opacity.'&orient='.$orient.'">';


?>


</body></html>
<?php

// zdrojový obrázek je možno specifikovat pomocí cesty (source), ale pak je v kódu stránky
// vidět adresářová struktura serveru
if(isset($_GET['source']))
{
	$imgSrc = $_GET['source'];
}
elseif(isset($_GET['id'])) //alternativně se cesta k obrázku složí z 'id' a 'pic_no'
{
	if(!isset($_GET['pic_no'])) //pokud pic_no nezadáno, default = 1 
	{
		$pic_no = 1;
	}
	else 
	{
		$pic_no = $_GET['pic_no'];
	}
	$imgSrc = $_SERVER['DOCUMENT_ROOT'].'/images/products_full/id'.$_GET['id'].'_'.$pic_no.'.jpg';
}

if(!file_exists($imgSrc)) //pokud soubor s obrázkem neexistuje, bude použit templát "not found"
{
	$imgSrc = $_SERVER['DOCUMENT_ROOT'].'/images/image_not_found.jpg';
}

$thumbnail_width = intval($_GET['width']);
$thumbnail_height = intval($_GET['height']);

    //getting the image dimensions 
list($width_orig, $height_orig) = getimagesize($imgSrc);  
$myImage = imagecreatefromjpeg($imgSrc);
$ratio_orig = $width_orig/$height_orig;
   
if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
	$new_height = round($thumbnail_width/$ratio_orig);
   $new_width = $thumbnail_width;
} 
else {
	$new_width = round($thumbnail_height*$ratio_orig);
	$new_height = $thumbnail_height;
}
   
$process = imagecreatetruecolor($new_width, $new_height);
   
imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
$thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height); 
imagecopyresampled($thumb, $process, 0, 0, ($new_width-$thumbnail_width), ($new_height-$thumbnail_height), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
imagedestroy($process);
imagedestroy($myImage);

if($_GET['new']=='Y')
{
	$watermark = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/watermark_novinka.png');
	$watermark_width = imagesx($watermark);  
	$watermark_height = imagesy($watermark);
	
	$watermark2 = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
	imagefill($watermark2, 0, 0, imagecolorallocate($watermark2, 0, 0, 0)); // fill with black
	
	imagecopyresampled($watermark2, $watermark, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $watermark_width, $watermark_height);
	
	imagealphablending($watermark2, false);
	imagesavealpha($watermark2, true);	
	imagecolortransparent($watermark2, imagecolorallocatealpha($watermark2, 0, 0, 0, 0)); // set black to transparent
	
	imagecopymerge($thumb, $watermark2, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, 100);
}

header('content-type: image/jpeg');
imagejpeg($thumb);
imagedestroy($watermark2);
imagedestroy($watermark);
imagedestroy($thumb);

?>
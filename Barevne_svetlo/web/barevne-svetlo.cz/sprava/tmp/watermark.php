<?php  
//http://blogs.sitepoint.com/watermark-images-php/  
header('content-type: image/jpeg');  
 
$file = './source.jpg';
if($_GET['orient']==1){
	$watermark = imagecreatefrompng('./water.png');
	}
else {
	$watermark = imagecreatefrompng('./water2.png');
	} 
$ratio = $_GET['ratio'] / 100;
	
$watermark_width = imagesx($watermark);  
$watermark_height = imagesy($watermark);  
$image = imagecreatetruecolor($watermark_width, $watermark_height);  
$image = imagecreatefromjpeg($file);  
$size = getimagesize($file);  
$dest_x = $size[0] - $watermark_width - 5;  
$dest_y = $size[1] - $watermark_height - 5;  
imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $_GET['opacity']);
$image2 = imagecreatetruecolor($size[0] * $ratio, $size[1] * $ratio);  
imagecopyresampled($image2, $image, 0, 0, 0, 0, $size[0] * $ratio, $size[1] * $ratio, $size[0],$size[1]);
imagejpeg($image2);  
imagedestroy($image);
imagedestroy($image2);    
imagedestroy($watermark);  

?>
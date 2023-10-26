<?php  
//http://blogs.sitepoint.com/watermark-images-php/  
	header('content-type: image/jpeg');

//nastavení vstupních parametrů
	//$ratio = 1; // resize the final image (0-1)
	$opacity = 10;
	$file = $_SERVER['DOCUMENT_ROOT'].'/images/products_full/id'.$_GET['id'].'_'.$_GET['pic_no'].'.jpg';
	$image = imagecreatefromjpeg($file);  
	$size = getimagesize($file);  

	$watermark = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/images/watermark_logo.png');
	$watermark_width = imagesx($watermark);  
	$watermark_height = imagesy($watermark);
	
	$min_image_size = min($size[0], $size[1]);
	$max_watermark_size = max($watermark_height, $watermark_width); 
	$resample_ratio = $max_watermark_size / $min_image_size * 1.6;
	$watermark2_width = $watermark_width / $resample_ratio;
	$watermark2_height = $watermark_height / $resample_ratio; 

// přizpůsobení velikosti watermarku, aby se vešel do obrázku
	$watermark2 = imagecreatetruecolor($watermark2_width, $watermark2_height);
	imagefill($watermark2, 0, 0, imagecolorallocate($watermark2, 255, 255, 255)); // fill with white
	imagecopyresampled($watermark2, $watermark, 0, 0, 0, 0, $watermark2_width, $watermark2_height, $watermark_width, $watermark_height);
	imagealphablending($watermark2, false);
	imagesavealpha($watermark2, true);	
	imagecolortransparent($watermark2, imagecolorallocatealpha($watermark2, 255, 255, 255, 0)); // set white to transparent
	
// vložení URL obchodu
	$barva = imagecolorallocate($image, 0, 0, 0);
	imagestring($image, 5, $size[0]-200, $size[1]-25, 'www.barevne-svetlo.cz', $barva);

// vložení watermarku
	$dest_x = ($size[0] - $watermark2_width) / 2;  
	$dest_y = ($size[1] - $watermark2_height)  / 2;  
	imagecopymerge($image, $watermark2, $dest_x, $dest_y, 0, 0, $watermark2_width, $watermark2_height, $opacity);
	//$image2 = imagecreatetruecolor($size[0] * $ratio, $size[1] * $ratio);  
	//imagecopyresampled($image2, $image, 0, 0, 0, 0, $size[0] * $ratio, $size[1] * $ratio, $size[0],$size[1]);
	//imagejpeg($image2);
	imagejpeg($image);  
	imagedestroy($image);
	//imagedestroy($image2);    
	imagedestroy($watermark);  
	imagedestroy($watermark2);
?>
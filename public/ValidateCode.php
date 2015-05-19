<?php
ini_set('display_errors', 'Off');
header("Content-type:image/jpeg");

session_start();

$yzm = '';
for ($i = 0; $i < 4; $i ++) {
	
	$yzm .= dechex(rand(6, 15));
}

$yzm = strtoupper($yzm);

$_SESSION['captchas'] = $yzm;

$img = imagecreate(60, 22);

$bg = imagecolorallocate($img, 255, 255, 250);

$fc = imagecolorallocate($img, mt_rand(1,141), mt_rand(1,115), mt_rand(1,13));

for ($i = 0; $i < 8; $i ++) {
	
	 $color = imagecolorallocate($img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));  
     imageline($img,mt_rand(0,145),mt_rand(0, 20),mt_rand(0,145),mt_rand(0,20),$color);  
}

for ($i = 0; $i < 88; $i ++) {
	
	$fc3 = imagecolorallocate($img, rand(0, 41), rand(1, 98), rand(0, 198));
	
	imagesetpixel($img, rand() % 60, rand() % 22, $fc3);
}
for ($i=0;$i<100;$i++) {  
	$color = imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));  
	imagestring($img,mt_rand(1,5),mt_rand(0,145),mt_rand(0,20),'*',$color);  
} 
$font = 'simsun.ttc';

// imagestring($img,rand(15,18),rand(0,10),rand(0,5),$yzm,$fc);

// imagestring($img,$font+50,rand(0,10),rand(0,5),$yzm,$fc);
for ($i=0;$i<4;$i++) { 
    $_x =50 / 4;  
    ImageTTFtext($img, 14, mt_rand(-11,11),$_x*$i+mt_rand(1,3), 20 / 1.4, $fc, $font, $yzm[$i]);
}
imagejpeg($img);

?>
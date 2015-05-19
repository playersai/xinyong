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

$fc = imagecolorallocate($img, 4, 153, 183);

for ($i = 0; $i < 4; $i ++) {
	
	$fc2 = imagecolorallocate($img, rand(100, 205), rand(15, 200), rand(10, 109));
	
	imageline($img, rand(90, 260), 0, 50, 22, $fc2);
}

for ($i = 0; $i < 88; $i ++) {
	
	$fc3 = imagecolorallocate($img, rand(0, 41), rand(1, 98), rand(0, 198));
	
	imagesetpixel($img, rand() % 60, rand() % 22, $fc3);
}

$font = 'ariblk.ttf';

// imagestring($img,rand(15,18),rand(0,10),rand(0,5),$yzm,$fc);

// imagestring($img,$font+50,rand(0,10),rand(0,5),$yzm,$fc);

ImageTTFtext($img, 13, 11, 3, 22, $fc, $font, $yzm);

imagejpeg($img);

?>
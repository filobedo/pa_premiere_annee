<?php
  // session_start();
  // header('Content-type:image/png');

  if(extension_loaded('gd') && function_exists('gd_info')){
    echo 'DONE';
  }
  else{
    echo "ERROR";
  }
  exit;

  echo 'test';
  $_SESSION['captcha'] = mt_rand(1000,9999);
  echo 'test2';
  $img = imagecreate(80,50);

  echo 'test2000';
  $font = 'font/Srisakdi-Bold.ttf';

  $background = imagecolorallocate($img,100,100,100);
  $textcolor = imagecolorallocate($img,0,0,0);
  echo 'test3';
  imagettftext($img, 23, 0, 0, 35, $textcolor, $font, $_SESSION['captcha']);
  echo 'test4';
  imagepng($img,"image/myCaptcha.png");

  imagejpeg($img);
  imagedestroy($img);
?>

<?php

$image = imagecreatefrompng('toocr.png');

$to_crop_array = [

  'x' => 68, 
  'y' => 22, 
  'width' => 58, 
  'height'=> 15,

];

$thumb_im = imagecrop($image, $to_crop_array);

$imageWidth = imagesx($thumb_im);
$imageHeight = imagesy($thumb_im);

for ($i = 0; $i < $imageWidth; $i++) {
    for ($j = 0; $j < $imageHeight; $j++) {
        
        $currentColor = imagecolorat ( $thumb_im , $i, $j );
        
        
        if ( $currentColor != 255 )
        {
        echo $currentColor .PHP_EOL;
          //agesetpixel($thumb_im, $i, $j, imagecolorallocate ( $thumb_im , 0 , 0 , 0));
        }
    }
}

// imagefilter($thumb_im, IMG_FILTER_GRAYSCALE);
// imagefilter($thumb_im, IMG_FILTER_NEGATE);

imagejpeg($thumb_im, 'toocr2.png', 100);

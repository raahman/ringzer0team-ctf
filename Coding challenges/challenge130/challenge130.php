<?php

function check($string){
  
  if ( preg_match('/Nah! Your number is too small/', $string) )
  {
    return 'low';
  }
  elseif ( preg_match('/Nah! Your number is too big/', $string)) 
  {
    return 'high';
  }  
  elseif ( preg_match('/You got the right number/', $string))
  {
    return 'ok';
  }  
  
}

$delay = 230000;
$row = [];
$high = 12000;
$low = 0;
$startNum = round(($high + $low) / 2);

$delta = 1000;
$complete = 0;
$seq = TRUE;

$start = "Start script: " . date('H:i:s') . PHP_EOL;

$connection = ssh2_connect('www.ringzer0team.com', 12643);

if (ssh2_auth_password($connection, 'number', 'Z7IwIMRC2dc764L')) 
{
  echo "Authentication Successful!" . PHP_EOL;
  
  $shell = ssh2_shell($connection);
  
  /*
  * scrittura e lettura a vuoto per ripulire dal messaggio di ben venuto
  */
  fwrite($shell, '');
  
  sleep(1);
  
  for($i=0; $i<=1000; $i++)
  {    
    fwrite($shell, $startNum . PHP_EOL);
    
    usleep($delay);
    
    $row = fread($shell, 1024);
    
    if ( empty($row) ) {
    
      while ( empty($row = fread($shell, 1024)) )
      {
        usleep($delay + 100000);
        echo PHP_EOL . '******** inside while *******' . PHP_EOL;
      }     
      
    }
    
    $log[] = $row;
        
    echo $row . PHP_EOL . PHP_EOL;
    echo '==========' . check($row) . '=============' . PHP_EOL;
    switch(check($row))
    {
      case 'low':
        $low = $startNum;
        $startNum = round(($high + $low) / 2);        
        break;

      case 'high':        
        $high = $startNum;
        $startNum = round(($high + $low) / 2);
        break;
      case 'ok':
        echo '====> ' . $startNum . ' = ' . check($row) . PHP_EOL;
        $high = 12000;
        $low = 0;
        $startNum = round(($high + $low) / 2);
        $complete++;               
        break;
    }
    
    if ( $complete == 10 ) {
      $i = 1001;
    }
  }  
  
  print_r($log);

  echo $start;
  echo "End script: " . date('H:i:s') . PHP_EOL;
} 
else 
{
  die('Authentication Failed...');
}

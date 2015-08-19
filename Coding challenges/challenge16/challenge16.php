<?php
include_once 'vendor/simple_html_dom.php';

/*
* paste session id value es: PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534
* so only : t4p4a7jcifmb0qp90k5mrqr534*
*/
$sessionId = 'flt9dr4gpgf1966j05b3acj6h6';
$toHash = '';

// create curl resource
$ch = curl_init();

// Set url & session cookie
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/16");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . $sessionId);

// $output contains DOM
$output = curl_exec($ch);

// Simple_html_dom function to manipulate HTML
$dom = str_get_html($output);

$xorKey = $dom->find('div[class=message]', 0)->plaintext;
$cryptedMsgBase64 = $dom->find('div[class=message]', 1)->plaintext;

/*
*  Cleanup: tabs, new line and message wrapper
*/
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN XOR KEY -----/',
  '/----- END XOR KEY -----/',
  '/----- BEGIN CRYPTED MESSAGE -----/',
  '/----- END CRYPTED MESSAGE -----/',
];

$xorKey = trim(preg_replace($patterns, '', $xorKey));
$cryptedMsgBase64 = trim(preg_replace($patterns, '', $cryptedMsgBase64));

echo $xorKey .PHP_EOL.PHP_EOL;


$cryptedMsg = base64_decode($cryptedMsgBase64);

for($i=0; $i<=strlen($cryptedMsg); $i++)
{
  $hex = dechex(ord(substr($cryptedMsg, $i, 1)));;
  $s2 = substr($xorKey, $i, 1);
  
  //$s2 = sprintf('%02.x', $s2);
  
  $x = bin2hex(pack('H*',$hex) ^ pack('H*',$s2));
  
  echo $hex . ' ^ ' . $s2 . ' = ' . $x . PHP_EOL;
}
die();

for($i=0; $i<=24; $i++)
{
  $key = substr($xorKey, $i, 10);  
  $cryptedMsg = substr($cryptedMsg, 0, 10);  

  $x = bin2hex(pack('H*',$cryptedMsg) ^ pack('H*',$key));
  echo $x . PHP_EOL;
}

die();
// Send hash
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/16/" . $result);

// Store the result page to grap the FLAG
$output = curl_exec($ch);
$dom = str_get_html($output);

//echo FLAG
echo $dom->find('div[class=alert alert-info]', 0)->plaintext . PHP_EOL;

// for debug purpose
file_put_contents('challenge13.html', $output);

// close curl resource to free up system resources
curl_close($ch);

<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

echo 'Start on seconds: ' . date('s') . PHP_EOL;

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/15");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=beogl972k3m6ad3kld8hcf7871");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$elf = $dom->find('div[class=message]', 0)->plaintext;
$checkSum = $dom->find('div[class=message]', 1)->plaintext;

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN Checksum -----/',
  '/----- END Checksum -----/',
];

$patterns2 = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN Elf Message -----/',
  '/----- End Elf Message -----/',
];

$elf = preg_replace($patterns2, '', $elf);
$elf = trim($elf);

$decode64 = base64_decode($elf);

if ( $decode64 ) 
{
  file_put_contents('elf-base64', $decode64);
}
else
{
  echo 'Base64 fail';
}


$checkSum = preg_replace($patterns, '', $checkSum);
$checkSum = trim($checkSum);

echo $elf . PHP_EOL;
echo $checkSum . PHP_EOL;

die();

/*
*  chiamata per il ricevere il flag
*/ 

curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/15/" . $result);

echo 'Ends on seconds: ' . date('s') . PHP_EOL;
// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge15.html', $output);


// close curl resource to free up system resources
curl_close($ch);

<?php
include_once 'vendor/simple_html_dom.php';

// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/121");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534");

// $output contains the output string
$output = curl_exec($ch);

// for debug
// file_put_contents('challenge13.html', $output);

$dom = str_get_html($output);

$toDecode = '';

foreach ($dom->find('div[class=message]') as $e ) {
  $toDecode = $e->plaintext;
}

// cleanup
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN SHELLCODE -----/',
  '/----- END SHELLCODE -----/',
];

$toDecode = preg_replace($patterns, '', $toDecode);
$toDecode = trim($toDecode); 

//echo $toDecode . PHP_EOL;

$pyFile = file_get_contents('shell.py');

$patterns = [
  '/cicciopasticcio/',
];

$pyFile = preg_replace($patterns, $toDecode, $pyFile);

file_put_contents('shell2.py', $pyFile);

echo exec('./bash.sh');

$row = [];

$handle = @fopen("text.txt", "r");
if ($handle) {
    $i = 0;
    while (($buffer = fgets($handle, 4096)) !== false) {
        $row[$i] = $buffer;
        
        if ($i > 2) {
          $i = 0;
        }else {
          $i++;
        }
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

$result = substr($row[1], 10, 12);

// chiamata per il ricevere il flag
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/121/" . $result);

// $output contains the output string
$output = curl_exec($ch);

// for debug
file_put_contents('challenge121.html', $output);

// close curl resource to free up system resources
curl_close($ch);

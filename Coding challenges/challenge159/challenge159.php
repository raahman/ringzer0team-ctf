<?php
include_once 'vendor/simple_html_dom.php';

function sampling($chars, $size, $combinations = array()) {

    # if it's the first iteration, the first set 
    # of combinations is the same as the set of characters
    if (empty($combinations)) {
        $combinations = $chars;
    }

    # we're done if we're at size 1
    if ($size == 1) {
        return $combinations;
    }

    # initialise array to put new values in
    $new_combinations = array();

    # loop through existing combinations and character set to create strings
    foreach ($combinations as $combination) {
        foreach ($chars as $char) {
            $new_combinations[] = $combination . $char;
        }
    }

    # call same function again for the next iteration
    return sampling($chars, $size - 1, $new_combinations);

}

// example
echo date ('s') . PHP_EOL;
$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$output = sampling($chars, 6);
echo date ('s') . PHP_EOL;
//var_dump($output);


/*
* paste session id value es: PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534
* so only : t4p4a7jcifmb0qp90k5mrqr534*
*/
$sessionId = '06b1sjb1k926poqghrlljtbre5';
$toHash = '';

// create curl resource
$ch = curl_init();

// Set url & session cookie
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/159");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=" . $sessionId);

// $output contains DOM
$output = curl_exec($ch);

// Simple_html_dom function to manipulate HTML
$dom = str_get_html($output);
$toHash = $dom->find('div[class=message]', 0)->plaintext;

/*
*  Cleanup: tabs, new line and message wrapper
*/
$patterns = [
  '/\t+/',
  '/\n+/',
  '/----- BEGIN HASH -----/',
  '/----- END HASH -----/',
];

$toHash = preg_replace($patterns, '', $toHash);
$toHash = trim($toHash); 

// Hash the message
$tmp = 'd94b40537b362801da53091372967c34ad9d9161';
echo $toHash; 

die();

// Send hash
curl_setopt($ch, CURLOPT_URL, "http://ringzer0team.com/challenges/159/" . $result);

// Store the result page to grap the FLAG
$output = curl_exec($ch);
$dom = str_get_html($output);

//echo FLAG
echo $dom->find('div[class=alert alert-info]', 0)->plaintext . PHP_EOL;

// for debug purpose
file_put_contents('challenge159.html', $output);

// close curl resource to free up system resources
curl_close($ch);

<?php
include_once 'vendor/simple_html_dom.php';

function checkSha($toHash){
	$servername = "localhost";
	$username = "root";
	$password = "root";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=hash", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT string FROM hash WHERE sha1 = '" . $toHash ."'" ;
		foreach ($conn->query($sql) as $result)
		{
			return $result['string'];
		}
	
	    }
	catch(PDOException $e)
	    {
	    echo $sql . PHP_EOL . $e->getMessage();
	    }

	$conn = null;
}

/*
* paste session id value es: PHPSESSID=t4p4a7jcifmb0qp90k5mrqr534
* so only : t4p4a7jcifmb0qp90k5mrqr534*
*/
$sessionId = '65b9gha3718oo3lu328o8o0b44';
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
$result = checkSha($toHash);

if (empty($result)) {
	die('Non trovata. - '. $toHash .PHP_EOL);
}

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

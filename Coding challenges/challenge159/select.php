<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
	$conn = new PDO("mysql:host=$servername;dbname=hash", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$toHash = 'c984aed0144ec7623a54f0591da07a85fd4b762d';

	$sql = "SELECT string FROM hash WHERE sha1 = '" . $toHash ."'" ;
	foreach ($conn->query($sql) as $result)
	{
		echo $result['string'];
	}
	


    }
catch(PDOException $e)
    {
    echo $sql . PHP_EOL . $e->getMessage();
    }

$conn = null;

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
    define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
    define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
    define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
    define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));

    $dbhost = constant("DB_HOST"); // Host name
    $dbport = constant("DB_PORT"); // Host port
    $dbusername = constant("DB_USER"); // Mysql username
    $dbpassword = constant("DB_PASS"); // Mysql password
    $db_name = constant("DB_NAME"); // Database name


	$sQuery ='%';

	if(array_key_exists('q', $_GET))
	{
		$sQuery = $_GET['q'];
	}

	$dbh = new PDO("mysql:host=$dbhost;post=$dbport;dbname=NIS", $dbusername, $dbpassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//query from view
	$result = $dbh->prepare("SELECT id, categoryId, title, imageURL, timestamp, userId, description FROM news");
	$result->execute(array($sQuery));

	if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
		header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
		header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
		header("Access-Control-Allow-Credentials: true");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
	}

	header("Content-type:application/json; charset=UTF-8");
	echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));

    $dbh = null;
?>


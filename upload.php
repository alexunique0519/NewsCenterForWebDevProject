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

	if(array_key_exists("HTTP_ORIGIN", $_SERVER)){
	         header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
	         header("Access-Control-Allow-Headers: X-Requested-With, X-Authorization, Content-Type, X-HTTP-Method-Override");
	         header("Access-Control-Allow-Credentials: true");
	         header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    }

	$dbh = new PDO("mysql:host=$dbhost;post=$dbport;dbname=NIS", $dbusername, $dbpassword);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(array_key_exists("title_name", $_POST) )
	{
		$sSource = $_POST["source_name"];
		$sTitle = $_POST["title_name"];
		$sCategory = $_POST["category_name"];
		$sArticle = $_POST["article_name"];
		$sLink = $_POST["link_name"];
		$sUserId = '1';

		//Get Current datetime
		date_default_timezone_set('America/Toronto');
		$sTime = date("Y-m-d H:i:s");


		$statement = $dbh->prepare("INSERT INTO news(`categoryId`, `source`,`title`, `imageURL`, `timestamp`, `userId`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		try{
			$row = $statement->execute(array($sCategory, $sSource, $sTitle, $sLink, $sTime, $sUserId, $sArticle));
			$result = $row . "piece of news added";

			if($row > 0)
			{
			    echo json_encode(array('result' => $row .'record has been inserted'));
            	//return true;
        	}

		}
		catch (Exception $e){

		}
	}

	$dbh = null;
?>
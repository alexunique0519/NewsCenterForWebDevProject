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

	$dbh = new PDO("mysql:host=$dbhost;post=$dbport;dbname=NIS", $dbusername, $dbpassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	if(array_key_exists("ids", $_POST) )
	{
		$aIds = $_POST["ids"];
		
        $arraySize = count($aIds);
        
        
        foreach ($aIds as $value) {
                $statement = $dbh->prepare("DELETE FROM news WHERE id=?");
            	$row = $statement->execute(array($value));
                $arraySize -= $row;
                
                /*if($row == 1)
                {
                    $deletedCounter++;
                }*/
        } 
	   
        
        
        if($arraySize == 0)
        {
		   echo json_encode(array('result' => $row . 'records has been deleted'));
            	//return true;
        }

    }


	

    $dbh = null;
?>

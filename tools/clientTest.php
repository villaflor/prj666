 <?php
    include_once('client.php');
    include_once("sql.php");

    $db = Database::getInstance();

	//create an object
    $client = new Client($db,5);
	
    echo $client->getClientName();
    echo $client->getClientSiteTitle();
    echo $client->getClientInfo();
    echo $client->getClientUserName();
    echo $client->getClientEmail();

?>
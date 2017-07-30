<header>
	<?php
        include '/data/www/default/wecreu/tools/good.php';
        include '/data/www/default/wecreu/tools/category.php';
        include_once '/data/www/default/wecreu/tools/sql.php';
        include_once('/data/www/default/wecreu/tools/client.php');
        include_once("/data/www/default/wecreu/tools/page.php");
        $clientid = file_get_contents('conf.ini');

        $db = Database::getInstance();
        $category = new Category($db,$clientid);
        $allcategory = $category->getAll();
        $client = new Client($db,$clientid);
        $page = new Page($db,$clientid);
    ?>
	<img src="images/logo.jpg" alt="logo" height="130" width="140" />
			
	<form>
		<input type="text" name="keyword" /> Search
	</form>
	<h1><?php echo $client->getClientSiteTitle(); ?></h1>
			
</header>
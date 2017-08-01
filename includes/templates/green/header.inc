<?php
    /*$clientId = file_get_contents('conf.ini');
    include_once('/data/www/default/wecreu/tools/category.php');
    include_once("/data/www/default/wecreu/tools/sql.php");
    include_once("/data/www/default/wecreu/tools/client.php");
    include_once("/data/www/default/wecreu/tools/page.php");

	//create an object
    $db = Database::getInstance();
    $category = new Category($db,$clientId);
    $page = new Page($db,$clientId);
    $client = new Client($db,$clientId);*/
    ?>
<div class="container">
    <table class="mx-auto">
        <tbody>
        <tr>
            <td>
                <img src="images/logo.jpg" alt="Logo" class="rounded-circle" style="width: 100px;">
            </td>
            <td>
                <h1 class="text-right text-sm-center" style="font-size: 50px"><?php echo $client->getClientSiteTitle(); ?></h1>
            </td>
        </tr>
        </tbody>
    </table>
</div>

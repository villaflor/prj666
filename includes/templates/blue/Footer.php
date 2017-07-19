<footer>
     <?php
     $clientId = file_get_contents("conf.ini");
     $url = "/data/www/default/wecreu/companyInfo/footer/".$clientId.".txt";
     if (file_exists($url)) {
       $content = file_get_contents($url);
       echo $content;
     }
     ?>
</footer>

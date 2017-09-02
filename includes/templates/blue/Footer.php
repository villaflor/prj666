<!--
Blue template - Footer 
retrieves and provides information that client company wants to put in footer, formatted for BLUE template

HTML/CSS created by Olga
-->
<footer>
<div style="word-wrap: break-word">
     <?php
     $clientId = file_get_contents("conf.ini");
     $url = "/data/www/default/wecreu/companyInfo/footer/".$clientId.".txt";
     if (file_exists($url)) {
       $content = file_get_contents($url);
       echo $content;
     }
     ?>
</div>
</footer>

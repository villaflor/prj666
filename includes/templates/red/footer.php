<div class="row footer" style="word-wrap: break-word">
  <br>
 	 <p class="copyright-text">
     <?php
     $url = "/data/www/default/wecreu/companyInfo/footer/".$clientId.".txt";
     if (file_exists($url)) {
       $content = file_get_contents($url);
       echo $content;
     }
     ?>
   </p>
</div>

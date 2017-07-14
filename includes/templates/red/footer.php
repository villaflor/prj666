<div class="row footer">
  <br>
  <div class="col-md-12 text-center">
 	 <p class="copyright-text">
     <?php
           $url = "/data/www/default/wecreu/companyInfo/footer/".$clientId.".txt";
           if (file_exists($url)) {
             $content = file_get_contents($url);
             echo $content;
           }else{
             echo "@ ". $client->getClientSiteTitle();
           }
           ?>
   </p>
  </div>
  <br>
  <br>
  <br>
  <br>
</div>

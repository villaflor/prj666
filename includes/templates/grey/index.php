<?php
    $isLogin=true; //TODO
    $clientId = file_get_contents('conf.ini'); 
    include_once('../../../tools/category.php');
    include_once("../../../tools/sql.php");
    include_once("../../../tools/client.php");

	//create an object
    $db = Database::getInstance();
    $category = new Category($db,$clientId);
    $client = new Client($db,$clientId);
    ?>

    <!DOCTYPE html>
    <html class="no-js">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>
        <?php
        echo $client->getClientSiteTitle();
        ?>
      </title> 
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/font-awesome.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/templatemo-style.css">
      <script src="js/vendor/modernizr-2.6.2.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <script>
        $(document).ready(function(){
         <?php
         $cClick = $category->getAllAvaliable();
         while ($row = mysqli_fetch_assoc($cClick)) {
           ?>
           $("<?php echo "#c$row[category_id]"; ?>").click(function(){
            $("#good").attr("src","good.php?cid=<?php echo "$row[category_id]"; ?>");
          });
           <?php
         }
         ?>

         $("#shoppingCart").click(function(){
          $("#good").attr("src","cart.php");
        });
       });

     </script>
     <style>
       .banner-bg { background: url("../../../images/covers/<?php echo $clientId;?>.jpg"); }
       input{ vertical-align:middle; margin:0; padding:0}
       .file-box{ position:relative;width:340px}
       .txt{ height:22px; border:1px solid #cdcdcd; width:180px;}
       .btnUp{ background-color:#FFF; border:1px solid #CDCDCD;height:24px; width:70px;}
       .file{ position:absolute; top:0; right:80px; height:24px; filter:alpha(opacity:0);opacity: 0;width:260px }
       .dropdown {position: relative;display: inline-block; }
       .dropdown-content { position: relative; display: none; background-color: #495461;
        min-width: 160px; z-index: 1; padding: 10px; }
        .dropdown-content a { margin: 0 0 0px 28px;}
        .dropdown:hover .dropdown-content { display: block; }
      </style>

    </head>
    <body>
      <!-- SIDEBAR -->
      <div class="sidebar-menu hidden-xs hidden-sm">
        <div class="top-section">
          <div class="profile-image">
            <a href="index.php"> <img src="images/logo.png" alt="logo"></a>
          </div>
          <h3 class="profile-title">
            <?php
            echo $client->getClientSiteTitle();
            ?>
          </h3>
          <p class="profile-description">
            <?php
            echo $client->getClientInfo();
            ?>
          </p>
        </div> <!-- top-section -->
        <div class="main-navigation">
          <ul class="navigation">
            <li><a href="#top"><i class="fa fa-globe"></i>Welcome</a></li>
            <li class="dropdown"><a href="#products"><i class="fa fa-star"></i>Products</a>
              <ul class="dropdown-content ">
               <?php
               $side = $category->getAllAvaliable();
               while ($row = mysqli_fetch_assoc($side)) {
                 echo "<li id='c$row[category_id]'"."><a href='#products'>$row[category_name]"."</a></li>";
               }
               ?>
             </ul>
           </li>
           <li id="shoppingCart"><a href="#products"><i class="fa fa-shopping-cart"></i>Cart</a></li>
           <li><a href="#aboutUs"><i class="fa fa-pencil"></i>About us</a></li>
           <li><a href="#contact"><i class="fa fa-link"></i>Contact us</a></li>
         </ul>
       </div> <!-- .main-navigation -->
     </div> <!-- .sidebar-menu -->

     <div class="banner-bg" id="top">
      <div class="banner-overlay"></div>
      <div class="welcome-text">
        <h2>
          <?php
          echo $client->getClientSiteTitle();
          ?>
        </h2> 
        <h5>
          <?php
          echo $client->getClientInfo();
          ?>
        </h5> 
      </div>
    </div>



    <!-- MAIN CONTENT -->
    <div class="main-content">
      <div class="fluid-container">
        <div class="content-wrapper">



          <!-- products -->
          <div class="page-section" id="products">
           <div class="row">
            <div class="col-md-12">
              <h4 class="widget-title">Products</h4>
              <p></p>
            </div>
          </div>
          <div class="row">

            <div class="col-md-8 col-sm-9">
              <iframe id="good" src="good.php" style="width: 90vw;height: 100vh;position: relative; overflow-x: hidden;" >
                <p>Your browser does not support</p>
              </iframe>
            </div>
          </div>
        </div>

        <!-- About us -->
        <div class="page-section" id="aboutUs">
          <div class="row">
           <div class="col-md-12">
            <h4 class="widget-title">ABOUT US</h4>
            <hr>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
          <?php 
          $url = "../../../companyInfo/aboutUs/".$clientId.".txt";
          $content = file_get_contents($url);
          echo $content;
          ?>
        </div>
      </div>
    </div>
    <hr>

    <!-- CONTACT -->
    <div class="page-section" id="contact">
      <div class="row">
       <div class="col-md-12">
        <h4 class="widget-title">CONTACT US</h4>
      </div>
    </div>
    <div class="row">
     <form action="../../../tools/email.php" method="post" class="contact-form">
      <fieldset class="col-md-4 col-sm-6">
        <input type="text" id="name" name="name" placeholder="Your Name...">
      </fieldset>
      <fieldset class="col-md-4 col-sm-6">
        <input type="email" id="email" name="email" placeholder="Your Email...">
      </fieldset>
      <fieldset class="col-md-4 col-sm-12">
        <input type="text" id="your-subject" name="your-subject" placeholder="Subject...">
      </fieldset>
      <fieldset class="col-md-12 col-sm-12">
        <textarea name="message" id="message" cols="30" rows="6" placeholder="Leave your message..."></textarea>
      </fieldset>
      <fieldset class="col-md-12 col-sm-12">
        <input type="hidden" name="method" value="sendEmail">
        <input type="submit" class="button big default" value="Send Message">
      </fieldset>
    </form>
  </div> <!-- .contact-form -->
</div>

<!-- upload -->
<?php
if($isLogin){
  ?>
  <hr/>
  <div class="page-section" id="upload">
    <div class="row">
     <div class="col-md-12">
       <h4 class="widget-title">CHANGE COVER FOR SITE OWNER</h4>
     </div>
   </div>
   <div class="row">
    <div class="col-md-12">
      <div class="file-box">
        <form action="../../../tools/uploadCover.php" method="post" enctype="multipart/form-data">
          <input type='text' name='textfield' id='textfield' class='txt' />  
          <input type='button' class='btnUp' value='Browse' />
          <input type="file" name="fileToUpload" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" />
          <input type="hidden" value="<?php echo $clientId; ?>" name="id">
          <input type="submit" name="submit" class="btnUp" value="upload" />
          <p><b>jpg, jpeg, bmp, gif, png</b> only</p>
        </form>
      </div>
      <p>If you can't see the new cover, please <b>clean</b> your browser cache</p>
    </div>
  </div> 
</div>
<hr/>
<?php
}
?>




<div class="row" id="footer">
  <div class="col-md-12 text-center">
    <p class="copyright-text">&copy; <?php echo $client->getClientSiteTitle(); ?>
    </p>
  </div>
</div>

</div>
</div>
</div>

<script src="js/vendor/jquery-1.10.2.min.js"></script>
<script src="js/min/plugins.min.js"></script>
<script src="js/min/main.min.js"></script>

</body>
</html>


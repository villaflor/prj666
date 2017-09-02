<?php
    // init for all needed information
    $clientId = file_get_contents('conf.ini');
    include_once('/data/www/default/wecreu/tools/category.php');
    include_once("/data/www/default/wecreu/tools/sql.php");
    include_once("/data/www/default/wecreu/tools/client.php");
    include_once('/data/www/default/wecreu/tools/page.php');

	//create an object
    $db = Database::getInstance();
    $category = new Category($db,$clientId);
    $client = new Client($db,$clientId);
    $page = new Page($db,$clientId);
    ?>
    <!-- HTML starts here -->
    <!DOCTYPE html>
    <html >
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
      <link rel="stylesheet" href="css/main.css">
      <script src="css/modernizr-2.6.2.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <!-- to deal with category on click -->
      <script>
        $(document).ready(function(){
         <?php
         $cClick = $category->getAll();
         while ($row = mysqli_fetch_assoc($cClick)) {
           ?>
            $("<?php echo "#c$row[category_id]"; ?>").click(function(){
            $("#good").attr("src","good.php?cid=<?php echo "$row[category_id]"; ?>");
          });
           <?php
         }
         ?>


         $("#shoppingCart").click(function(){
          $("#good").attr("src","viewCart.php");
        });
        //  all categories onclick listener
        $("#allCategories").click(function(){
            $("#good").attr("src","good.php?cid=*");
        });

       });

     </script>
     <style>
       .banner-bg { background: url("/wecreu/images/covers/<?php echo $clientId;?>.jpg"); }
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
      <?php
      if (file_exists ("../template.php")){
        $color="#4b4854";
        include_once("../template.php");
      }
      ?>
      <!-- SIDEBAR -->
      <div class="sidebar-menu hidden-xs">
        <div class="top-section">
          <div class="profile-image">
            <a href="index.php"> <img src="images/logo.jpg" alt="logo"></a>
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
        </div>
        <div class="main-navigation">
          <ul class="navigation">
            <li><a href="#top"><i class="fa fa-globe"></i>Welcome</a></li>
            <li class="dropdown"><a  id='allCategories' href="#products"><i class="fa fa-star"></i>Products</a>
              <ul class="dropdown-content ">
               <?php
               // to list all categories
               $side = $category->getAll();
               while ($row = mysqli_fetch_assoc($side)) {
                 echo "<li id='c$row[category_id]'"."><a href='#products'>$row[category_name]"."</a></li>";
               }
               ?>
             </ul>
           </li>
           <li id="shoppingCart"><a href="#products"><i class="fa fa-shopping-cart"></i>Cart</a></li>
           <li><a href="#aboutUs"><i class="fa fa-pencil"></i>About us</a></li>
           <?php
           // to list all pages
           $alldata = $page->getAll();
           while ($row = mysqli_fetch_assoc($alldata)) {
              echo '<li><a href="#' . $row['id'] . '"><i class="fa fa-link"></i>' . $row['page_name'] . '</a></li>';
           }
           ?>
           <li><a href="#contact"><i class="fa fa-link"></i>Email Us</a></li>
         </ul>
       </div> <!-- .main-navigation -->
     </div> <!-- .sidebar-menu -->

     <!-- The texts for cover -->
     <div class="banner-bg" id="top">
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

    <!-- main -->
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
              <iframe id="good" src="feature.php" style="width: 90vw;height: 100vh;position: relative; overflow-x: hidden;" >
                <p>Your browser does not support</p>
              </iframe>
            </div>
          </div>
        </div>

        <!-- About us -->
        <hr>
        <div class="page-section" id="aboutUs">
          <div class="row">
           <div class="col-md-12">
            <h4 class="widget-title">ABOUT US</h4>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
          <?php
          $url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
          if (file_exists($url)) {
            $content = file_get_contents($url);
            echo $content;
          }
          ?>
        </div>
      </div>
    </div>
    <hr>

    <!-- dynamic page -->
    <?php
    $alldata = $page->getAll();
    while ($row = mysqli_fetch_assoc($alldata)) {
        ?>
        <div class="page-section" id="<?php echo $row['id'];?>">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="widget-title"><?php echo $row['page_name'];?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $url = "/data/www/default/wecreu/companyInfo/page/".$clientId."/".$row['id'].".txt";
                    if (file_exists($url)) {
                        $content = file_get_contents($url);
                        echo $content;
                    }else{
                        echo "<h1>Page not found</h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <hr>
        <?php
    }
    ?>

    <!-- CONTACT -->
    <div class="page-section" id="contact">
      <div class="row">
       <div class="col-md-12">
        <h4 class="widget-title">EMAIL US</h4>
        <p>Note: Your message will be sent to site owner's email: <b><?php echo $client->getClientEmail();?></b></p>
      </div>
    </div>
    <div class="row">
     <form action="/wecreu/tools/email.php" method="post" class="contact-form">
      <fieldset class="col-md-4 col-sm-6">
        <input type="text" id="name" name="name" placeholder="Your Name">
      </fieldset>
      <fieldset class="col-md-4 col-sm-6">
        <input type="email" id="email" name="email" placeholder="Your Email">
      </fieldset>
      <fieldset class="col-md-4 col-sm-12">
        <input type="text" id="your-subject" name="your-subject" placeholder="Your Subject">
      </fieldset>
      <fieldset class="col-md-12 col-sm-12">
        <textarea name="message" id="message" cols="30" rows="6" placeholder="Your message"></textarea>
      </fieldset>
      <fieldset class="col-md-12 col-sm-12">
        <input type="hidden" name="method" value="sendEmail">
        <input type="hidden" name="to" value="<?php echo $client->getClientEmail()?>">
        <input type="hidden" name="url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>">
        <input type="submit" class="button big default" value="Send Message">
      </fieldset>
    </form>
  </div>
</div>

<div class="row" id="footer" style="word-wrap: break-word">
  <div class="col-md-12">
    <hr/>
    <br/>
    <?php
    $url = "/data/www/default/wecreu/companyInfo/footer/".$clientId.".txt";
    if (file_exists($url)) {
    $content = file_get_contents($url);
    echo $content;
    }else{
    echo "@ ". $client->getClientSiteTitle();
    }
    ?>
    <br/>
  </div>
</div>

</div>
</div>
</div>

<script src="css/jquery-1.10.2.min.js"></script>
<script src="css/plugins.min.js"></script>
<script src="css/main.min.js"></script>

</body>
</html>

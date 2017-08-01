<div class="row header">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <!-- search bar -->
    <div class="row">
      <div class="col-md-4 col-md-offset-9 col-sm-6 col-sm-offset-6 col-xs-offset-3 col-xs-8">
        <form action="search.php" method="GET">
          <input type="text" name="keyword" value="">
          <input type="submit" value="search">
        </form>
      </div>
    </div>
    <div class="row">
      <!-- logo -->
      <div class="col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-3 col-xs-offset-1 col-xs-4 ">

      <a href="index.php">
        <img src="images/logo.jpg" class="logo img-responsive" alt="Responsive image">
      </a>
      <br>
      </div>
      <!-- company name -->
      <br>
      <div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-5 col-xs-offset-1 cname"><p>
        <?php
          echo $client->getClientSiteTitle();
        ?>
      </p></div>
    </div>
  </div>
</div>

<!-- nar bar -->
<div class="row narbar">
  <div class="col-md-10 col-sm-10 col-xs-106">
    <nav class="mnavbar">
      <ul class="nav nav-pills">
        <li><a href="index.php">Home</a></li>
        <li><a href="good.php">Products</a></li>
        <li><a href="info.php">About Us</a></li>
        <?php $contact = file_get_contents("contact.ini");
		if($contact == 1) {?>
		<li><a href="contact-us.php">Contact Us</a></li>
		
        <?php
		}
        $alldata = $page->getAll();
        while ($row = mysqli_fetch_assoc($alldata)) {
          echo '<li><a href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a></li>';
        }
        ?>
      </ul>
    </nav>
  </div>
  <!-- icons -->
  <div class="col-md-2 col-sm-2 col-xs-2">
    <a href="cart.php"> <img class="pull-right hicon" src="images/cart.gif" alt="Cart"> </a>
  </div>

</div>

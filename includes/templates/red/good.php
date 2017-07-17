<!DOCTYPE html>
<html lang="en">
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->
  <?php include_once("category.php");?>

  <div class="col-md-9 col-sm-9 col-xs-9 goodlist cf">
  <?php
  for($i = 0; $i < 12; $i++){
  ?>
    <div class="item col-md-12 col-sm-4 col-xs-4">
      <a href='detail.php'>
         <img src="/wecreu/images/cover.jpg" class="img-responsive" alt="Cinque Terre">
        <p>Name:</p> <p>Price:</p>
      </a>
  </div>
  <?php
  }
  ?>
  </div>
    <div class="row">
      <div class="btn-group pull-right" role="group" aria-label="...">
        <a href="#" class="btn" role="button">First page</a>
        <a href="#" class="btn" role="button">1</a>
        <a href="#" class="btn" role="button">2</a>
        <a href="#" class="btn" role="button">Last page</a>
      </div>
    </div>
  </div>
</div>
  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>

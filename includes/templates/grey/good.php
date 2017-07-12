<!DOCTYPE html>
<html class="no-js">
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/table.css">

  <style>
   .container-m {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: 10px;
        margin-left: 10px;
    }

  </style>
  </head>
  <body>


  <div class="container-m bg-faded pt-5 goodlist cf col-md-9 col-sm-12 col-xs-12">
  <?php
  for($i = 0; $i < 12; $i++){
  ?>
    <div class="item col-md-6 col-sm-6 col-xs-6">
      <a href='detail.php'>
         <img src="/wecreu/images/logo.jpg" class="img-responsive" alt="Good">
        <p>Name:</p> <p>Price:</p>
      </a>
  </div>
  <?php
  }
  ?>
  </div>
    <div class="row col-md-9 col-sm-9 col-xs-9">
      <div class="btn-group" role="group" aria-label="...">
        <a href="#" class="btn" role="button">First page</a>
        <a href="#" class="btn" role="button">1</a>
        <a href="#" class="btn" role="button">2</a>
        <a href="#" class="btn" role="button">Last page</a>
      </div>
    </div>
  </div>
  </body>
</html>
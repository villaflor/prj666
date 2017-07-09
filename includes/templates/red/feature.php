  <div class="col-md-9 col-sm-9 col-xs-9 goodlist cf">

  <?php
  require_once("/data/www/default/wecreu/tools/search.php");
  include_once("/data/www/default/wecreu/tools/sql.php");

  $db = Database::getInstance();

  //create an object
  $search = new Search($db,$clientId);

  // call get all
  $limit=12;
  $offSet=0;

  if(!isset($_GET['keyword'])){
    $alldata = $search->getAll($limit,$offSet);
  } else{
    $keyword=$_GET['keyword'];
    $alldata = $search->searchGood($keyword,$limit,$offSet);
  }

  while ($row = mysqli_fetch_assoc($alldata)) {
    ?>
    <div class="item col-md-12 col-sm-4 col-xs-4">
      <a href='detail.php?id=<?php echo $row['good_id'];?>'>
         <img src="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" class="img-responsive" alt="Cinque Terre">
        <p>
          <?php
          $name = $row['good_name'];
          $length = strlen($name);
          if ($length > 16){
            $name = substr($name, 1 ,16)."...";
          }
          echo $name;
          ?>
        </p> <p>$<?php echo $row['good_price'];?></p>
      </a>
  </div>
  <?php
  }

  ?>
  </div>

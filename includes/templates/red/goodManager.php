<!DOCTYPE html>
<html lang="en">
<?php include_once("headmeta.php");?>

<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="row">
      <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10">
          <a href="goodAdd.php">Add new good</a>
          <br/>
          <br/>
          <table class="table table-striped">
          <tr>
            <th></th>
            <th>Product name</th>
            <th>Price</th>
            <th></th>
          </tr>
          <?php
          for ($i=0;$i<10;$i++){
          ?>
          <tr>
            <td><img src="../../images/logo.jpg"></td>
            <td style="vertical-align:middle;">Awesome name</td>
            <td style="vertical-align:middle;">$1000</td>
            <td style="vertical-align:middle;"><a href="goodEdit.php">Edit</a> | <a href="goodDelete.php">Delete</a></td>
          </tr>

          <?php
          }
          ?>
          </table>
      </div>  
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

  </div><!-- end of body -->

  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>

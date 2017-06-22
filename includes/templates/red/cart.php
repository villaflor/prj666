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

  <!-- cart -->
    <div class="col-md-9 col-sm-9 col-xs-9">
      <h1>Shopping Cart</h1>
        <table class="table table-striped">
          <tr>
            <th></th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th></th>
          </tr>
          <tr>
            <td style="vertical-align:middle;">
              <img class="image" src="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" alt="image">
            </td>
            <td style="vertical-align:middle;">name</td>
            <td style="vertical-align:middle;">qty</td>
            <td style="vertical-align:middle;">price</td>
            <td style="vertical-align:middle;"><a href="remove.php">remove</a></td>
          </tr>
          <tr>
            <td style="vertical-align:middle;">
              <img class="image" src="http://th25.st.depositphotos.com/5142301/7567/v/450/depositphotos_75677235-stock-illustration-lion-head-logo.jpg" alt="image">
            </td>
            <td style="vertical-align:middle;">name</td>
            <td style="vertical-align:middle;">qty</td>
            <td style="vertical-align:middle;">price</td>
            <td style="vertical-align:middle;"><a href="remove.php">remove</a></td>
          </tr>
        </table>
    </div>
        <h3>Totle of 6 items Total Price: $200</h3>
        <button type="button" class="pull-right btn btn-default">checkout</button>

  </div>
  
    <div class="row">
      <div class="btn-group pull-right" role="group" aria-label="...">
        <button type="button" class="btn btn-default">First page</button>
        <button type="button" class="btn btn-default">1</button>
        <button type="button" class="btn btn-default">2</button>
        <button type="button" class="btn btn-default">3</button>
        <button type="button" class="btn btn-default">Last page</button>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>

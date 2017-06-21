<!doctype html>
<html>
<head>
<?php include_once("cart-metadata.php");?>
</head>

<body>
<div class="clearfix borderbox" id="page"><!-- column -->
  <?php include_once("header-nav.php");?>
  
  <table width="250" height="50" border="0" style="margin-top: 300px; margin-left: auto; margin-right: auto">
  <tbody>
    <tr>
      <td style="font-size: 30px;">Shopping Cart</td>
      <td><img src="images/28468-200.png" width="35" height="35" alt="cart"/></td>
    </tr>
  </tbody>
</table>

  <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="273" data-content-below-spacer="727" style="margin-top: 100px;">
  	<table width="100%" >
  <tbody>
   	<tr>
   	  <td style="width: 20%;"></td>
      <td style="width: 20%;"></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Quantity</p></td>
      <td style="width: 20%;"></td>
      <td style="width: 20%;"></td>
   	</tr>
    <tr>
      <td style="width: 20%;padding-top: 50px"><img src="images/pr_source.jpg" alt="" height="150" width="150"></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Product's name</p></td>
      <td style="width: 20%;"><select style="width: 25%;">
      	<option>1</option>
    	<option>2</option>
    	<option>3</option>
    	<option>4</option>
    	<option>5</option>
    	<option>6</option>
    	<option>7</option>
    	<option>8</option>
    	<option>9</option>
    	<option>10</option>
    
    	
      </select></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Product's price</p></td>
      <td style="width: 20%;"><a href="" style="font-size: 25px;">Remove</a></td>
    </tr>
    
     <tr>
      <td style="width: 20%; padding-top: 100px"><img src="images/pr_source.jpg" alt="" height="150" width="150"></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Product's name</p></td>
      <td style="width: 20%;"><select style="width: 25%;">
      	<option>1</option>
    	<option>2</option>
    	<option>3</option>
    	<option>4</option>
    	<option>5</option>
    	<option>6</option>
    	<option>7</option>
    	<option>8</option>
    	<option>9</option>
    	<option>10</option>
    
    	
      </select></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Product's price</p></td>
      <td style="width: 20%;"><a href="" style="font-size: 25px;">Remove</a></td>
    </tr>
    <tr >
   	  <td style="width: 20%; padding-top: 100px"></td>
      <td style="width: 20%;"></td>
      <td style="width: 20%;"></td>
      <td style="width: 20%;">---------------------------------</td>
      <td style="width: 20%;"></td>
   	</tr>
    <tr >
   	  <td style="width: 20%; padding-top: 100px"></td>
      <td style="width: 20%;"></td>
      <td style="width: 20%;"><p style="font-size: 25px;">Total of items</p></td>
      <td style="width: 20%;"><p style="font-size: 25px;">$Total price</p></td>
      <td style="width: 20%;"></td>
   	</tr>
  </tbody>
</table>

  	<button type="button" style="width: 126px; height: 50px; border-radius: 10px; margin-left: 60%; margin-top: 100px; font-size: 20px; background-color: beige;">To checkout</button>
  </div>
  
 <?php include_once("footer.php");?>
</div>
</body>
</html>

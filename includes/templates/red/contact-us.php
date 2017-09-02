<!DOCTYPE html>
<html lang="en">
 <style>
    .fhead {
      text-align: center;
      justify-content: center
    }

    .centeredImage {
      position: absolute;
      left: 40%;
      text-align:center;
    }

    .left{
      text-align:right;
    }

  </style>
<?php include_once("headmeta.php");?>
<body >
  <!-- header -->
  <?php include_once("header.php");?>
  <br>
  <div class="container bg-faded pt-5">
  <!-- category -->

  <!-- items -->
 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 21px;">
       <!-- info -->
	   <table style="width:50%; margin:auto;table-layout:fixed;border-style: groove;">
					<tr>
						<th style="background-color: gainsboro;">INFORMATION</th>
						<th style="padding-left:20px;background-color: gainsboro;">CONTACT</th>
					</tr>
					<tr>
						<td rowspan="2" style="word-wrap:break-word; overflow-wrap: break-word; padding-top:30px;"><?php echo $client->getClientInfo();?></td>
						<td style="padding-top:30px; padding-left:20px;"><span style="font-style: italic; font-weight:600;">VIA PHONE:</span> <?php echo "(" . substr($client->getClientPhone(),0, 3) . ") " . substr($client->getClientPhone(),3, 3) . "-" . substr($client->getClientPhone(),6, 10);?></td>
					</tr>
					<tr>
						<td style="padding-left:20px; padding-top:25px"><span style="font-style: italic; font-weight:600;">VIA EMAIL:</span> <a href="mailto:<?php echo $client->getClientEmail();?>">Mail to the seller</a></td>
					</tr>
				</table>
      <div>
        <?php
              /*$url = "/data/www/default/wecreu/companyInfo/aboutUs/".$clientId.".txt";
              if (file_exists($url)) {
                $content = file_get_contents($url);
                echo $content;
              }*/
              ?>
			  <!--<table style="margin:auto; width:100%; border-style:solid;" >
				<tr>
					<td>Phone number</td>
					<td>Email</td>
				</tr>
				<tr>
					<td><?php //echo $client->getClientPhone();?></td>
					<td><?php //echo $client->getClientEmail();?></td>
				</tr>
		
				</table>-->
      </div>
    </div>
        </div>
  </div>

  <!-- footer -->
  <?php include_once("footer.php");?>
</body>
</html>

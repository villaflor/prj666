<?php
require_once 'core/init.php';
ini_set('display_errors', 'On');
$user = new User();
$validate = new Validate();
$wait=0;
$wait2=0;
if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}
if(Input::exists()){
    if ($_FILES['client_logo']['size'] == 0)
    {
        $validate->addError('Logo is required');
        //echo "No logo uploaded";
    }
    else{
        $client_name = $user->data()->username;
        $com_title = $user->data()->client_site_title;
		$client_id = $user->data()->client_id;
        $target_dir = '/data/www/default/' . $client_name . '/images';
        $target_file = $target_dir . "/logo.jpg";
		$logoUrl = '../' . $client_name . '/images/logo.jpg';
        $uploadOk = 1;
// Desired folder structure
        $destination = '/data/www/default/' . $client_name;
        $destination2 = '/data/www/default/' . $client_name . '/images';
        $destination3 = '/data/www/default/' . $client_name . '/css';
		$destination4 = '/data/www/default/' . $client_name . '/js';
		$destination5 = '/data/www/default/' . $client_name . '/good';
		$destination6 = '/data/www/default/' . $client_name . '/backup';
        $check=0;
// To create the nested structure, the $recursive parameter
// to mkdir() must be specified.

        if (file_exists($destination)){
            /*echo "directory already existed";*/
            $wait=1;
            rrmdir($destination2);
            rrmdir($destination3);
			if (file_exists($destination4)){
				rrmdir($destination4);
			}
			if(file_exists($destination5)){
				rrmdir($destination5);
			}
            rrmdir($destination);



        }
        if($check == 0){
            if (!file_exists($destination)){
                if (!mkdir($destination, 0770, true)) {
                    die('Failed to create folders...');
                }
            }
            if (!file_exists($destination2)){
                if (!mkdir($destination2, 0770, true)) {
                    die('Failed to create folders...');
                }
            }

            if (!file_exists($destination3)){
                if (!mkdir($destination3, 0770, true)) {
                    die('Failed to create folders...');
                }
            }


        }
        //echo "create";


        if ($check != 1 && $_POST['template'] == 2){
			if (!file_exists($destination5)){
                if (!mkdir($destination5, 0770, true)) {
                    die('Failed to create folders...');
                }
            }
			if (!file_exists($destination6)){
                if (!mkdir($destination6, 0770, true)) {
                    die('Failed to create folders...');
                }
            }
            $source = '/data/www/default/wecreu/includes/templates/blue';
            $source2 = '/data/www/default/wecreu/includes/templates/blue/images';
            $source3 = '/data/www/default/wecreu/includes/templates/blue/css';
			$source4 = '/data/www/default/wecreu/includes/templates/blue/good';
			$source5 = '/data/www/default/wecreu/includes/templates/blue/backup';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
				recurse_copy($source4,$destination5);
				recurse_copy($source5,$destination6);
            }
            /*ob_start();
            include('../prj/template/blue/index.php');
            $forIndex = ob_get_contents();
            ob_end_clean();

            ob_start();
            include('../prj/template/blue/Header.php');
            $forHeader = ob_get_contents();
            ob_end_clean();*/

            //$indexFile = fopen("/data/www/default/" . $client_name . "/index.php", "w") or die("Unable to open file!");
            //$headerFile = fopen("/data/www/default/" . $client_name . "/Header.php", "w") or die("Unable to open file!");
			$config = fopen("/data/www/default/" . $client_name . "/conf.ini", "w") or die ("Unable to open file!");
            /*fwrite($indexFile, $forIndex);
            fclose($indexFile);

            fwrite($headerFile, $forHeader);
            fclose($headerFile);*/

			fwrite($config, $client_id);
			fclose($config);


        }
        else if ($check != 1 && $_POST['template'] == 1){
			if (!file_exists($destination4)){
                if (!mkdir($destination4, 0770, true)) {
                    die('Failed to create folders...');
                }
            }
            $source = '/data/www/default/wecreu/includes/templates/green';
            $source2 = '/data/www/default/wecreu/includes/templates/green/images';
            $source3 = '/data/www/default/wecreu/includes/templates/green/css';
			$source4 = '/data/www/default/wecreu/includes/templates/green/js';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
				recurse_copy($source4,$destination4);
            }
            /*ob_start();
            include('../prj/template/green/index-metadata.php');
            $forIndex = ob_get_contents();
            ob_end_clean();

            ob_start();
            include('../prj/template/green/header-nav.php');
            $forHeader = ob_get_contents();
            ob_end_clean();

            $indexFile = fopen("/data/www/default/". $client_name . "/index-metadata.php", "w") or die("Unable to open file!");
            $headerFile = fopen("/data/www/default/". $client_name ."/header-nav.php", "w") or die("Unable to open file!");*/
			$config = fopen("/data/www/default/" . $client_name . "/conf.ini", "w") or die ("Unable to open file!");
            //fwrite($indexFile, $forIndex);
            //fclose($indexFile);

            //fwrite($headerFile, $forHeader);
            //fclose($headerFile);

			fwrite($config, $client_id);
			fclose($config);

        }
        else if ($check != 1 && $_POST['template'] == 3){

            $source = '/data/www/default/wecreu/includes/templates/red';
            $source2 = '/data/www/default/wecreu/includes/templates/red/images';
            $source3 = '/data/www/default/wecreu/includes/templates/red/css';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
            }
            /*ob_start();
            include('../prj/template/red/headmeta.php');
            $forHeadMeta = ob_get_contents();
            ob_end_clean();

            ob_start();
            include('../prj/template/red/header.php');
            $forHeader = ob_get_contents();
            ob_end_clean();

            $headMetaFile = fopen("/data/www/default/" . $client_name . "/headmeta.php", "w") or die("Unable to open file!");
            $headerFile = fopen("/data/www/default/". $client_name ."/header.php", "w") or die("Unable to open file!");*/
			$config = fopen("/data/www/default/" . $client_name . "/conf.ini", "w") or die ("Unable to open file!");
            //fwrite($headMetaFile, $forHeadMeta);
            //fclose($headMetaFile);

            //fwrite($headerFile, $forHeader);
            //fclose($headerFile);

			fwrite($config, $client_id);
			fclose($config);
            //echo "Done writing";
        }

		else if ($check != 1 && $_POST['template'] == 4){
            $source = '/data/www/default/wecreu/includes/templates/grey';
            $source2 = '/data/www/default/wecreu/includes/templates/grey/images';
            $source3 = '/data/www/default/wecreu/includes/templates/grey/css';
            if($check==0){
                recurse_copy($source,$destination);
                recurse_copy($source2,$destination2);
                recurse_copy($source3,$destination3);
            }
            /*ob_start();
            include('../prj/template/grey/index.php');
            $forIndex = ob_get_contents();
            ob_end_clean();*/



            //$index = fopen("/data/www/default/" . $client_name . "/index.php", "w") or die("Unable to open file!");

			$config = fopen("/data/www/default/" . $client_name . "/conf.ini", "w") or die ("Unable to open file!");
            //fwrite($index, $forIndex);
            //fclose($index);



			fwrite($config, $client_id);
			fclose($config);

        }
		if (file_exists($target_file)){
            unlink($target_file);
        }
        if ($uploadOk == 0){

        }
        else {
            if(move_uploaded_file($_FILES["client_logo"]["tmp_name"], $target_file)){

            }
            else{

            }
        }
		$enableContact = 0;
		if(isset($_POST['contact'])){
			$enableContact = 1;

		}
		$writeContact = fopen("/data/www/default/" . $client_name . "/contact.ini", "w") or die ("Unable to open file!");
		fwrite($writeContact, $enableContact);
		fclose($writeContact);
		$user->update(array('client_logo' => $logoUrl));
		if($wait == 1){
			sleep(60);
			//$wait2 = 1;
	    }
		Session::flash('generate', 'Your site has been generated successfully');
            ?> <script type="text/javascript" language="Javascript">window.open('http://myvmlab.senecacollege.ca:5726/<?php echo $user->data()->username; ?>');</script> <?php
    }
}



function recurse_copy($src,$dst) {
    $dir = opendir($src);
    //@mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    //echo "Copied";
    closedir($dir);
}


function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object);
       }
     }
     rmdir($dir);
   }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Generate Site</title>
	<style>
		#myProgress {
			width: 100%;
			background-color: #ddd;
		}
		#myBar {
			width: 0%;
			height: 30px;
			background-color: #4CAF50;
			text-align: center;
			line-height: 30px;
			color: white;
		}
	</style>
</head>
<body>
<nav class="navbar bg-primary navbar-inverse navbar-toggleable-sm sticky-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#menuContent" aria-controls="menuContent" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuContent">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link active" href="generateTemplate.php">Generate site</a>
                <a class="nav-item nav-link" href="profile.php?user=<?php echo escape($user->data()->username); ?>">Profile</a>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="profileDropdown"
                    >Account</a>

                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="edit-com.php">Update account</a>
                        <a class="dropdown-item" href="changepassword.php">Change password</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="pageDropdown"
                    >Page</a>
                    <div class="dropdown-menu" aria-labelledby="pageDropdown">
                        <a class="dropdown-item" href="editCover.php">Edit cover</a>
                        <a class="dropdown-item" href="editFooter.php">Edit footer</a>
                        <a class="dropdown-item" href="editAboutUs.php">Edit about us</a>
                        <a class="dropdown-item" href="pageList.php">View pages</a>
                        <a class="dropdown-item" href="addPage.php">Create page</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="categoryDropdown"
                    >Category</a>

                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <a class="dropdown-item" href="category.php">View categories</a>
                        <a class="dropdown-item" href="addCategoryForm.php">Create category</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="goodDropdown"
                    >Good</a>

                    <div class="dropdown-menu" aria-labelledby="goodDropdown">
                        <a class="dropdown-item" href="good.php">View goods</a>
                        <a class="dropdown-item" href="create-good.php">Create good</a>
                        <a class="dropdown-item" href="edit-good.php">Edit good</a>
                    </div>
                </div>

                <div class="dropdown">
                    <a class="nav-item nav-link dropdown-toggle" href="#"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       id="saleDropdown"
                    >Sale</a>

                    <div class="dropdown-menu" aria-labelledby="saleDropdown">
                        <a class="dropdown-item" href="sale.php">View sales</a>
                        <a class="dropdown-item" href="onsale.php">Goods on sale</a>
                        <a class="dropdown-item" href="createsale.php">Create Sale</a>
                    </div>
                </div>

                <a class="nav-item nav-link" href="logout.php">Log out</a>
            </div>
        </div>
        <h1 class="navbar-brand mb-0 mr-3">Hello <a class="text-white" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h1>
    </div>
</nav>
<div class="container bg-faded py-5" style="min-height: 100vh" >
    <h2 class="mb-4">Generate template</h2>
    <?php
    if(Session::exists('generate')) {
        echo '<p class="text-success">' . Session::flash('generate') . '</p>';
        echo '<p class="text-info"><a href="http://myvmlab.senecacollege.ca:5726/' .  $user->data()->username . '">Go to your website</a></p>';
    }

    if($validate->errors()) {
        foreach ($validate->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
    <form action="" method="post"  enctype="multipart/form-data" id="frm" name="frm">
        <fieldset class="form-group">
            <legend>Template</legend>
            <div class="form-group col-md-6">
                <label class="form-control-label" for="client_logo"><span class="text-danger">*</span> Choose your company logo: </label>
                <input type="file" name="client_logo" id="client_logo" accept="image/x-png,image/jpeg"/>
            </div>

            <div class="form-check">
                <p style=" margin-left:15px;"><span class="text-danger">*</span> Choose your template:</p>
                <label class="form-check-label" for="green">

                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="green" value="1" checked>
                    Green</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="blue">
                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="blue" value="2">
                    Blue</label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="red">

                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="red"value="3" >
                    Red</label>
            </div>

			<div class="form-check">
                <label class="form-check-label" for="grey">

                    <input class="form-check-input" style=" margin-left:20px;" type="radio" name="template" id="grey" value="4" >
                    Grey</label>
            </div>
			<div class="form-check">
                <p style=" margin-left:15px;"><span class="text-danger">*</span> Do you want to have the "Contact us" page?</p>
                <label class="form-check-label" for="contact">

                    <input class="form-check-input" style=" margin-left:20px;" type="checkbox" name="contact" id="contact" value = "yes">
                    Yes</label>
            </div>

        </fieldset>
        <div>
            <img id="preview" src="images/t-green.png" width="500"/>
        </div>
        <div class="form-group pt-5">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="btn btn-primary" onclick="frm.submit();move();this.disabled = true;" type="submit" value="Submit" id="send"/>
        </div>
    </form>

            <div id="myProgress" style="display:none">
                <div id="myBar">0%</div>
            </div>
                <p id="message" class="text-center" style="display:none; font-size:13px; color:red">Your website is generating. This may take 1 minute.</p>
            <br>
			<div>
				<table style="width:80%; margin:auto; font-size:19px;">
					<tr>
						<td style="width:16%;"><span class="text-danger">***</span> Notes:</td>
						<td>You must prepare your company's logo, otherwise you can't generate your site.</td>
					</tr>
					<tr>
						<td></td>
						<td style="padding-top:15px;">If you site is not fully loaded, refresh it!!!</td>
					</tr>
				</table>
			</div>
<script>

var image = $("#preview");
$("#green").on("click",function(){
    image.attr("src","images/t-green.png");
});
$("#blue").on("click",function(){
    image.attr("src","images/t-blue.png");
});
$("#red").on("click",function(){
    image.attr("src","images/t-red.png");
});
$("#grey").on("click",function(){
    image.attr("src","images/t-grey.png");
});

//move();
function move() {
	$("#send").attr("disabled", true);
    $("#myProgress").show();
    $("#message").show();
	var elem = document.getElementById("myBar");
	var width = 0;
	var id = setInterval(frame, 600);
	function frame() {
		if (width >= 100) {
			clearInterval(id);
		} else {
			width++;
			elem.style.width = width + '%';
			elem.innerHTML = width * 1  + '%';
		}
	}
	//window.alert("Please wait !!!");
}
</script>
<?php //}?>
</div>

<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>

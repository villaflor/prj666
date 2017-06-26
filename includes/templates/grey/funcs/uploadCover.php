<?php
$uploadOk = true;
$target_dir = "../images/";
$target_file = $target_dir . "/cover.jpg";
$uptypes=array(
	'image/jpg',
	'image/jpeg',
	'image/png',
	'image/pjpeg',
	'image/gif',
	'image/bmp',
	'image/x-png'
	);

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	exit;
}

// check if the file is uploaded
if (!is_uploaded_file($_FILES["fileToUpload"]['tmp_name']))
{
	$uploadOk=false;
}

// valida file type
if($uploadOk)
{
	$file = $_FILES["fileToUpload"];
	if(!in_array($file["type"], $uptypes)){
		$uploadOk=false;
	}
}

if($uploadOk){

 	// Check if file already exists
	if (file_exists($target_file)) {
     	// if the cover exists, delete it.
		unlink($target_file);
	}

 	// if everything is ok, try to upload file
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	} else {
		// If upload fail, set the flage to false
		$uploadOk=false;
	}
}

// Display message and redirect to index
if ($uploadOk){
	?>
	<script>
		alert("Your cover has been changed. If you cannot see the change, please clean your browser cache.");
		window.location.assign("../index.php");
	</script>
	<?php
}else{
	?>
	<script>
		alert("Sorry, there is an error. Your cover cannot be changed.");
		window.location.assign("../index.php#upload");
	</script>
	<?php
}

?>
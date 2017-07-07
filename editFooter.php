<?php
require_once 'core/init.php';

$user = new User();
$validate = new Validate();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
    if  (strcmp($_POST['client_admin_email'],$user->data()->client_admin_email) == 0){
      $validation = $validate->check($_POST, array(
            
        'client_information' => array(
          'name' => 'Client information',
          'max' => 256
        )
      ));
    }
    else {
      $validation = $validate->check($_POST, array(
            
        'client_information' => array(
          'name' => 'Client information',
          'max' => 256
        ),
        'client_admin_email' => array(
          'name' => 'Admin email',
          'required' => true,
          'unique' => 'client',
          'max' => 150
        )
      ));
    }
    if($validation->passed()){
            
      try{
        
          $user->update(array(
            'client_information' => Input::get('client_information'),
            'client_tax' => (Input::get('client_tax') ?: 0.0),
            'payment_option_paypal' => (Input::get('paypal') ?: 0),
            'payment_option_visa' => (Input::get('visa') ?: 0),
            'payment_option_mastercard' => (Input::get('master') ?: 0),
            'payment_option_ae' => (Input::get('ae') ?: 0),
            'client_admin_email' => Input::get('client_admin_email')
          ));
        
        
                Session::flash('home', 'Your information have been updated.');
                Redirect::to('index.php');

            } catch (Exception $e){
                die($e->getMessage());
            }
        } else{
      
            foreach ($validation->errors() as $error){
                echo $error, '<br />';
            }
        }
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
    <script type="text/javascript" charset="utf-8" src="tools/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="tools/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="tools/ueditor/lang/en/en.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Wecrue</title>
    <style type="text/css">
        .red {
            color: red;
        }
    </style>

</head>
<body>
<?php
include("narbar.php");
?>
<div class="container bg-faded py-5">
    <h2 class="mb-4">Edit Footer</h2>
    <?php
    if($validate->errors()) {
        foreach ($validation->errors() as $error) {
            echo '<small class="text-warning">' . $error . '</small><br />';
        }
    }
    ?>
 <div>
    <script id="editor" type="text/plain" style="width:1024px;height:500px;">
    <?php 
    $clientId = escape($user->data()->client_id);
    $url = "companyInfo/footer/".$clientId.".txt";
    $content = file_get_contents($url);

    echo $content;
    ?></script>
  </div>
  <div id="btns">
    <div>
      <button onclick="save()">Save</button>
    </div>
  </div>
</div>
<?php include('includes/footer.inc'); ?>

<script src="js/jquery-3.1.1.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script type="text/javascript">
    var ue = UE.getEditor('editor', {
      toolbars: [['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'fullscreen']],
      elementPathEnabled: true,
      enableContextMenu: false,
      wordCount:false,
      emotionLocalization:true,
      imagePopup:false
    });

    function save(){
      var data = ue.getContent();
      $.ajax({  
        url:"tools/ueditor/php/postFooter.php", 
        data:{data:data,clientid:<?php echo $clientId;?>},
        dataType:"text", 
        method:"POST",
        success:function(data){ 
          alert(data);
        },
        error:function(data){
          alert(data);
        }
      });
    }

  </script>
</body>
</html>

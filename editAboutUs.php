<?php
$clientId = 5;
$url = "companyInfo/aboutUs/".$clientId.".txt";
$content = file_get_contents($url);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Edit About us</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <script type="text/javascript" charset="utf-8" src="tools/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="tools/ueditor/ueditor.all.js"> </script>
  <script type="text/javascript" charset="utf-8" src="tools/ueditor/lang/en/en.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
  <div>
    <script id="editor" type="text/plain" style="width:1024px;height:500px;"><?php echo $content;?></script>
  </div>
  <div id="btns">
    <div>
      <button onclick="save()">Save</button>
    </div>
  </div>

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
        url:"tools/ueditor/php/post.php", 
        data:{data:data},
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

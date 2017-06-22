<!-- upload form -->
<form class="form-signin" action="upload.php" method="post" enctype="multipart/form-data">
   <p>
   <div class="input-group">
       <span class="input-group-btn">
           <span class="btn btn-primary btn-file">
               Browse&hellip; <input type="file" name="fileToUpload" id="fileToUpload">
           </span>
       </span>
   </div>
   </p>
   <input type="submit" value="Upload File" name="submit">
</form>
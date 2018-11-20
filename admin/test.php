<!DOCTYPE html>
<html>
   <head>
      <title>HTML file upload</title>
   </head>
   <body>
      <form>
         <input type="file"  action="test.php"  name="name" multiple><br/>
         Upload multiple files, and click Submit.<br>
         <input type = "submit" value = "submit">
      </form>
      <script>
         $(function(){
            $("input[type = 'submit']").click(function(){
               var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 3){
                  alert("You are only allowed to upload a maximum of 3 files");
               }
            });
         });
      </script>
   </body>
</html>
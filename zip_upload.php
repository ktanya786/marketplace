
<?php  
 
if(isset($_POST["btn_zip"]))  
{  
    $output = '';  
    if($_FILES['file']['name'] != '')  
    {  
        $file_name = $_FILES['file']['name'];  
        $array = explode(".", $file_name);  
        $name = $array[0];  
        $ext = $array[1];  
        if($ext == 'zip')  
        {  
            $path = 'upload/';
            $location = $path . $file_name;  
            $path_extract_to =  'upload/extracted/';
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location))  
            {  
                $zip = new ZipArchive;  
                if($zip->open($location))  
                {  
                    $zip->extractTo($path_extract_to);  
                    $zip->close();  
                } 
                $files = scandir($path_extract_to.$name); 
                
                //$name is extract folder from zip file  
                foreach($files as $file)  
                {  
                    if($file!='.' or $file!='..'){
                        
                        if(is_file($path_extract_to . $name.'/'.$file)){
                            // file ext is .template and .meta read from file and display content
                            // or save data in variable
                            echo "in if <br>";
                            echo ($directory);
                            echo "<br>";
                        }else{
                            $directories = scandir($path_extract_to . $name.'/'.$file);;
                            // print_r($directory);
                            //echo  $file_ext = end(explode(".", $file));  
                            echo "<br>";
                            $allowed_ext = array('jpeg', 'template');  
                            //   if(in_array($file_ext, $allowed_ext))  
                            //   {  
                            //        $new_name = md5(rand()).'.' . $file_ext;  
                            //        $output .= '<div class="col-md-6"><div style="padding:16px; border:1px solid #CCC;"><img src="upload/'.$new_name.'" width="170" height="240" /></div></div>';  
                            //        copy($path.$name.'/'.$file, $path . $new_name);  
                            //        unlink($path.$name.'/'.$file);  
                            //   }   
                        }
                    }
                        
                }  
                    //unlink($location);  
                    //rmdir($path . $name);  
            }  
        }  
    }  
}  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
            <title>Webslesson Tutorial | How to Extract a Zip File in Php</title>  
            <link href="style.css" rel="stylesheet" type="text/css">
            <!-- <script src="jquery-3.0.0.js" type="text/javascript"></script> -->
           
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
            <script src="script.js" type="text/javascript"></script>
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">How to Extract a Zip File in Php</h3><br />  
                <form method="post" enctype="multipart/form-data">  
                     <label>Please Select Zip File</label>  
                     <input type="file" name="file" />  
                    <!-- Drag and Drop container-->
                    <div class="upload-area"  id="uploadfile">
                        <h1>Drag and Drop file here<br/>Or<br/>Click to select file</h1>
                    </div>
                     <br />  
                     <input type="submit" name="btn_zip" class="btn btn-info" value="Upload" />  
                </form>  
                <br />  
                <?php  
                if(isset($output))  
                {  
                     echo $output;  
                }  
                ?>  
           </div>  
           <br />  
      </body>  
 </html> 
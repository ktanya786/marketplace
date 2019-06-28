<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
 
$output = ''; 
$time_to_append = time(); 
$return_arr =array("msg"=>"initial", "status"=>0);    
// print_r($_POST);
// die();
if($_FILES['file']['name']!='')  
{  
    $path = "./upload/";
    $file_name = $_FILES['file']['name'];
    $array = explode(".", $file_name);  
    $name = $array[0];  
    $ext = $array[1];   
    if($ext =='templatex' || $ext= 'template'){
        $location = $path . $time_to_append."_".$file_name;
        $path_extract_to =  "./upload/extracted/". $time_to_append."/"; 
        if(move_uploaded_file($_FILES['file']['tmp_name'], $location)) {  
            
                $zip = new ZipArchive;  
                if($zip->open($location))  
                {  
                    $zip->extractTo($path_extract_to);  
                    $zip->close();  
                } 
                if($ext == 'template'){
                    $filepath = $path_extract_to.$name;
                }else{
                    $filepath = $path_extract_to;
                }

                $files = scandir($filepath);
                //print_r($files);
                //$name is extract folder from zip file  

                $dir = new DirectoryIterator($filepath);

                foreach ($dir as $fileinfo) {
                    if (
                        $fileinfo->isFile() 
                        && strpos($fileinfo->getFilename(), '\\') !== false // Checking for a backslash
                    ) {
                        $source = $fileinfo->getPathname();
                        // Get a string with the correct file path
                        $target = str_replace('\\', '/', $source);
                        // Create the directory structure to hold the new file
                        $dir = dirname($target);
                        if (!is_dir($dir)) {
                            mkdir($dir, 0777, true);
                        }
                        // Move the file to the correct path.
                        rename($source, $target);
                    }
                }
                $insertedid='';
                foreach($files as $file)  
                {  
                    if($file!='.' or $file!='..'){
                        
                        if(is_file($filepath.$file)){
                            //echo $filepath.$file;
                            // file ext is .template and .meta read from file and display content
                            // or save data in variable
                            $pos = strpos($file, '.');
                            if($pos){
                                $read_from_meta= array('meta');
                                $f= explode(".", $file);
                                $file_ext = $f[1];
                                if(in_array($file_ext, $read_from_meta)) {
                                    // Get the contents of the JSON file 
                                    $strJsonFileContents = file_get_contents($filepath.$file);
                                    //var_dump($strJsonFileContents); // show contents
                                    // Convert to array 
                                    $tpl_details = json_decode($strJsonFileContents, true);
                                    //print_r($tpl_details['connectors']);
                                    $connectorArray =[];
                                    for ($i=0;$i<count($tpl_details['connectors']);$i++){
                                        $connectorArray[]= $tpl_details['connectors'][$i]['servicename'];
                                    }
                                    $connector = implode(',  ',$connectorArray);
                                    //add template to database
                                   $insert_query ="INSERT INTO tbl_template_new
                                    (`template_name`,
                                    `productname`,
                                    `description`,
                                    `usertags`,
                                    `pagecount`,
                                    `createdby_username`,
                                    `createdby_userid`,
                                    `createdtime`,
                                    `lastmodifiedon`,
                                    `numberofintputs`,
                                    `executionmodel`,
                                    `connectors`,
                                    `category`,
                                    `template_path`,
                                    `extracted_path`) VALUES 
                                    ('".$name."',
                                    '".$tpl_details['productname']."',
                                    '".$tpl_details['description']."',
                                    '".implode(',',$tpl_details['usertags'])."',
                                    '".$tpl_details['pagecount']."',
                                    '".$tpl_details['createdby']['username']."',
                                    '".$tpl_details['createdby']['userid']."',
                                    '".$tpl_details['createdtime']."',
                                    '".$tpl_details['lastmodifiedon']."',
                                    '".$tpl_details['numberofintputs']."',
                                    '".$tpl_details['executionmodel']."',
                                    '".$connector."',
                                    '".$_POST['category']."',
                                    '".$location."',
                                    '".$path_extract_to."')";
                                
                                    $query = mysqli_query($sql,$insert_query);
                                  
                                    $insertedid = mysqli_insert_id($sql);
                                }
                            }
                        }else{
                            $directories = scandir($filepath.'/'.$file);
                           
                            $allowed_ext = array('jpeg', 'template');  
                             
                        }
                    }
                        
                }
            //}



            $_SESSION['currently_added_tpl']= $location;
            $_SESSION['newly_added_tpl_id']= $insertedid;
            //$return_arr = array("msg" => "successfully uploaded",'template_name'=>$name,'path_to_read_file_from'=>$path_extract_to);  
            $return_arr = array("msg" => "successfully uploaded",
                            "template_name"=>$name,
                            "path_to_read_file_from"=>$path_extract_to,
                            "status"=> 1);  
        } else{
            $return_arr = array("msg" => "not uploaded", "status"=> 2);  
        }
    }else{
        $return_arr = array("msg" => "incorrect file formate", "status"=> 3); 
    }
}else{
    $return_arr = array("msg" => "no file found", "status"=> 4);  
} 
echo json_encode($return_arr);die();
?>
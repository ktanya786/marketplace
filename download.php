<?php
error_reporting(0);
include("connect.php");
include("variables.php");
if(isset($_REQUEST["file"])){
	// Get parameters
    //$file = urldecode($_REQUEST["file"]); // Decode URL-encoded string
    
    $get_all_tpl_sql = "SELECT *
                    FROM `tbl_template` 
                    WHERE tpl_id =" . urldecode($_REQUEST["file"]);

    $all_tpl_query = mysqli_query($sql, $get_all_tpl_sql);
    $dataToShowMsg = "";
    
    if ($all_tpl_query->num_rows > 0) {
        $row = mysqli_fetch_assoc($all_tpl_query);
    } else {
        $dataToShowMsg = "No records found";
    }
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";


    $actualFileName =explode("_",$row['template_path']);
    
    $filepath= $row['template_path'];
    // if(in_array($file, $images, true)){
    //     $filepath = "../images/" . $file;
    
       
    $current_count= $row['count'];
    $count=$current_count+1;
    
    // increase the count by 1 and insert into the table
    $updatecount = "UPDATE tbl_template 
                    SET count='".$count."' 
                    WHERE tpl_id='".urldecode($_REQUEST["file"])."'";
    $updatecount_query = mysqli_query($sql, $updatecount);
    

     // Process download
     if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($actualFileName[1].$actualFileName[2]).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        //header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        //echo $count;
        exit;
    }
}
?>
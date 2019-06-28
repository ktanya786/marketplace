<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
include("variables.php");

$search='';
$output='';
if ($_POST['filter_type']=='tool') {
    if (!empty($_POST['searchtoolstr'])) {
        $tool_str = trim($_POST['searchtoolstr']);
        $search= " name LIKE '%$tool_str%' ";
    }

    $serachfilter_query = "SELECT * FROM `tbl_tools` ";
                
    if ($search!='') {
        $serachfilter_query =$serachfilter_query." WHERE". $search;
    }
    $serachfilter_query = $serachfilter_query." ORDER BY name ASC ";         
    // echo $serachfilter_query;
    // echo "<br><br>";
    // die();
    $search_query_result = mysqli_query($sql, $serachfilter_query);

    if ($search_query_result->num_rows <= 0) {
        $output =$noRecordFoundMsg;
    } else {
        while ($row = mysqli_fetch_assoc($search_query_result)) {
            $output.= '<label for="chk_tool_'.$row['tool_id'].'"><input id="chk_tool_'.$row['tool_id'].'" type="checkbox" class="fil_tool_home" value="'.trim($row['name']).'">'.trim($row['name']).'</label>';
        } // end of while
    } // end of else
}else{
    if (!empty($_POST['searchcatstr'])) {
        $cat_str = trim($_POST['searchcatstr']);
        $search= " cat_name LIKE '%$cat_str%' ";
    }

    $serachfilter_query = "SELECT * FROM `tbl_category` ";
                
    if ($search!='') {
        $serachfilter_query =$serachfilter_query." WHERE". $search;
    }
     
    $serachfilter_query = $serachfilter_query." ORDER BY cat_name ASC ";  
    // echo $serachfilter_query;
    // echo "<br><br>";
    // die();
    $search_query_result = mysqli_query($sql, $serachfilter_query);


    
    if ($search_query_result->num_rows <= 0) {
        $output =$noRecordFoundMsg;
    } else {
        while ($row = mysqli_fetch_assoc($search_query_result)) {
            $output.= '<label for="chk_cat_'.$row['cat_id'].'"><input id="chk_cat_'.$row['cat_id'].'" type="checkbox" class="fil_cat_home" value="'.trim($row['cat_name']).'">'.trim($row['cat_name']).'</label>';
        } // end of while
    } // end of else
}
echo $output;
die();


?>
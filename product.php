<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
include("variables.php");
$productFilter = "";
$systemFilter = [];
$sysFilterString ="";
if(!empty($_POST['tool_id'])){
    $productFilter= " connectors LiKE  (".$_POST['tool_id'].") ";
}

$getPro_query = "SELECT * FROM `tbl_template` ";
            if($productFilter!='' && $sysFilterString!=''){
                $getPro_query =$getPro_query." WHERE". $productFilter. "OR ". $sysFilterString;
            }
            if($productFilter!='' && $sysFilterString==''){
                $getPro_query =$getPro_query." WHERE". $productFilter;
            }
            if($productFilter=='' && $sysFilterString!='') {
                
                $getPro_query = $getPro_query." WHERE".$sysFilterString;
            }              
// echo $getPro_query;
// echo "<br><br>";
$getPro_query_result = mysqli_query($sql, $getPro_query);
//die();
$output ='<table cellspacing="0" cellpadding="0" width="100%" border="0">
    <thead>
    <th><input type="checkbox" id="checkAll"></th>
    <th class="temp-name">Template Name</th>
    <th class="updated">Last Updated On</th>
    <th class="systems">Systems</th>
    <th class="dashboard">Pages</th>
    <th class="downloads">Downloads</th>
    <th class="product">Product</th>
        
    </thead>';
$output .='<tbody>';
        if ($getPro_query_result->num_rows <= 0) {
$output .='<tr>
                <td colspan="7">'.$noRecordFoundMsg.'</td> 
            </tr>';
        } else {
        //echo "<pre>";
        while ($row = mysqli_fetch_assoc($getPro_query_result)) {
        
$output .='<tr>
            <td><input type="checkbox" class="tpl_chk" value="'.$row['tpl_id'].'" name="temps[]"></td>
                    <td class="temp-name"><p><a href="edit_templete.php?id='.$row['tpl_id'].'">'.$row['template_name'].'</a></p></td>
                    <td class="updated"><p>'.date('d M Y',strtotime($row['uplaoded_date'])).'</p></td>
                    <td class="systems"><p>'.$row['connectors'].'</p></td>
                    <td class="dashboard"><p>'.$row['pagecount'].'</p></td>
                    <td class="downloads"><p>'.$row['count'].'</p></td>
                    <td class="product"><p>'.$row['productname'].'</p></td>
                </tr>';
           
        } // end of while
    } // end of else 
    
$output .='</tbody>
        </table>';
echo $output;
die();
?>
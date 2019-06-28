<?php

session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
include("variables.php");
//print_R($_POST);

$str = $_POST["searchstr"];
$search_query = "SELECT * FROM `tbl_template`
                WHERE `template_name`  LIKE '%$str%' 
                OR `description` LIKE '%$str%'
                OR `usertags` LIKE '%$str%'";

//echo $search_query;die();
// $search_result = mysqli_query($sql,$search_query);

// $result=[];
// while ($row = mysqli_fetch_assoc($search_result)) {
//     $result[]= $row;
// }

//print_r($result);


// if($_POST['pagename']!='edit_temaplate.php')
//     $output ='<table cellspacing="0" cellpadding="0" width="100%" border="0">
//         <thead>
//             <th><input type="checkbox" id="checkAll"></th>
//             <th>Template Name</th>
//             <th>Created On</th>
//             <th>Uploaded On</th>
//             <th>Systems</th>
//             <th>No. of dashboards</th>
//             <th>Product</th>
//             <th>Edit</th>
//         </thead>';
//     $output .='<tbody>';
//             if ($search_result->num_rows <= 0) {
//     $output .='<tr>
//                     <td colspan="8">'.$noRecordFoundMsg.'</td> 
//                 </tr>';
//             } else {
//             //echo "<pre>";
//             while ($row = mysqli_fetch_assoc($search_result)) {
            
//     $output .='<tr>
//                 <td><input type="checkbox" class="tpl_chk" value="'.$row['tpl_id'].'" name="temps[]"></td>
//                         <td>'.$row['template_name'].'</td>
//                         <td>'.displayDateFromDB($row['createdtime']).'</td>
//                         <td>'.displayDateFromDB($row['uplaoded_date']).'</td>
//                         <td>'.$row['connectors'].'</td>
//                         <td>'.$row['pagecount'].'</td>
//                         <td>'.$row['productname'].'</td>
//                         <td><a href="edit_templete.php?id='.$row['tpl_id'].'"><i class="fas fa-pencil-alt"></i></a></td>
//                     </tr>';
//             } // end of while
//         } // end of else 
        
//     $output .='</tbody>
//             </table>';

//     echo $output;
//     die();
// }else{

// }
//$_SESSION['search_query_result']= $result;
$_SESSION['search_query']= $search_query;
echo 1;

?>
<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
include("variables.php");
$productFilter = "";
$systemFilter = [];
$sysFilterString ="";
if(!empty($_POST['products'])){
    $productFilter= " productname IN (".$_POST['products'].") ";
}

//echo "<pre>";
if(!empty($_POST['systems'])){
    $sysArray = explode(",",$_POST['systems']);
    //print_r($sysArray);
    for($i=0;$i<count($sysArray);$i++){
        $systemFilter[] = " connectors like '%$sysArray[$i]%' ";
    }
        $sysFilterString = implode(" or ", $systemFilter);
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


$output='';
if ($getPro_query_result->num_rows <= 0) {
    $output =$noRecordFoundMsg;
} else {
        //echo "<pre>";
        while ($row = mysqli_fetch_assoc($getPro_query_result)) {
        //print_r($row);
                $extratedPath = $row['extracted_path'];
                $directories = glob($extratedPath . '*', GLOB_ONLYDIR);
                $directory = scandir($directories[0]);
                $images_of_template = array_slice($directory, 2);
                //print_r($images_of_template);
               
                $output .='<div class="template-list-block">
                    <div class="temp-list">
                        <div class="single-carousel owl-carousel">';
                            foreach ($images_of_template as $img) {
                                $output .='<div class="single-item"><img src="'.$root_path . '/' . $directories[0] . '/' . $img.'"></div>';
                            } 
                $output .='</div>';
                $output .='<div class="temp-list-disc">
                                <div class="temp-list-name">
                                    <h2><a href="template-description.php?id='.$row['tpl_id'].'">'.$row['template_name'].'</a></h2>
                                    <span>Uploaded by: '.$row['createdby_userid'].'</span>
                                </div>
                                <div class="temp-list-msg">
                                '.$row['productname'].' template contains '.$row['pagecount'].' dashboards.
                                </div>
                                <div class="temp-list-tags">Tags: '.$row['usertags'].'</div>
                        </div>
                    </div>
                </div>';
               
            } // end of while
            $output .='<script>
            var $owl = $(".single-carousel");
            $owl.trigger("destroy.owl.carousel");
            $owl.html($owl.find(".owl-stage-outer").html()).removeClass("owl-loaded");
            $owl.owlCarousel({
            loop:true,
                            margin:10,
                            responsiveClass:true,
                            items:1,
                            dots: false,
                            nav: true,
            });
            
            </script>';
} // end of else 
    
echo $output;
die();


?>
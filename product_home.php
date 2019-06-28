<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");
include("variables.php");

$console="";

$productFilter = "";
$systemFilter = [];
$sysFilterString ="";

$toolsFilter =[];
$toolFilterString ="";

$catsFilter =[];
$catFilterString ="";


$selectedCats=[];
$selectedCats_q=[];

$selectedCatsHTML='';
$selectedToolsHTML='';

if(!empty($_POST['products'])){
    $productFilter= " productname IN (".$_POST['products'].") ";
}

if(!empty($_POST['systems'])){
    $sysArray = explode(",",$_POST['systems']);
    //print_r($sysArray);
    for($i=0;$i<count($sysArray);$i++){
        $systemFilter[] = " connectors like '%$sysArray[$i]%' ";
    }
        $sysFilterString = implode(" or ", $systemFilter);
}

if(!empty($_POST['tools'])){
    $toolsArray = explode(",",$_POST['tools']);
    //print_r($sysArray);
    for($i=0;$i<count($toolsArray);$i++){
        $toolsFilter[] = " connectors like '%$toolsArray[$i]%' ";
    }
    $toolFilterString = implode(" or ", $toolsFilter);

    // get categories 
    $get_c= "SELECT DISTINCT(cat_id),cat_name from tbl_category 
            INNER JOIN tbl_relation on cat_name=category 
            WHERE". $toolFilterString;
    
    $console= $get_c;
    $console.= "<br><br>";
    $getc_query_result = mysqli_query($sql, $get_c);

    while ($rowc = mysqli_fetch_assoc($getc_query_result)) {
        $selectedCats[]=trim($rowc['cat_name']);
        $selectedCats_q[]=" category LIKE '%".$rowc['cat_name']."%'" ;
        $selectedCatsHTML.= '<label for="chk_cat_'.$rowc['cat_id'].'"><input id="chk_cat_'.$rowc['cat_id'].'" type="checkbox" class="fil_cat_home" value="'.trim($rowc['cat_name']).'" checked>'.trim($rowc['cat_name']).'</label>';
    } // end of while
 
   $cat_string = implode(" or ",$selectedCats_q);
   //$console.=$cat_string;

   for($i=0;$i<count($toolsArray);$i++){
       $toolsFilter[] = " connectors LIKE '%$toolsArray[$i]%' AND (".$cat_string.")";
   }
   $toolFilterString = implode(" or ", $toolsFilter);
}


if(!empty($_POST['cats'])){
    $catsArray = explode(",",$_POST['cats']);
    $catsArray = array_unique($catsArray);
    //print_r($catsArray);
    for($i=0;$i<count($catsArray);$i++){
        //$catsFilter[] = " category LIKE '%".$catsArray[$i]."%' ";
        $catsFilter[] = trim($catsArray[$i]);
    }
    //$catFilterString = implode(" or ", $catsFilter);
    // get tools 
    // $get_t= "SELECT tool_id,name from tbl_tools INNER JOIN tbl_relation on name=connectors WHERE". $catFilterString;
    // $console.= $get_t;
    // $console.= "<br><br>";
    // $gett_query_result = mysqli_query($sql, $get_t);

    // while ($rowt = mysqli_fetch_assoc($gett_query_result)) {

    //     $toolsFilter[] = " connectors like '%".$rowt['name']."%' ";

    //     $selectedToolsHTML.= '<label for="chk_tool_'.$rowt['tool_id'].'"><input id="chk_tool_'.$rowt['tool_id'].'" type="checkbox" class="fil_tool_home" value="'.trim($rowt['name']).'" checked>'.trim($rowt['name']).'</label>';
    // } // end of while

    // $toolFilterString = implode(" or ", $toolsFilter);
}

$console.= implode(",",$selectedCats);
$console.="<br><br>";
// if($_POST['type']=="check"){
//     $cats_to_search = array_merge($selectedCats,$catsFilter);
//     $console.= implode(",",$cats_to_search);
//     $console.="<br><br>";
//     $c_final= array_unique($cats_to_search,SORT_STRING);
//     $console.="<br><br>";
//     $console.= implode(",",$c_final);

//     $console.="<br><br>";
// }else{
//     $cats_to_search = array_merge($selectedCats,$catsFilter);
//     $console.= implode(",",$cats_to_search);
//     $console.="<br><br>";
//     $c_final= array_unique($cats_to_search,SORT_STRING);
//     $console.="<br><br>";
//     $console.= implode(",",$c_final);
//     $console.="<br><br>";
// }






$getPro_query = "SELECT * FROM `tbl_template_new` ";
            if($productFilter!='' && $sysFilterString!=''){
                $getPro_query =$getPro_query." WHERE". $productFilter. "OR ". $sysFilterString;
            }
            if($productFilter!='' && $sysFilterString==''){
                $getPro_query =$getPro_query." WHERE". $productFilter;
            }
            if($productFilter=='' && $sysFilterString!='') {
                
                $getPro_query = $getPro_query." WHERE".$sysFilterString;
            }              

            // for tools and categories
            if($toolFilterString!='' && $catFilterString!=''){
                $getPro_query =$getPro_query." WHERE". $toolFilterString. "OR ". $catFilterString;;
            }
            if($toolFilterString!='' && $catFilterString==''){
                $getPro_query =$getPro_query." WHERE". $toolFilterString;
            }
            // if($toolFilterString=='' && $catFilterString!='') {
                
            //     $getPro_query = $getPro_query." WHERE".$catFilterString;
            // }    

            $console.=$getPro_query;
            $console.="<br><br>";

$getPro_query_result = mysqli_query($sql, $getPro_query);


$output = '';

if ($getPro_query_result->num_rows <= 0) {
    $output =$noRecordFoundMsg;
} else {
        //echo "<pre>";
        while ($row = mysqli_fetch_assoc($getPro_query_result)) {
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
                                '.$row['description'].'
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
    

$response=array(
    "home_html"=>$output,//$output $console
    "selected_categories"=>$selectedCatsHTML,
    "selected_tools"=>""//$selectedToolsHTML
);

echo json_encode($response);

die();


?>
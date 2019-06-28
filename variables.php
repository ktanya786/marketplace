<?php
if($_SERVER['SERVER_NAME']=="localhost"){
    $root_path = "http://localhost/s1";
}else if($_SERVER['SERVER_NAME']=="staging.klera.io"){
    $root_path = "//staging.klera.io/store";
}else{
    $root_path = "https://store.klera.io";
}
$noRecordFoundMsg ="No record found";
function displayDate($dateToPass){
    $d = explode('T',$dateToPass);
    $d_parts = explode('-',$d[0]);
    $dateToShow = $d_parts[1].'-'.$d_parts[2].'-'.$d_parts[0];
    return $dateToShow;
}

function displayDateFromDB($dateToPass){
    $d = explode(' ',$dateToPass);
    //print_r($d);

    $d_parts = explode('-',$d[0]);
    //print_R($d_parts);
    $dateToShow = $d_parts[1].'-'.$d_parts[2].'-'.$d_parts[0];
    return $dateToShow;
}

function flatten_array($input, $output=null) {
    if($input == null) return null;
    if($output == null) $output = array();
    foreach($input as $value) {
        if(is_array($value)) {
            $output = flatten_array($value, $output);
        } else {
            array_push($output, $value);
        }
    }
    return $output;
}
?>
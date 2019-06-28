<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE );
ini_set('display_errors', 1);
include("connect.php");

$user_email = trim(strtolower($_POST['username']));
$password = trim($_POST['password']);

$url = "https://cleartrail.zendesk.com/api/v2/users.json";

$headers = array(
    'Content-Type:application/json; charset=UTF-8',
    'Authorization: Basic '. base64_encode('iwb.agents@clear-trail.com:Ctadmin@123') 
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
$array_data = json_decode($response);

$user_req = array();
for ($i=0; $i<count($array_data->users); $i++) {
    // echo $array_data->users[$i]->email." - ".$array_data->users[$i]->role;
    // echo "<br>";
    if ($array_data->users[$i]->email==$user_email) {
        $user_req= $array_data->users[$i];
    }
}
// echo "<pre>";
// print_r($user_req);

// echo "------------";
// //print_r($array_data->user->name);
// echo "</pre>";
// die();
if($user_req->role=="end-user"){
    $login_url = "https://cleartrail.zendesk.com/api/v2/end_users/".$user_req->id.".json";

}else{
    $login_url = "https://cleartrail.zendesk.com/api/v2/users/".$user_req->id.".json";

}
// check login of user 
$login_headers = array(
    'Content-Type:application/json; charset=UTF-8',
    'Authorization: Basic '. base64_encode($user_email.":".$password) 
    //'Authorization: Basic '. base64_encode('iwb.agents@clear-trail.com:Ctadmin@123') 
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $login_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $login_headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
$array_data = json_decode($response);
// print_r($array_data->user->name);
// echo "</pre>";
// die();
if($array_data->user){
    $_SESSION['user_logged_in']=true;
    $_SESSION['username']=$_POST['username'];
    $_SESSION['name']= $array_data->user->name;
    $_SESSION['role']= $array_data->user->role;
    if (isset($_POST['remember_me'])) {
        if ($_POST['remember_me']==1) {
            $hour = 86400 * 30;// 30 days
            setcookie('username', $_POST['username'], $hour);
            setcookie('password', $_POST['password'], $hour);
        }
    }
    // get the organization
    $org_url = "https://cleartrail.zendesk.com/api/v2/organizations/".$array_data->user->organization_id.".json";

    $org_headers = array(
        'Content-Type:application/json; charset=UTF-8',
        'Authorization: Basic '. base64_encode('iwb.agents@clear-trail.com:Ctadmin@123') 
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $org_url);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $org_headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // Then, after your curl_exec call:
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    $array_data_org = json_decode($response);
    $org =$array_data_org->organization;
    $_SESSION['organization']=$org->name;
    header("Location:home.php");
}else{
    // error 
    
    header("Location:login.php?error=".$array_data->error);
}

die();



?>
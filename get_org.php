<?php

$url = "https://cleartrail.zendesk.com/api/v2/organizations/116500992433.json";

$headers = array(
    'Content-Type:application/json; charset=UTF-8',
    'Authorization: Basic '. base64_encode('iwb.agents@clear-trail.com:Ctadmin@123') 
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// Then, after your curl_exec call:
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
//echo $body;
echo "<pre>";
print_r(json_decode($response));
echo "</pre>";
$array_data = json_decode($response);
$org =$array_data->organization;
echo $org->name;
//echo "31232334434";
die();
?>
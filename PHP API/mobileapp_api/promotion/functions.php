<?php
function convertintotime($datetime){

    $date = new DateTime($datetime);
    $new_date_format = $date->format('Y-m-d h:i A');
    return $new_date_format;

}
/*
 * $data  contains array of all the parameters
 * $endpoint contains endpoint for the curl request
 * $baseurl contains base url of the request api.
 * */
function curl_request($data , $endpoint){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        "api-key: ".API_KEY." "
    ];

    $ch = curl_init($endpoint );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $return = curl_exec($ch);
    $json_data = json_decode($return, true);
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return $json_data;

}

function checkImageExist($external_link)
{
    if (@getimagesize($external_link))
    {
        return 200;
    }
    else
    {
        return 201;
    }
}



function replacedateformate($date){
    $newDate = date("Y-m-d H:i:s", strtotime($date));
    return $newDate;
}

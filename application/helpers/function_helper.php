<?php
// API Helper
function getDataAPI($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HEADER => true,
        CURLOPT_POSTFIELDS => "",
    ));
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $obj = substr($response, $header_size);
    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($obj, true);

    return $data;
}
function postDataAPI($url, $data)
{
    $header = array('Content-Type: application/json', 'Content-Length: ' . strlen($data));
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_POSTFIELDS => $data,
    ));
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $obj = substr($response, $header_size);
    $err = curl_error($curl);

    curl_close($curl);

    $row = json_decode($response);

    $result["row"] = $row;
    $result["response"] = $response;
    return $result;
}

//URL Helper
function userUrl()
{
    return "http://appdev.kmn.kompas.com/gmmsapi/user/";
}

function getToken()
{
    return "btick7";
}

<?php


$phoneNumber = $_POST['phoneNumber'];
$message = $_POST['msg'];
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.mista.io/sms',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('to' => "$phoneNumber", 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => "$message", 'action' => 'send-sms'),
    CURLOPT_HTTPHEADER => array(
        'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
    ),
));
$response = curl_exec($curl);
echo $response;
curl_close($curl);

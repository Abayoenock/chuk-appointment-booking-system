<?php

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
    CURLOPT_POSTFIELDS => array('to' => '+250786135953', 'from' => 'E-Labs SMS', 'unicode' => '0', 'sms' => 'hello abayo enock, Your appointment that you requested with Dr. abayo himbaza on 03-01 -2023 has been successfuly confirmed', 'action' => 'send-sms'),
    CURLOPT_HTTPHEADER => array(
        'x-api-key:216|8zhwGzIooRFTtwTal0jqudqAz6Q6ENf0wpTxhLgD '
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

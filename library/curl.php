<?php
//curl post请求
function post($url,$data) {
    $postBody = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);  //设置超时时间
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody );
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErrNo = curl_errno($ch);
    $curlErr = curl_error($ch);
    curl_close($ch);
    if ($httpCode == "0") {
        // Time out
        throw new Exception("Curl error number:" . $curlErrNo . " , Curl error details:" . $curlErr . "\r\n");
    } else if ($httpCode != "200") {
        // We did send the notifition out and got a non-200 response
        throw new Exception("Http code:" . $httpCode .  " details:" . $result . "\r\n");
    } else {
        return $result;
    }
}
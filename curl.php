<?php

/**
 * 1. Initlization
 * 2. Parameter settings
 * 3. Executions
 * 4. Process result
 */

// 1
$url = "https://img.freepik.com/free-vector/night-ocean-landscape-full-moon-stars-shine_107791-7397.jpg";
$ch = curl_init($url);

// 2
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // to get data in a var
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // verify https
curl_setopt($ch, CURLOPT_PROXY_SSL_VERIFYHOST, 2); // verify https host

// 3
$result = curl_exec($ch);

// 4
$fp = fopen("./sampleimage.png","w");
fwrite($fp, $result);
echo "<img src='./sampleimage.png'/>";

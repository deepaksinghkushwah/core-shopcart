<?php 
include './config.php';
$postdata = $_POST;
$msg = '';
if (isset($postdata ['key'])) {
    $key = 'fcZxr6';
    $salt = 'xBJpv25HH6q8saJOimBllTHPpVj5iHno';
    $txnid = $postdata['txnid'];
    $amount = $postdata['amount'];
    $productInfo = $postdata['productinfo'];
    $firstname = $postdata['firstname'];
    $email = $postdata['email'];
    $udf5 = $postdata['udf5'];
    $mihpayid = $postdata['mihpayid'];
    $status = $postdata['status'];
    $resphash = $postdata['hash'];
    //Calculate response hash to verify	
    $keyString = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '|||||' . $udf5 . '|||||';
    $keyArray = explode("|", $keyString);
    $reverseKeyArray = array_reverse($keyArray);
    $reverseKeyString = implode("|", $reverseKeyArray);
    $CalcHashString = strtolower(hash('sha512', $salt . '|' . $status . '|' . $reverseKeyString));


    if ($status == 'success' && $resphash == $CalcHashString) {
        $_SESSION['msg'] = "Transaction Successful and Hash Verified...";
        //Do success order processing here...
        Order::confirmPaymentStatus($txnid);
    } else {
        //tampered or failed
        $_SESSION['err_msg'] = "Payment failed for Hasn not verified...";
    }
    header('location: '.SITE_WS_PATH.'order-confirm.php?order_id='.$txnid);
    exit;
} else {
    exit(0);
}
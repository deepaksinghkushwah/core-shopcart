<?php include './config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <?php include './template/header.php' ?>
    <?php include './message.php' ?>
    Order payment details
    <?php
    $orderID = $_REQUEST['order_id'];
    $key = 'fcZxr6';
    $salt = 'xBJpv25HH6q8saJOimBllTHPpVj5iHno';
    $mid = 'wIEUUgWk0j';
    $txnId = $orderID;
    $amount = Cart::getCartTotal($_SESSION['user']['id']);
    $productInfo = 'iPhone';
    $firstname = "deepak";
    $lastname = "kushwah";
    $email = 'test@gmail.com';
    $phone = '8233142631';    
    $text = $key.'|'.$txnId.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
    $hash = hash("sha512",$text);
    ?>
    <form action='https://test.payu.in/_payment' method='post' enctype="multipart/form-data">
        <input type="text" name="key" value="<?=$key?>" />
        <input type="text" name="txnid" value="<?=$txnId?>" />
        <input type="text" name="productinfo" value="<?=$productInfo?>" />
        <input type="text" name="amount" value="<?=$amount?>" />
        <input type="text" name="email" value="<?=$email?>" />
        <input type="text" name="firstname" value="<?=$firstname?>" />
        <input type="text" name="lastname" value="<?=$lastname?>" />
        <input type="text" name="surl" value="<?=SITE_WS_PATH.'payment-response.php?order_id='.$txnId?>" />
        <input type="text" name="furl" value="<?=SITE_WS_PATH.'payment-response.php?order_id='.$txnId?>" />
        <input type="text" name="phone" value="<?=$phone?>" />
        <input type="text" name="hash" value="<?=$hash?>" />
        <input type="submit" value="submit">
    </form>
    <?php include './template/footer.php' ?>
</body>

</html>
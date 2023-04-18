<?php include './config.php';
$action = $_GET['action'] ?? null;
switch ($action) {
    case 'deleteAddress':
        Address::deleteAddress($_REQUEST['id']);
        $_SESSION['msg'] = "Address removed";
        header('location: ' . SITE_WS_PATH . 'shipping.php');
        exit;
        break;
    case 'saveShipBillAddress':
        $addressID = $_REQUEST['address'];
        OrderProcess::createOrder($addressID);
        header('location: ' . SITE_WS_PATH . 'payment.php');
        exit;
        break;
}
?>
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

    <!-- fancybox  -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?= SITE_WS_PATH . 'assets/js/fancybox/jquery.fancybox.min.js' ?>"></script>
    <link rel="stylesheet" href="<?= SITE_WS_PATH . 'assets/js/fancybox/jquery.fancybox.min.css' ?>">

</head>

<body>
    <?php include './template/header.php' ?>
    <?php include './message.php' ?>
    <div class="container">
        <h1>Choose Billing/Shipping Address</h1>
        <div class="text-end">
            <a href="<?= SITE_WS_PATH . 'shipping-add.php' ?>" data-fancybox data-type="iframe" class="btn btn-primary btn-sm btnAddShipping">
                Add New Address
            </a>
        </div>
        <!--Listing of addresses -->
        <form method="post" action="<?= SITE_WS_PATH . 'shipping.php?action=saveShipBillAddress' ?>">
            <div class="row row-cols-4 gx-3">
                <?php
                $addresses = Address::getAllAddress($_SESSION['user']['id']);
                if ($addresses) {
                    foreach ($addresses as $item) {
                ?>
                        <div class="col mb-3 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <?= $item['address_line1'] ?>
                                    <div class="float-end">
                                        <input required type="radio" name="address" value="<?= $item['id'] ?>" />
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?= $item['address_line1'] ?>,<br>
                                    <?= $item['address_line2'] ?>,<br>
                                    <?= $item['city'] ?>,
                                    <?= $item['state'] ?>,<br>
                                    <?= $item['country'] ?>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= SITE_WS_PATH . 'shipping.php?action=deleteAddress&id=' . $item['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="row border mb-3 py-3">
                <div class="col">
                    <span class="float-end">
                        <button class="btn btn-primary" type="submit">Proceeed</button>
                    </span>
                </div>

            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.btnAddShipping').fancybox({
                iframe: {
                    css: {
                        width: 800,
                        height: 600
                    }
                },
                afterClose: function() {
                    window.location.reload();
                }
            });
        });
    </script>
    <?php include './template/footer.php' ?>
</body>

</html>
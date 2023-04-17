<?php
include './config.php';
User::isAuthorizedUser();
$action = $_REQUEST['action'] ?? null;
switch ($action) {
    case 'removeFromCart':
        $id = $_REQUEST['id'];
        OrderProcess::removeFromCart($id);
        $_SESSION['msg'] = "Item removed from cart";
        header('location: ' . SITE_WS_PATH . 'cart.php');
        exit;
        break;
    case 'updateCart':
        $id = $_REQUEST['id'];
        $qty = $_REQUEST['qty'];
        OrderProcess::updateCart($id, $qty);
        $_SESSION['msg'] = "Item updated in cart";
        header('location: ' . SITE_WS_PATH . 'cart.php');
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

</head>

<body>
    <?php include './template/header.php' ?>
    <?php include './message.php' ?>

    <div class="container">
        <h1>Your Cart</h1>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = OrderProcess::getCart();
                if (mysqli_num_rows($result) > 0) {
                    $total = 0.00;
                    $gTotal = 0.00;
                    while ($item = mysqli_fetch_assoc($result)) {
                        $product = Product::getProduct($item['product_id']);
                        $total = $item['qty'] * $item['price'];
                        $gTotal += $total;

                ?>
                        <tr>
                            <td><?= $product['title'] ?></td>
                            <td class="text-end"><?= DBO::showAsCurrency($item['price']) ?></td>
                            <td class="text-end">
                                <form method="post" action="<?= SITE_WS_PATH . 'cart.php?action=updateCart&id=' . $item['id'] ?>">
                                    <input type="number" name="qty" id="" value="<?= $item['qty'] ?>">
                                    <button type="submit" class="btn btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-end"><?= DBO::showAsCurrency($total) ?></td>
                            <td>
                                <a title="Remove item from cart" href="<?= SITE_WS_PATH . 'cart.php?action=removeFromCart&id=' . $item['id'] ?>">
                                    <i class="bi bi-trash"></i>

                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">
                        <span>Grand Total</span>
                    </th>
                    <th class="text-end"><?= DBO::showAsCurrency($gTotal) ?></th>
                </tr>
                <tr>
                    <th colspan="5" class="text-end">
                        <a href="<?=SITE_WS_PATH.'shipping.php'?>" class="btn btn-success btn-sm">Proceed To Checkout</a>
                    </th>

                </tr>
            </tfoot>
        </table>
    </div>
    <?php include './template/footer.php' ?>
</body>

</html>
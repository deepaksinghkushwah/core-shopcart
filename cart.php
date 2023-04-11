<?php include './config.php'; User::isAuthorizedUser(); ?>
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
                </tr>
            </thead>
            <tbody>
                <?php
                $dbo =  DBO::getDBO();
                $sql = "SELECT * FROM `cart` WHERE user_id = '" . $_SESSION['user']['id'] . "'";
                $result = mysqli_query($dbo, $sql);
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
                            <td class="text-end"><?= $item['qty'] ?></td>
                            <td class="text-end"><?= DBO::showAsCurrency($total) ?></td>
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
            </tfoot>
        </table>
    </div>
    <?php include './template/footer.php' ?>
</body>

</html>
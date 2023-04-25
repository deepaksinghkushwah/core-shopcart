<?php
include '../config.php';
User::isAuthorizedAdminUser();
$action = $_GET['action'] ?? null;
switch($action){
    case 'updateOrderStatus':
        $orderID = $_REQUEST['order_id'];
        $status = $_REQUEST['order_status'];
        Order::updateOrderStatus($orderID, $status);
        $_SESSION['msg'] = "Order status updated";
        header('location: '.SITE_WS_PATH.'admin/order-history.php');
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

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <?php include './template/header.php' ?>
    <?php include './template/message.php' ?>
    <div class="container">
        <h1>All Orders</h1>
        <div class="accordion" id="accordionFlushExample">
            <?php
            $orders = Order::getAllOrders(0, 'paid');
            if ($orders && count($orders) > 0) {
                $i = 0;
                foreach ($orders as $order) {
            ?>
                    <div class="accordion-item">
                        <!-- according title -->
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $order['id'] ?>" aria-expanded="<?= $i == 0 ? 'true' : 'false'; ?>" aria-controls="collapseOne<?= $order['id'] ?>">
                                Order ID #<?= $order['id'] ?> - <?= strtoupper($order['payment_status']) ?> - <?= strtoupper($order['order_status']) ?>
                            </button>

                        </h2>
                        <!-- accordian content -->
                        <div id="collapseOne<?= $order['id'] ?>" class="accordion-collapse collapse <?= $i == 0 ? 'show' : 'hide'; ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php
                                $orderDetails = OrderDetail::getOrderDetails($order['id']);
                                if ($orderDetails) {
                                ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="25%">Product</th>
                                                <th width="25%">Price</th>
                                                <th width="25%">Qty</th>
                                                <th width="25%">Amt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0.00;
                                            foreach ($orderDetails as $row) {
                                                $total += $row['qty'] * $row['price'];
                                            ?>
                                                <tr>
                                                    <td><?= $row['title'] ?></td>
                                                    <td><?= DBO::showAsCurrency($row['price']) ?></td>
                                                    <td><?= $row['qty'] ?></td>
                                                    <td><?= DBO::showAsCurrency($row['qty'] * $row['price']) ?></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align: right; font-weight: bold" colspan="3">Total</td>
                                                <td style="font-weight: bold"><?= DBO::showAsCurrency($total) ?></td>
                                            </tr>
                                        </tfoot>
                                        </tbody>
                                    </table>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row mb-3 mx-3 text-end">
                                <div class="col-12">
                                    <form method="post" id="orderStatusForm<?=$order['id']?>" action="<?=SITE_WS_PATH.'admin/order-history.php?order_id='.$order['id'].'&action=updateOrderStatus'?>">
                                        <select name="order_status" onchange="javascript:$('#orderStatusForm<?=$order['id']?>').submit();">
                                            <option value="">Update Order Status</option>
                                            <option <?=$order['order_status'] == 'order placed' ? 'selected' : ''?> value="order placed">Order Placed</option>
                                            <option <?=$order['order_status'] == 'in transit' ? 'selected' : ''?> value="in transit">In transit</option>
                                            <option <?=$order['order_status'] == 'completed' ? 'selected' : ''?> value="completed">Completed</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
            <?php
                    $i++;
                }
            }
            ?>
        </div>
    </div>

    <?php include './template/footer.php' ?>
</body>

</html>
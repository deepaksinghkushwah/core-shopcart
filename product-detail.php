<?php
include './config.php';
if (isset($_REQUEST['btnAddToCart'])) {
    $qty = $_REQUEST['qty'];
    $productID = $_REQUEST['product_id'];
    $msg =  OrderProcess::addToCart($productID, $qty);
    $_SESSION['msg'] = $msg;
    header('location: ' . SITE_WS_PATH . 'product-detail.php?id=' . $productID);
    exit;
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
    <div class="container mt-4">
        <?php
        $item = Product::getProduct($_REQUEST['id']);
        ?>
        <h1><?= $item['title'] ?></h1>
        <div class="d-flex justify-content-between">
            <img src="<?= PRODUCT_IMAGES_WS_PATH . $item['image'] ?>" class="rounded" width="800" alt="<?= $item['title'] ?>">
            <div>

                <div class="card" style="width: 30rem">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['title'] ?></h5>
                        <p class="card-text"><?= $item['description'] ?></p>
                        <p class="card-text">$<?= $item['price'] ?></p>

                    </div>
                    <div class="card-footer">
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <div class="row">
                                <div class="col-6"><input type="number" name="qty" class="form-control" min="1" value="1" step="1" /></div>
                                <div class="col-6"><button type="submit" class="btn btn-primary" name="btnAddToCart">Add To Cart</button></div>
                            </div>


                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php $url =  'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>
                        <!-- Facebook -->
                        <a href="http://www.facebook.com/sharer.php?u=<?=$url?>" target="_blank"><i class="bi bi-facebook"></i></a>

                        <!-- Twitter -->
                        <a href="http://twitter.com/share?url=<?=$url?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank"><i class="bi bi-twitter"></i></a>

                        <!-- Google+ -->
                        <a href="https://plus.google.com/share?url=<?=$url?>" target="_blank"><i class="bi bi-google"></i></a>

                        <!-- Digg -->
                        <a href="http://www.digg.com/submit?url=<?=$url?>" target="_blank"><i class="bi bi-digg"></i></a>

                        <!-- Reddit -->
                        <a href="http://reddit.com/submit?url=<?=$url?>&title=Simple Share Buttons" target="_blank"><i class="bi bi-reddit"></i></a>

                        <!-- LinkedIn -->
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$url?>" target="_blank"><i class="bi bi-linkedin"></i></a>

                        

                    </div>
                </div>

            </div>
        </div>


        <?php include './template/footer.php' ?>
</body>

</html>
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
    <div class="container mt-4">
        <?php
        $catID = $_REQUEST['cat_id'];
        $cat = Category::getCategory($catID);
        ?>
        <h1>Category: <?= $cat['title'] ?></h1>
        <div class="row row-cols-4">
            <?php
            $items = Product::getAllProducts($catID);
            if ($items) {
                foreach ($items as $item) {
            ?>
                    <div class="col mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="<?= PRODUCT_IMAGES_WS_PATH . $item['image'] ?>" class="card-img-top" alt="<?= $item['title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item['title'] ?></h5>
                                <p class="card-text"><?= substr($item['description'], 0, 20).'...'; ?></p>
                                <a href="<?=SITE_WS_PATH.'product-detail.php?id='.$item['id']?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include './template/footer.php' ?>
</body>

</html>
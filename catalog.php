<?php include './config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <?php include './template/header.php' ?>
    <?php include './message.php' ?>
    <div class="container mt-4">
        <h1>All Categories</h1>
        <div class="row row-cols-4">
            <?php
            $categories = Category::getAllCategories();
            foreach ($categories as $cat) {
            ?>
                <div class="col mb-4">
                    <div class="card">
                        <img src="<?= PRODUCT_IMAGES_WS_PATH . $cat['image'] ?>" class="card-image" alt="" />
                        <div class="card-body">
                            <div class="card-heading">
                                <strong><?= $cat['title'] ?></strong>
                            </div>
                            <div class="card-text">
                                <?= $cat['description'] ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a class="btn btn-success" href="<?= SITE_WS_PATH . 'products.php?cat_id=' . $cat['id'] ?>">Products</a>
                        </div>
                    </div>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php include './template/footer.php' ?>
</body>

</html>
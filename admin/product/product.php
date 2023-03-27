<?php
include '../../config.php';
User::isAuthorizedAdminUser();
/*$category = new Category;
$category->title = "Books";
$category->description = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, ullam.";
$category->image = $category->uploadImage('image');
$category->create();*/
$action = $_GET['action'] ?? 'list';
switch ($action) {
    case 'deleteProduct':
        if (Product::deleteProduct($_GET['id'])) {
            $_SESSION['msg'] = "Category Deleted";
            header('location: ' . SITE_WS_PATH . 'admin/category/category.php');
            exit;
        }
        break;
    case 'createProduct':
        $obj = new Product;
        $obj->title = $_POST['title'];
        $obj->description = $_POST['description'];
        $obj->catID = $_POST['cat_id'];
        $obj->image = $obj->uploadImage('image');
        //exit($obj->image);
        if ($obj->create()) {
            $_SESSION['msg'] = "Product Created";
            header('location: ' . SITE_WS_PATH . 'admin/product/product.php');
            exit;
        } else {
            $_SESSION['msg'] = "Error at creating product";
        }
        break;
    case 'updateProduct':
        $obj = new Product;
        $obj->title = $_POST['title'];
        $obj->description = $_POST['description'];
        $obj->catID = $_POST['cat_id'];
        $obj->image = $obj->uploadImage('image', true);
        if($obj->updateProduct($_GET['id'])){
            $_SESSION['msg'] = "Product Updated";
            header('location: ' . SITE_WS_PATH . 'admin/product/product.php');
            exit;
        } else {
            $_SESSION['msg'] = "Error at updating product";
        }
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= SITE_WS_PATH . 'admin/assets/css/style.css' ?>">
</head>

<body>
    <?php include '../template/header.php'; ?>
    <div class="container">
        <?php include '../template/message.php'; ?>
        <div class="d-flex justify-content-between align-items-center">
            <h1>Products</h1>
            <a href="<?= SITE_WS_PATH . 'admin/product/product.php?view=create' ?>"
                class="btn btn-primary btn-sm">Create Product</a>
        </div>
        <?php
        $view = $_GET['view'] ?? 'list';
        switch ($view) {
            case 'create':
                include './create.php';
                break;
            case 'edit':
                include './edit.php';
                break;
            case 'list':
            default:
                include './list.php';
                break;
        }
        ?>
    </div>
    <?php include '../template/footer.php'; ?>

</body>

</html>
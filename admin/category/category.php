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
    case 'deleteCategory':
        if (Category::deleteCategory($_GET['id'])) {
            $_SESSION['msg'] = "Category Deleted";
            header('location: ' . SITE_WS_PATH . 'admin/category/category.php');
            exit;
        }
        break;
    case 'createCategory':
        $category = new Category;
        $category->title = $_POST['title'];
        $category->description = $_POST['description'];
        $category->image = $category->uploadImage('image');
        //exit($category->image);
        $errors = $category->validate();
        if(count($errors) <= 0){
            if ($category->create()) {
                $_SESSION['msg'] = "Category Created";
                header('location: ' . SITE_WS_PATH . 'admin/category/category.php');
                exit;
            } else {
                $_SESSION['msg'] = "Error at creating category";
            }
        } else {
            $str = '';
            foreach($errors as $error){
                $str .= $error['msg']."<br>";
            }
            $_SESSION['err_msg'] = $str;
            header('location: ' . SITE_WS_PATH . 'admin/category/category.php?view=create');
            exit;

        }
        
        break;
    case 'updateCategory':
        $category = new Category;
        $category->title = $_POST['title'];
        $category->description = $_POST['description'];
        $category->image = $category->uploadImage('image', true);
        if($category->updateCategory($_GET['id'])){
            $_SESSION['msg'] = "Category Updated";
            header('location: ' . SITE_WS_PATH . 'admin/category/category.php');
            exit;
        } else {
            $_SESSION['msg'] = "Error at updating category";
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
            <h1>Categories</h1>
            <a href="<?= SITE_WS_PATH . 'admin/category/category.php?view=create' ?>"
                class="btn btn-primary btn-sm">Create Category</a>
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
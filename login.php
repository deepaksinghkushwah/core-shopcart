<?php
include './config.php';
$user =  new User();
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User;
    if($user->login($email, $password)){
        if($_SESSION['isAdmin']){
            header('location: '.SITE_WS_PATH.'/admin/index.php');    
        } else {
            header('location: '.SITE_WS_PATH.'/dashboard.php');
        }        
        exit;
    }
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
    <div class="w-25 mx-auto">
        <h1>Login</h1>
        <?php include './message.php' ?>
        <form action="" method="post">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><input class="form-control" type="email" name="email" id="" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="password" name="password" id="" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="btn btn-primary">Login</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php include './template/footer.php' ?>
</body>

</html>
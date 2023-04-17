<?php 
include './config.php'; 
User::isAuthorizedUser();
if(isset($_REQUEST['btnSaveAddress'])){
    
    $obj = new Address;
    $obj->addressLine1 = $_REQUEST['address_line1'];
    $obj->addressLine2 = $_REQUEST['address_line2'];
    $obj->city = $_REQUEST['city'];
    $obj->state = $_REQUEST['state'];
    $obj->country = $_REQUEST['country'];
    $obj->create();
    $_SESSION['msg'] = "Address Saved";
    header('location: '.SITE_WS_PATH.'shipping-add.php');
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
    
    <?php include './message.php' ?>
    <div class="container mt-3">
        <h1>Add New Address</h1>
        <form action="" method="post">
            
            <table class="table table-bordered">
                <tr>
                    <td><input required class="form-control" type="text" name="address_line1" id="" placeholder="Address Line 1"></td>
                </tr>
                <tr>
                    <td><input required class="form-control" type="text" name="address_line2" id="" placeholder="Address Line 2"></td>
                </tr>
                <tr>
                    <td><input required class="form-control" type="text" name="city" id="" placeholder="City"></td>
                </tr>
                <tr>
                    <td><input required class="form-control" type="text" name="state" id="" placeholder="State"></td>
                </tr>
                <tr>
                    <td><input required class="form-control" type="text" name="country" id="" placeholder="Country"></td>
                </tr>
                <tr>
                    <td class="text-end">
                        <button type="submit" name="btnSaveAddress" class="btn btn-primary btn-sm">Save</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['btnSubmit'])){
    //echo"<pre>";print_r($_FILES);echo "</pre>";
    $image = $_FILES['image'];
    $ext = substr($image['name'], strrpos($image['name'],"."));
    $filename = md5(time()).'-'.uniqid().$ext;    
    if($image['type'] == 'image/jpeg'){
        if(move_uploaded_file($image['tmp_name'], dirname(__FILE__).'/'.$filename)){
            echo "File uploaded";
        } else {
            echo "Error at file upload";
        }
    } else {
        echo "invalud fule type;";
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
</head>

<body>
    <div class="container mt-3">
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="title" id="" placeholder="title"></td>
                    </tr>
                    <tr>
                        <td><input type="file" class="form-control" name="image" placeholder="Select your image" id=""></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="btnSubmit" class="btn btn-primary">Save</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>
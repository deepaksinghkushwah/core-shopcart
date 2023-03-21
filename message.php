<?php
if(isset($_SESSION['msg'])){
    ?>
    <div class="alert alert-success">
        <?=$_SESSION['msg']?>
    </div>
    <?php
    unset($_SESSION['msg']);
}

if(isset($_SESSION['err_msg'])){
    ?>
    <div class="alert alert-danger">
        <?=$_SESSION['err_msg']?>
    </div>
    <?php
    unset($_SESSION['err_msg']);
}
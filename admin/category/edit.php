<h5>Edit Category</h5>
<?php
$category = Category::getCategory((int)$_GET['id']);
?>
<form action="<?=SITE_WS_PATH.'admin/category/category.php?action=updateCategory&id='.$_GET['id']?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" class="form-control" name="title" placeholder="Title" value="<?=$category['title']?>"/></td>
        </tr>
        <tr>
            <td><textarea class="form-control" name="description" placeholder="Description"><?=$category['description']?></textarea></td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="file" name="image" placeholder="Image"/>
                <br/>
                <?php
                if(file_exists(PRODUCT_IMAGES_FS_PATH.$category['image'])){
                    ?>
                    <img src="<?=PRODUCT_IMAGES_WS_PATH.$category['image']?>" width="100"/>
                    <?php
                }
                ?>
        </td>
        </tr>
        <tr>
            <td><button class="btn btn-primary">Save</button></td>
        </tr>
        
    </table>
</form>
<h5>Edit Product</h5>
<?php
$item = Product::getProduct((int)$_GET['id']);
?>
<form action="<?= SITE_WS_PATH . 'admin/product/product.php?action=updateProduct&id=' . $_GET['id'] ?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" class="form-control" name="title" placeholder="Title" value="<?= $item['title'] ?>" /></td>
        </tr>
        <tr>
            <td><textarea class="form-control" name="description" placeholder="Description"><?= $item['description'] ?></textarea></td>
        </tr>
        <tr>
            <td><input type="number" min="0" class="form-control" name="price" placeholder="Price" value="<?= $item['price'] ?>" /></td>
        </tr>
        <tr>
            <td>
                <input class="form-control" type="file" name="image" placeholder="Image" />
                <br />
                <?php
                if (file_exists(PRODUCT_IMAGES_FS_PATH . $item['image'])) {
                ?>
                    <img src="<?= PRODUCT_IMAGES_WS_PATH . $item['image'] ?>" width="100" />
                <?php
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <select name="cat_id" class="form-control">
                    <optgroup label="Select Any Category">

                        <?php
                        $categories  = Category::getAllCategories();
                        if ($categories) {
                            foreach ($categories as $cat) {
                        ?>
                                <option <?= $cat['id'] == $item['cat_id'] ? 'selected' : ''; ?> value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </optgroup>
                </select>
            </td>
        </tr>
        <tr>
            <td><button class="btn btn-primary">Save</button></td>
        </tr>

    </table>
</form>
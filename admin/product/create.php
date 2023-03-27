<h5>Create Product</h5>
<form action="<?= SITE_WS_PATH . 'admin/product/product.php?action=createProduct' ?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" class="form-control" name="title" placeholder="Title" /></td>
        </tr>
        <tr>
            <td><textarea class="form-control" name="description" placeholder="Description"></textarea></td>
        </tr>
        <tr>
            <td><input type="number" min="0" class="form-control" name="price" placeholder="Price" /></td>
        </tr>
        <tr>
            <td><input class="form-control" type="file" name="image" placeholder="Image" /></td>
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
                            <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
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
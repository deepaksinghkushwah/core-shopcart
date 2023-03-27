<?php
$items = Product::getAllProducts();
if ($items) {
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($items as $item) {
                ?>
                <tr>
                    <td>
                        <?= $item['id'] ?>
                    </td>
                    <td>
                        <?= $item['title'] ?>
                    </td>
                    <td>
                        <img src="<?=PRODUCT_IMAGES_WS_PATH.$item['image']?>" width="50" class="img-thumbnail"/>
                    </td>
                    <td>
                        <a href='<?=SITE_WS_PATH.'admin/product/product.php?view=edit&id='.$item['id']?>'><i class="bi bi-pencil"></i></a>&nbsp;
                        <a href='<?=SITE_WS_PATH.'admin/product/product.php?action=deleteProduct&id='.$item['id']?>'><i class="bi bi-trash"></i></a>
                    </td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    echo "No products found";
}
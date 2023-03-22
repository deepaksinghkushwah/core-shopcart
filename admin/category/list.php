<?php
$categories = Category::getAllCategories();
if ($categories) {
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
            foreach ($categories as $cat) {
                ?>
                <tr>
                    <td>
                        <?= $cat['id'] ?>
                    </td>
                    <td>
                        <?= $cat['title'] ?>
                    </td>
                    <td>
                        <img src="<?=PRODUCT_IMAGES_WS_PATH.$cat['image']?>" width="50" class="img-thumbnail"/>
                    </td>
                    <td>
                        <a href='<?=SITE_WS_PATH.'admin/category/category.php?view=edit&id='.$cat['id']?>'><i class="bi bi-pencil"></i></a>&nbsp;
                        <a href='<?=SITE_WS_PATH.'admin/category/category.php?action=deleteCategory&id='.$cat['id']?>'><i class="bi bi-trash"></i></a>
                    </td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
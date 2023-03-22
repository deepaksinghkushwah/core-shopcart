<h5>Create Category</h5>
<form action="<?=SITE_WS_PATH.'admin/category/category.php?action=createCategory'?>" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><input type="text" class="form-control" name="title" placeholder="Title"/></td>
        </tr>
        <tr>
            <td><textarea class="form-control" name="description" placeholder="Description"></textarea></td>
        </tr>
        <tr>
            <td><input class="form-control" type="file" name="image" placeholder="Image"/></td>
        </tr>
        <tr>
            <td><button class="btn btn-primary">Save</button></td>
        </tr>
        
    </table>
</form>
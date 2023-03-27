<?php
class Product
{
    public $dbo;
    public $title;
    public $image;
    public $description;
    public $catID;
    public $status;

    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }

    /**
     * Create new category
     *
     * @return boolean
     */
    public function create(): bool
    {
        $sql = "INSERT INTO `products` SET `title` = '$this->title', `image` = '$this->image', `description` = '$this->description', `cat_id` = '$this->catID'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Upload category image, return image name once file uploaded
     *
     * @return string
     */
    public function uploadImage($imageFieldName, $editCase = false): string
    {
        // check if image is uploading
        if (isset($_FILES[$imageFieldName]) && $_FILES[$imageFieldName]['name']!='') {
            $ext = substr($_FILES[$imageFieldName]['name'], strrpos($_FILES[$imageFieldName]['name'], '.'));            
            $newFileName = md5(time()) . uniqid() . $ext;
            //exit($_FILES[$imageFieldName]['tmp_name']);
            if (move_uploaded_file($_FILES[$imageFieldName]['tmp_name'], PRODUCT_IMAGES_FS_PATH . $newFileName)) {
                return $newFileName;
            } else {
                return 'noimg.png';
            }
        } else {
            // image not uploaded
            if($editCase == true){ // if edit category submitted and image is not uploaded
                $product = self::getProduct($_GET['id']);
                return $product['image'];
            } else { // create case
                return 'noimg.png';
            }
            
        }

    }

    /**
     * Return categories array
     *
     * @return array
     */
    public static function getAllProducts(int $catID = 0): array
    {
        $products = [];
        $sql = "SELECT * FROM `products`";
        if($catID != 0){
            $sql .= " WHERE cat_id = $catID ";
        }
        $sql .= "  order by id DESC ";
        $results = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $products[] = $row;
            }
        }
        return $products;
    }

    

    /**
     * Return single category
     *
     * @param integer $id
     * @return array|bool
     */
    public static function getProduct(int $id): array|bool
    {
        $category = [];
        $sql = "SELECT * FROM `products` WHERE id = $id";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }

    /**
     * Delete category
     *
     * @param integer $id
     * @return boolean
     */
    public static function deleteProduct(int $id): bool
    {
        $sql = "DELETE FROM `products` WHERE id = $id";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }

    public function updateProduct(int $id){
        $sql = "UPDATE `products` SET `title` = '$this->title', `image` = '$this->image', `description` = '$this->description', cat_id = '$this->catID' WHERE `id` = '$id'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
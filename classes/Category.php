<?php
class Category
{
    public $dbo;
    public $title;
    public $image;
    public $description;
    public $parentID;
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
        $sql = "INSERT INTO `categories` SET `title` = '$this->title', `image` = '$this->image', `description` = '$this->description'";
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
    public function uploadImage($imageFieldName): string
    {
        if (isset($_FILES[$imageFieldName])) {
            $ext = substr($_FILES[$imageFieldName]['name'], strrpos($_FILES[$imageFieldName]['name'], '.'));            
            $newFileName = md5(time()) . uniqid() . $ext;
            //exit($_FILES[$imageFieldName]['tmp_name']);
            if (move_uploaded_file($_FILES[$imageFieldName]['tmp_name'], PRODUCT_IMAGES_FS_PATH . $newFileName)) {
                return $newFileName;
            } else {
                return 'noimg.png';
            }
        } else {
            return 'noimg.png';
        }

    }

    /**
     * Return categories array
     *
     * @return array
     */
    public static function getAllCategories(): array
    {
        $categories = [];
        $sql = "SELECT * FROM `categories`";
        $results = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    /**
     * Return single category
     *
     * @param integer $id
     * @return array|bool
     */
    public static function getCategory(int $id): array|bool
    {
        $category = [];
        $sql = "SELECT * FROM `categories` WHERE id = $id";
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
    public static function deleteCategory(int $id): bool
    {
        $sql = "DELETE FROM `categories` WHERE id = $id";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }
}
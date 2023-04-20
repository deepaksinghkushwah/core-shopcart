<?php
class Cart
{
    public $id;
    public $userID;
    public $sessionID;
    public $productID;
    public $price;
    public $qty;
    public $createdAt;
    public $dbo;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }

    /**
     * Return cart for an user
     *
     * @param integer $id
     * @return array|bool
     */
    public static function getCart(int $userID): array
    {
        $items = [];
        $sql = "SELECT * FROM `cart` WHERE `user_id` = $userID";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            while($data = mysqli_fetch_assoc($result)){
                $items[] = $data;
            }
        }
        return $items;
    }

    public static function emptyCart(int $userID){
        $sql = "DELETE FROM `cart` WHERE `user_id` = $userID";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }

    public static function getCartTotal($userID){
        $sql = "SELECT SUM(qty * price) total FROM `cart` WHERE user_id = '$userID'";
        $result = mysqli_query(DBO::getDBO(), $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    }
}

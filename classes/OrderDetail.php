<?php
class OrderDetail
{
    public $dbo;
    public $orderID;
    public $productID;
    public $title;
    public $price;
    public $qty;
    

    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }
    

    /**
     * Create new order
     *
     * @return boolean
     */
    public function create(): bool
    {
        $sql = "INSERT INTO `order_details` SET `order_id` = '$this->orderID', `title` = '$this->title', `price` = '$this->price', `qty` = '$this->qty', `product_id` = '$this->productID'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }

    }

    

    /**
     * Return orders array
     *
     * @return array
     */
    public static function getOrderDetails(int $orderID): array
    {
        $items = [];
        $sql = "SELECT * FROM `order_details` WHERE `order_id` = '$orderID' order by id DESC";
        $results = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $items[] = $row;
            }
        }
        return $items;
    }

    
}
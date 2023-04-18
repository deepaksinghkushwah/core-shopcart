<?php
class Order
{
    public $dbo;
    public $userID;
    public $addressID;
    public $amount;
    public $createdAt;
    public $paymentStatus;
    public $orderStatus;

    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }
    

    /**
     * Create new order
     *
     * @return boolean
     */
    public function create(): int|bool
    {
        $sql = "INSERT INTO `orders` SET `user_id` = '$this->userID', `amount` = '$this->amount', created_at = '$this->createdAt', `payment_status` = '$this->paymentStatus', `order_status` = '$this->orderStatus',`address_id` = '$this->addressID'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return mysqli_insert_id($this->dbo);
        } else {
            return false;
        }

    }

    

    /**
     * Return orders array
     *
     * @return array
     */
    public static function getAllOrders(): array
    {
        $items = [];
        $sql = "SELECT * FROM `orders` order by id DESC";
        $results = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $items[] = $row;
            }
        }
        return $items;
    }

    /**
     * Return single order
     *
     * @param integer $id
     * @return array|bool
     */
    public static function getOrder(int $id): array|bool
    {        
        $sql = "SELECT * FROM `orders` WHERE id = $id";
        $result = mysqli_query(DBO::getDBO(), $sql);
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
    }
}
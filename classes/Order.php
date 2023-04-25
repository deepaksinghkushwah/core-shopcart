<?php
class Order
{
    public $dbo;
    public $id;
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
     * Create new order
     *
     * @return boolean
     */
    public static function confirmPaymentStatus(int $id): int|bool
    {
        $dbo = DBO::getDBO();
        mysqli_query($dbo, "UPDATE `orders` SET `payment_status` = 'paid', `order_status` = 'order placed' WHERE `id` = '$id'");
        Cart::emptyCart($_SESSION['user']['id']); // empty cart
        return true;
    }



    /**
     * Return orders array
     *
     * @return array
     */
    public static function getAllOrders(int $userID = 0, string $paymentStatus = 'all'): array
    {
        $items = [];
        $sql = "SELECT * FROM `orders` WHERE id > 0 ";
        if ($paymentStatus != 'all') {
            $sql .= " AND  payment_status = '$paymentStatus' ";
        }
        if ($userID != 0) {
            $sql .= " AND `user_id` = '$userID' ";
        }

        $sql .= " order by id DESC ";


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

    public static function updateOrderStatus(int $orderID, string $status)
    {
        $dbo = DBO::getDBO();
        $order = self::getOrder($orderID);
        $user = User::getUserByID($order['user_id']);
        if ($status != '') {
            $sql = "UPDATE `orders` SET order_status = '$status' WHERE id = '$orderID'";
            mysqli_query($dbo, $sql);
            $to = $user['email'];
            $subject = "Order status upadted: #" . $order['id'];
            $message = "Your order status has been updated to " . ucfirst($status) . '. Please contact administrator if you have any issue regarding this order';
            Mailer::sendEmail($to, $subject, $message);
        }
        return true;
    }
}

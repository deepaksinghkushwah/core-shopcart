<?php
class OrderProcess
{
    /**
     * Add item to cart
     *
     * @param integer $productID
     * @param integer $qty
     * @return string
     */
    public static function addToCart(int $productID, int $qty): string
    {
        $dbo = DBO::getDBO();
        $msg = '';
        $product = Product::getProduct($productID);
        $userID = $_SESSION['user']['id'] ?? 0;
        $sessionID = session_id();
        $sql = "SELECT * FROM `cart` WHERE product_id = '$productID' AND session_id = '$sessionID'";
        $result = mysqli_query($dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            // product exists in cart table, increase qty of added product
            $sql = "UPDATE `cart` SET `qty` = `qty` + $qty WHERE  product_id = '$productID' AND `session_id` = '$sessionID'";
            $msg = 'Product quantity updated in cart';
        } else {
            // product not exists in cart table, add product to cart tabe
            $sql = "INSERT INTO `cart` SET `product_id` = '$productID', `session_id` = '$sessionID', `user_id` = '$userID', `price` = '" . $product['price'] . "', `qty` = '$qty', `created_at` = '" . date('Y-m-d H:i') . "'";
            $msg = 'Product added into cart';
        }

        mysqli_query($dbo, $sql);
        return $msg;
    }

    public static function removeFromCart(int $id): bool
    {
        $dbo = DBO::getDBO();
        $sql = "DELETE FROM `cart` WHERE id = '$id'";
        mysqli_query($dbo, $sql);
        return true;
    }

    public static function updateCart(int $id, int $qty): bool
    {
        $dbo = DBO::getDBO();
        $sql = "UPDATE `cart` SET `qty` = '$qty' WHERE `id` = '$id'";
        mysqli_query($dbo, $sql);
        return true;
    }

    public static function getCart()
    {
        $dbo =  DBO::getDBO();
        $sql = "SELECT * FROM `cart` WHERE user_id = '" . $_SESSION['user']['id'] . "'";
        $result = mysqli_query($dbo, $sql);
        return $result;
    }

    public static function createOrder(int $addressID)
    {
        $dbo = DBO::getDBO();
        $orderID = 0;
        // order id exists or not
        $result = mysqli_query($dbo, "SELECT * FROM `orders` WHERE `user_id` = '" . $_SESSION['user']['id'] . "' AND order_status = 'in progress' ORDER BY `id` DESC");
        if (mysqli_num_rows($result) > 0) {
            // if order exists, update order amt so if user added new products, it will update total order amt
            $row = mysqli_fetch_assoc($result);
            $orderID = $row['id'];
            $order = Order::getOrder($orderID);
            mysqli_query($dbo, "UPDATE `order` SET `amount` = '".Cart::getCartTotal($_SESSION['user']['id'])."' WHERE `user_id` = '".$_SESSION['user']['id']."'");
        } else {            
            // else crate new order id with all details
            $order = new Order;
            $order->amount = Cart::getCartTotal($_SESSION['user']['id']);
            $order->userID =  $_SESSION['user']['id'];
            $order->createdAt = date('Y-m-d');
            $order->paymentStatus = 'unpaid';
            $order->orderStatus = 'in progress';
            $order->addressID = $addressID;
            $orderID = $order->create();            
        }

        // prepare migrate data from cart to order_detail table
        $cartProductsResult = mysqli_query($dbo, "SELECT * FROM `cart` WHERE user_id = '" . $_SESSION['user']['id'] . "'");

        if (mysqli_num_rows($cartProductsResult) > 0) {
            while ($cartProduct = mysqli_fetch_assoc($cartProductsResult)) {
                // check if product exists in order details table
                $productExists = mysqli_query($dbo, "SELECT * FROM `order_details` WHERE `order_id` = '$orderID' AND `product_id` = '" . $cartProduct['product_id'] . "'");
                // if exists, avoid it
                if (mysqli_num_rows($productExists) > 0) {
                    // update order details table product qty as per cart table
                    $sql = "UPDATE order_details SET qty = '".$cartProduct['qty']."' WHERE product_id = '".$cartProduct['product_id']."' AND `order_id` = '$orderID'";
                    mysqli_query($dbo, $sql);
                } else {
                    // else insert it in order details table
                    $product = Product::getProduct($cartProduct['product_id']);
                    $orderDetail = new OrderDetail;
                    $orderDetail->orderID = $orderID;
                    $orderDetail->productID = $cartProduct['product_id'];
                    $orderDetail->title = $product['title'];
                    $orderDetail->price = $cartProduct['price'];
                    $orderDetail->qty = $cartProduct['qty'];
                    $orderDetail->create();
                }
            }
        }
        return $orderID;
    }
    
}

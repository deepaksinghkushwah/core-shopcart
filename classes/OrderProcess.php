<?php
class OrderProcess {
    /**
     * Add item to cart
     *
     * @param integer $productID
     * @param integer $qty
     * @return string
     */
    public static function addToCart(int $productID, int $qty) : string{
        $dbo = DBO::getDBO();
        $msg = '';        
        $product = Product::getProduct($productID);
        $userID = $_SESSION['user']['id'] ?? 0;
        $sessionID = session_id();
        $sql = "SELECT * FROM `cart` WHERE product_id = '$productID' AND session_id = '$sessionID'";
        $result = mysqli_query($dbo, $sql);
        if(mysqli_num_rows($result) > 0){
            // product exists in cart table, increase qty of added product
            $sql = "UPDATE `cart` SET `qty` = `qty` + $qty WHERE  product_id = '$productID' AND `session_id` = '$sessionID'";
            $msg = 'Product quantity updated in cart';
        } else {
            // product not exists in cart table, add product to cart tabe
            $sql = "INSERT INTO `cart` SET `product_id` = '$productID', `session_id` = '$sessionID', `user_id` = '$userID', `price` = '".$product['price']."', `qty` = '$qty', `created_at` = '".date('Y-m-d H:i')."'";
            $msg = 'Product added into cart';
        }

        mysqli_query($dbo, $sql);
        return $msg;
    }

    public static function removeFromCart(int $id) : bool {
        $dbo = DBO::getDBO();
        $sql = "DELETE FROM `cart` WHERE id = '$id'";
        mysqli_query($dbo, $sql);
        return true;
    }

    public static function updateCart(int $id, int $qty) : bool {
        $dbo = DBO::getDBO();
        $sql = "UPDATE `cart` SET `qty` = '$qty' WHERE `id` = '$id'";
        mysqli_query($dbo, $sql);        
        return true;
    }

    public static function getCart(){
        $dbo =  DBO::getDBO();
        $sql = "SELECT * FROM `cart` WHERE user_id = '" . $_SESSION['user']['id'] . "'";
        $result = mysqli_query($dbo, $sql);
        return $result;
    }

    
}
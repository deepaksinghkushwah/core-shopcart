<?php
abstract class DBO
{
    private static $conn;
    public static function getDBO()
    {
        if (!isset(self::$conn)) {
            self::$conn = mysqli_connect('localhost', 'root', '', 'core_shopcart');
        }
        return self::$conn;
    }
    public static function showAsCurrency(float $amount){
        return '&#8377;'.$amount;
    }
}

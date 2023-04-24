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
        return '&#8377;'.number_format($amount,2);
        //$fmt = numfmt_create( 'in', NumberFormatter::CURRENCY );
        //return numfmt_format_currency($fmt, $amount, "INR")."\n";
    }
}

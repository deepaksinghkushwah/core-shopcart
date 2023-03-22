<?php
session_start();
define('SITE_FS_PATH',dirname(__FILE__).'/');
define('SITE_WS_PATH','http://core-shopcart.local/');

define('PRODUCT_IMAGES_WS_PATH',SITE_WS_PATH.'assets/images/product-images/');
define('PRODUCT_IMAGES_FS_PATH',SITE_FS_PATH.'assets/images/product-images/');

spl_autoload_register(function ($class) {
    include SITE_FS_PATH.'/classes/' . $class . '.php';
});
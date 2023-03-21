<?php
session_start();
define('SITE_FS_PATH',dirname(__FILE__));
define('SITE_WS_PATH','http://core-shopcart.local');
spl_autoload_register(function ($class) {
    include SITE_FS_PATH.'/classes/' . $class . '.php';
});
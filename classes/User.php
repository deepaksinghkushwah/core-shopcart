<?php
class User
{
    public $dbo;
    public function __construct()
    {
        $this->dbo = DBO::getDBO(); // get database object
    }
    public function login($email, $password)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['password'] == md5($password)) {
                unset($user['password']);
                $_SESSION['user'] = $user;
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['msg'] = "User logged in";
                if ((int)$user['role_id'] === 1) {
                    $_SESSION['isAdmin'] = true;
                }
                $sql = "UPDATE `cart` SET user_id = '".$user['id']."' WHERE `session_id` = '".session_id()."'";
                mysqli_query($this->dbo, $sql);
                return true;
            } else {
                $_SESSION['err_msg'] = "Password not matched";
                return false;
            }
        } else {
            $_SESSION['err_msg'] = "User not found";
            return false;
        }
    }

    public function register($email, $password, $fullname, $roleID = 2)
    {
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['err_msg'] = "User already registered, please choose another email";
            return false;
        } else {
            $pass = md5($password);
            $sql = "INSERT INTO `users` SET `email` = '$email', `password` = '$pass', `fullname` = '$fullname', `role_id` = '$roleID'";
            mysqli_query($this->dbo, $sql);
            $_SESSION['msg'] = "User registered successfully";
            return true;
        }
    }

    public static function isAuthorizedUser()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            return true;
        } else {
            header('location: ' . SITE_WS_PATH . '/login.php');
            exit;
        }
    }

    public static function checkLogin()
    {
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function isAuthorizedAdminUser()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            return true;
        } else {
            $_SESSION['err_msg'] = "You are not authorized to perform this action";
            header('location: ' . SITE_WS_PATH . '/login.php');
            exit;
        }
    }

    public static function checkAdminLogin()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
            return true;
        } else {
            return false;
        }
    }
}

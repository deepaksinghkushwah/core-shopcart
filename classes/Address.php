<?php
class Address
{
    public $addressLine1;
    public $addressLine2;
    public $city;
    public $state;
    public $country;
    public $status;
    public $dbo;
    public function __construct()
    {
        $this->dbo = DBO::getDBO();
    }

    public function create()
    {
        $sql = "INSERT INTO `addresses` 
        SET 
        `address_line1` = '$this->addressLine1',
        `address_line2` = '$this->addressLine2',
        `city` = '$this->city',
        `state` = '$this->state',
        `country` = '$this->country',
        `user_id` = '" . $_SESSION['user']['id'] . "'";

        $result = mysqli_query($this->dbo, $sql);
        if (mysqli_affected_rows($this->dbo) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllAddress(int $userID){
        
            $returnArr = [];
            $sql = "SELECT * FROM `addresses` WHERE `user_id` = '$userID' AND `status` = 1 order by id DESC";
            $results = mysqli_query(DBO::getDBO(), $sql);
            if (mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $returnArr[] = $row;
                }
            }
            return $returnArr;
        
    }

    public static function deleteAddress(int $id): bool
    {
        $sql = "UPDATE `addresses` SET `status` = 0 WHERE id = $id and `user_id` = '".$_SESSION['user']['id']."'";
        mysqli_query(DBO::getDBO(), $sql);
        return true;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ShippingModel extends Model
{
    protected $table      = 'user_shipping_address';
    protected $primaryKey = 'ShippingAddressID';

    public function CreateNewShippingAddress($UserID, $data)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $uuid = Uuid::uuid4()->getBytes();
        $firstName = $data['first-name'];
        $lastName = $data['last-name'];
        $email = $data['email'];
        $phoneNumber = $data['phone-number'];
        $province = $data['province'];
        $city = $data['city'];
        $subdistrict = $data['subdistrict'];
        $ward = $data['ward'];
        $street = $data['street'];
        $query = $this->db->query("INSERT INTO `user_shipping_address`(`ShippingAddressID`, `UserID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Province`, `City`, `Subdistrict`, `Ward`, `Street`, `CreatedAt`, `UpdatedAt`) VALUES ('$uuid','$UserID','$firstName','$lastName','$email','$phoneNumber','$province','$city','$subdistrict','$ward','$street','$now','$now');");
        return $query;
    }

    public function GetShippingAddress($UserID)
    {
        $query = $this->db->query("SELECT * FROM `user_shipping_address` WHERE `UserID`='$UserID';")->getResultArray();
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ShippingAddressID'] = Uuid::fromBytes($value['ShippingAddressID'])->toString();
            $query[$i]['UserID'] = Uuid::fromBytes($value['UserID'])->toString();
            $i++;
        }
        return $query;
    }

    public function GetShippingAddressData($ShippingAddressID)
    {
        $ShippingAddressID = Uuid::fromString($ShippingAddressID)->getBytes();
        $query = $this->db->query("SELECT * FROM `user_shipping_address` WHERE `ShippingAddressID`='$ShippingAddressID';")->getRowArray();
        $query['ShippingAddressID'] = Uuid::fromBytes($query['ShippingAddressID'])->toString();
        $query['UserID'] = Uuid::fromBytes($query['UserID'])->toString();
        return $query;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class OrderModel extends Model
{
    protected $table      = 'user_order';
    protected $primaryKey = 'UserOrderID';

    public function CreateOrder($userId, $cartId, $shippingAddressId, $namaFile)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $uuid = Uuid::uuid4()->getBytes();
        $cartId = Uuid::fromString($cartId)->getBytes();
        $shippingAddressId = Uuid::fromString($shippingAddressId)->getBytes();
        $query = $this->db->query("INSERT INTO `user_order`(`UserOrderID`, `UserID`, `CartID`, `ShippingAddressID`, `PaymentEvident`,`OrderStatus`,`CreatedAt`,`UpdatedAt`) VALUES ('$uuid','$userId','$cartId','$shippingAddressId','$namaFile',0,'$now','$now');");
        return $query;
    }

    public function GetAllOrder()
    {
        $query = $this->db->query("SELECT `t1`.*, `t2`.`Email` FROM `user_order` AS `t1` JOIN `users` AS `t2` ON `t2`.`UserID`=`t1`.`UserID`")->getResultArray();
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['UserOrderID'] = Uuid::fromBytes($value['UserOrderID'])->toString();
            $i++;
        }
        return $query;
    }

    public function GetOrderById($orderId)
    {
        $orderId = Uuid::fromString($orderId)->getBytes();
        $query = $this->db->query("SELECT `t1`.*, `t2`.`Email`,`t2`.`Username`, `t3`.* FROM `user_order` AS `t1` JOIN `users` AS `t2` ON `t2`.`UserID`=`t1`.`UserID` JOIN `user_shipping_address` AS `t3` ON `t3`.`ShippingAddressID` = `t1`.`ShippingAddressID` WHERE `t1`.`UserOrderID`='$orderId'")->getRowArray();
        $query['UserOrderID'] = Uuid::fromBytes($query['UserOrderID'])->toString();
        return $query;
    }

    public function CountTotalOrderByStatusOrder($status)
    {
        $query = $this->db->query("SELECT COUNT(UserOrderId) AS OrderStatus FROM user_order WHERE OrderStatus='$status';")->getRowArray();
        return $query;
    }

    public function UpdateOrderStatus($status, $orderId)
    {
        $orderId = Uuid::fromString($orderId)->getBytes();
        $query = $this->db->query("UPDATE user_order SET OrderStatus='$status' WHERE UserOrderID='$orderId';");
        return $query;
    }
}

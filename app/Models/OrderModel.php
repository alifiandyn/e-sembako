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
        $query = $this->db->query("INSERT INTO `user_order`(`UserOrderID`, `UserID`, `CartID`, `ShippingAddressID`, `PaymentEvident`,`PaymentStatus`,`CreatedAt`,`UpdatedAt`) VALUES ('$uuid','$userId','$cartId','$shippingAddressId','$namaFile',0,'$now','$now');");
        return $query;
    }
}

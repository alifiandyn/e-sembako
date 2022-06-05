<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class CartModel extends Model
{
    protected $table      = 'user_cart';
    protected $primaryKey = 'CartID';

    public function CheckUsedCart($UserID)
    {
        $query = $this->db->query("SELECT `CartID`, `UserID`, `CartStatus`, `CreatedAt`, `UpdatedAt` FROM `user_cart` WHERE `UserID`='$UserID' ORDER BY `CreatedAt` DESC LIMIT 1")->getRowArray();
        return $query;
    }

    public function CreateUserCart($UserID)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $uuid = Uuid::uuid4()->getBytes();
        $query = $this->db->query("INSERT INTO `user_cart`(`CartID`, `UserID`, `CartStatus`, `CreatedAt`, `UpdatedAt`) VALUES ('$uuid','$UserID',0,'$now','$now');");
        return $query;
    }

    public function CountCart($UserID)
    {
        $getCart = $this->CheckUsedCart($UserID);
        if (!$getCart || $getCart['CartStatus'] == 1) {
            $query['COUNT(*)'] = 0;
        } else {
            $cartId = $getCart['CartID'];
            $query = $this->db->query("SELECT COUNT(*) FROM `user_cart_detail` WHERE `CartID` = '$cartId';")->getRowArray();
        }
        return $query['COUNT(*)'];
    }

    public function AddProductToCart($cartId, $productId)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $uuid = Uuid::uuid4()->getBytes();
        $productId = Uuid::fromString($productId)->getBytes();
        $query = $this->db->query("INSERT INTO `user_cart_detail`(`CartDetailID`, `CartID`, `ProductID`, `TotalBuy`, `CreatedAt`, `UpdatedAt`) VALUES ('$uuid','$cartId','$productId',1,'$now','$now');");
        return $query;
    }

    public function DeleteProductFromCart($cartDetailId)
    {
        $cartDetailId = Uuid::fromString($cartDetailId)->getBytes();
        $query = $this->db->query("SELECT * FROM `user_cart_detail` WHERE `CartDetailID` = '$cartDetailId'")->getRowArray();
        if ($query) {
            $query = $this->db->query("DELETE FROM `user_cart_detail` WHERE `CartDetailID` = '$cartDetailId'");
        } else {
            $query = false;
        }
        return $query;
    }

    public function GetDataCart($userId)
    {
        $query = $this->db->query("SELECT * FROM `user_cart` RIGHT JOIN `user_cart_detail` ON `user_cart_detail`.`CartID` = `user_cart`.`CartID` RIGHT JOIN `products` ON `products`.`ProductID` = `user_cart_detail`.`ProductID` RIGHT JOIN `product_img` ON `product_img`.`ProductID` = `products`.`ProductID` WHERE `user_cart`.`CartStatus`=0 AND `user_cart`.`UserID`='$userId';")->getResultArray();
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['CartID'] = Uuid::fromBytes($value['CartID'])->toString();
            $query[$i]['UserID'] = Uuid::fromBytes($value['UserID'])->toString();
            $query[$i]['CartDetailID'] = Uuid::fromBytes($value['CartDetailID'])->toString();
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $query[$i]['ProductCategoryID'] = Uuid::fromBytes($value['ProductCategoryID'])->toString();
            $i++;
        }
        return $query;
    }

    public function GetDataCartDetail($cartId)
    {
        $query = $this->db->query("SELECT * FROM `user_cart_detail`  JOIN `products` ON `products`.`ProductID` = `user_cart_detail`.`ProductID`  JOIN `product_img` ON `product_img`.`ProductID` = `products`.`ProductID` WHERE `user_cart_detail`.`CartID`='$cartId';")->getResultArray();
        return $query;
    }

    public function UpdateQtyOnCart($cartDetailId, $qty)
    {
        $cartDetailId = Uuid::fromString($cartDetailId)->getBytes();
        $query = $this->db->query("UPDATE `user_cart_detail` SET `TotalBuy`='$qty' WHERE `CartDetailID`='$cartDetailId';");
        return $query;
    }

    public function UpdateStatusCart($cartId)
    {
        $cartId = Uuid::fromString($cartId)->getBytes();
        $query = $this->db->query("UPDATE `user_cart` SET `CartStatus`=1 WHERE `CartID`='$cartId';");
        return $query;
    }
}

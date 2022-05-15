<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'ProductID';
    protected $useTimestamps = true;
    protected $createdField  = 'CreatedAt';
    protected $updatedField  = 'UpdatedAt';

    public function getAllProductAndImageNewest()
    {
        $query = $this->db->query('SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` ORDER BY `products`.`CreatedAt` DESC LIMIT 4')->getResult('array');
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getAllProductAndImage()
    {
        $query = $this->db->query('SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` ORDER BY `products`.`CreatedAt` DESC')->getResult('array');
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getProductAndImage($productId)
    {
        $productId = Uuid::fromString($productId)->getBytes();
        $query = $this->db->query("SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` AND `products`.`ProductID`='$productId';")->getRowArray();
        $query['ProductID'] = Uuid::fromBytes($query['ProductID'])->toString();
        return $query;
    }
}

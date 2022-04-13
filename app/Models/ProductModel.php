<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'ProductID';
    protected $useTimestamps = true;
    protected $createdField  = 'CreatedAt';
    protected $updatedField  = 'UpdatedAt';

    public function getAllProductAndImage(){
        $query = $this->db->query('SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID`')->getResult('array');
        return $query; 
    }
}
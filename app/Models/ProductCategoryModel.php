<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ProductCategoryModel extends Model
{
    protected $table      = 'product_category';
    protected $primaryKey = 'ProductCategoryID';

    public function getDataProductCategory()
    {
        $query = $this->db->query("SELECT * FROM `product_category`;")->getResultArray();
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductCategoryID'] = Uuid::fromBytes($value['ProductCategoryID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getTotalProductBaseOnCategory()
    {
        $query = $this->db->query("SELECT COUNT(t1.ProductID)AS TotalProduct, CategoryName FROM products as t1 JOIN product_category as t2 ON t1.ProductCategoryID = t2.ProductCategoryID GROUP BY CategoryName")->getResultArray();
        return $query;
    }
}

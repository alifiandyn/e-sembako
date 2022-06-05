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
}

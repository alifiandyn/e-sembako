<?php

namespace App\Models;

use CodeIgniter\Model;
use Ramsey\Uuid\Uuid;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'ProductID';
    protected $allowedFields = ['ProductStatus'];
    protected $useTimestamps = true;
    protected $createdField  = 'CreatedAt';
    protected $updatedField  = 'UpdatedAt';

    public function getAllProductAndImageNewest()
    {
        $query = $this->db->query('SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` AND `products`.`ProductStatus`=1 ORDER BY `products`.`CreatedAt` DESC LIMIT 4')->getResult('array');
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getAllProductAndImage()
    {
        $query = $this->db->query('SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` AND `products`.`ProductStatus`=1 ORDER BY `products`.`CreatedAt` DESC')->getResult('array');
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getAllProductAndImagePagination($keyword, $prevData, $limit)
    {
        $query = $this->db->query("SELECT * FROM `products` JOIN `product_img` WHERE `product_img`.`ProductID` = `products`.`ProductID` AND `products`.`ProductStatus`=1 AND `ProductName` LIKE '%$keyword%' ORDER BY `products`.`CreatedAt` DESC LIMIT $prevData,$limit")->getResult('array');
        $i = 0;
        foreach ($query as $value) {
            $query[$i]['ProductID'] = Uuid::fromBytes($value['ProductID'])->toString();
            $i++;
        }
        return $query;
    }

    public function getAllProductAndImageAdmin()
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
        $query['ProductCategoryID'] = Uuid::fromBytes($query['ProductCategoryID'])->toString();
        $query['ProductImageID'] = Uuid::fromBytes($query['ProductImageID'])->toString();
        return $query;
    }

    public function CountTotalProduct($keyword = '')
    {
        $query = $this->db->query("SELECT COUNT(ProductID) AS TotalProduct FROM Products WHERE `ProductName` LIKE '%$keyword%';")->getRowArray();
        return $query;
    }

    public function ProductStatusUpdate($status, $productId)
    {
        $productId = Uuid::fromString($productId)->getBytes();
        $builder = $this->db->table('products');
        $data = ['ProductStatus' => $status];
        $builder->where('ProductID', $productId);
        return $builder->update($data);
    }

    public function AddNewProduct($data)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $productId = Uuid::uuid4()->getBytes();
        $productName = $data['product-name'];
        $price = $data['price'];
        $productCategory = Uuid::fromString($data['product-category'])->getBytes();
        $productDescription = $data['product-description'];
        $gross = $data['gross-weight'];
        $nett = $data['nett-weight'];
        $length = $data['length'];
        $width = $data['width'];
        $height = $data['height'];
        $productImage = $data['product-image'];
        $query = $this->db->query("INSERT INTO `products`(`ProductID`,`ProductName`,`Price`,`ProductCategoryID`,`ProductDescription`,`Bruto`,`Netto`,`ProductLength`, `ProductWidth`,`ProductHeight`,`CreatedAt`,`UpdatedAt`) VALUES ('$productId','$productName','$price','$productCategory','$productDescription','$gross','$nett','$length','$width','$height','$now','$now');");
        $productImageId = Uuid::uuid4()->getBytes();
        $query = $this->db->query("INSERT INTO `product_img`(`ProductImageID`,`ProductID`,`MainImage`) VALUES ('$productImageId','$productId','$productImage');");
        return $query;
    }

    public function EditProduct($data)
    {
        $now = date_create()->format('Y-m-d H:i:s');
        $productId = Uuid::fromString($data['product-id'])->getBytes();
        $productName = $data['edit-product-name'];
        $price = $data['edit-price'];
        $productCategory = Uuid::fromString($data['edit-product-category'])->getBytes();
        $productDescription = $data['edit-product-description'];
        $gross = $data['edit-gross-weight'];
        $nett = $data['edit-nett-weight'];
        $length = $data['edit-length'];
        $width = $data['edit-width'];
        $height = $data['edit-height'];
        $productImage = $data['edit-product-image'];
        $query = $this->db->query("UPDATE `products` SET `ProductName`='$productName',`Price`='$price',`ProductCategoryID`='$productCategory',`ProductDescription`='$productDescription',`Bruto`='$gross',`Netto`='$nett',`ProductLength`='$length', `ProductWidth`='$width',`ProductHeight`='$height',`UpdatedAt`='$now' WHERE `ProductID`='$productId'");
        if ($productImage) {
            $productImageId = Uuid::fromString($data['product-image-id'])->getBytes();
            $query = $this->db->query("UPDATE `product_img` SET `MainImage`='$productImage' WHERE `ProductImageID`='$productImageId'");
        }
        return $query;
    }
}

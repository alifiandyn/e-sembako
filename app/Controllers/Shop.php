<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;

class Shop extends BaseController
{
    protected $productModel;
    protected $productCaregoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productCaregoryModel = new ProductCategoryModel();
    }

    public function index()
    {
        $getCategory = $this->productCaregoryModel->findAll();
        $getProduct = $this->productModel->getAllProductAndImageNewest();
        $data = [
            'title' => 'E-Sembako',
            'banner' => true,
            'newProducts' => $getProduct,
            'categories' => $getCategory
        ];
        return view('shop/home', $data);
    }

    public function About()
    {
        $getCategory = $this->productCaregoryModel->findAll();
        $data = [
            'title' => 'E-Sembako | Tentang Kami',
            'banner' => false,
            'categories' => $getCategory
        ];
        return view('shop/about', $data);
    }

    public function Shop()
    {
        $getCategory = $this->productCaregoryModel->findAll();
        $getProduct = $this->productModel->getAllProductAndImage();
        $data = [
            'title' => 'E-Sembako | Toko',
            'banner' => false,
            'products' => $getProduct,
            'categories' => $getCategory
        ];
        return view('shop/shop', $data);
    }
}

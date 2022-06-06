<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\ShippingModel;
use PhpParser\Node\Stmt\Echo_;

class Admin extends BaseController
{
    protected $productModel;
    protected $productCategoryModel;
    protected $cartModel;
    protected $shippingModel;
    protected $orderModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->cartModel = new CartModel();
        $this->shippingModel = new ShippingModel();
        $this->orderModel = new OrderModel();
    }

    // Data wajib yang harus dikirimin ke halaman
    // 'title' => 'E-Sembako' || Buat judul halaman

    public function index()
    {
        $getDataOrder = $this->orderModel->GetAllOrder();
        $getTotalOrder = count($getDataOrder);
        $getTotalProduct = $this->productModel->CountTotalProduct();
        $getDataOrderWaitingCheck = $this->orderModel->CountTotalOrderByStatusOrder(0);
        $getDataOrderProcess = $this->orderModel->CountTotalOrderByStatusOrder(2);
        $data = [
            'title' => 'E-Sembako | Admin',
            'dataOrder' => $getDataOrder,
            'totalOrder' => $getTotalOrder,
            'totalProduct' => $getTotalProduct['TotalProduct'],
            'totalOrderWaitingCheck' => $getDataOrderWaitingCheck['OrderStatus'],
            'totalOrderProcess' => $getDataOrderProcess['OrderStatus'],
            "validation" => \Config\Services::validation()
        ];
        return view('admin/index.php', $data);
    }

    public function DetailOrder($orderId)
    {
        $getDataUserOrder = $this->orderModel->GetOrderById($orderId);
        $getDataCartOrder = $this->cartModel->GetDataCartDetail($getDataUserOrder['CartID']);
        $data = [
            'title' => 'E-Sembako | Admin',
            'dataUserOrder' => $getDataUserOrder,
            'dataCartOrder' => $getDataCartOrder,
            "validation" => \Config\Services::validation()
        ];
        return view('admin/detail_order', $data);
    }

    public function PrintInvoice($orderId)
    {
        $getDataUserOrder = $this->orderModel->GetOrderById($orderId);
        $getDataCartOrder = $this->cartModel->GetDataCartDetail($getDataUserOrder['CartID']);
        $data = [
            'title' => 'E-Sembako | Print Invoice',
            'dataUserOrder' => $getDataUserOrder,
            'dataCartOrder' => $getDataCartOrder,
            "validation" => \Config\Services::validation()
        ];
        return view('admin/invoice_print', $data);
    }

    public function OrderStatusUpdate($status, $orderId)
    {
        $statusOrder = 0;
        if ($status == "Reject") {
            $statusOrder = 1;
        } elseif ($status == "Accept") {
            $statusOrder = 2;
        } elseif ($status == "Send") {
            $statusOrder = 3;
        }
        $this->orderModel->UpdateOrderStatus($statusOrder, $orderId);
        session()->setFlashdata('message', 'Status Order berhasil diupdate');
        return redirect()->to('/Admin');
    }

    public function Product()
    {
        $getDataProduct = $this->productModel->getAllProductAndImageAdmin();
        $getDataProductCategory = $this->productCategoryModel->getDataProductCategory();
        $data = [
            'title' => 'E-Sembako | Product',
            'dataProduct' => $getDataProduct,
            'dataProductCategory' => $getDataProductCategory,
            "validation" => \Config\Services::validation()
        ];
        return view('admin/product.php', $data);
    }

    // Fungsi untuk mengganti status product
    public function ProductStatus($status, $productId)
    {
        if ($status == 1) {
            $newStatus = 0;
        } else {
            $newStatus = 1;
        }
        $this->productModel->ProductStatusUpdate($newStatus, $productId);
        session()->setFlashdata('message', 'Status Product anda berhasil diubah');
        return redirect()->to('/Admin/Product');
    }
    // Fungsi untuk mengganti status product

    // Fungsi API untuk mendapatkan data product
    public function GetDataProduct($productId)
    {
        $data = $this->productModel->getProductAndImage($productId);
        $data['DataProductCategory'] = $this->productCategoryModel->getDataProductCategory($productId);
        return json_encode($data);
    }
    // Fungsi API untuk mendapatkan data product

    // Fungsi untuk menambahkan produk baru
    public function AddNewProduct()
    {
        if (!$this->validate([
            'product-name' => 'required',
            'price' => 'required',
            'product-category' => 'required',
            'product-description' => 'required',
            'gross-weight' => 'required',
            'nett-weight' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'product-image' => [
                'rules' => 'uploaded[product-image]|max_size[product-image,2048]|is_image[product-image]|mime_in[product-image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harap upload product image',
                    'max_size' => 'Gambar yang anda upload terlalu besar, maksimal ukuran gambar 2Mb',
                    'is_image' => 'File yang anda upload bukan gambar',
                    'mime_in' => 'File yang anda upload bukan gambar'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Gagal menambahkan produk baru');
            return redirect()->to('Admin/Product')->withInput();
        }
        $file = $this->request->getFile('product-image');
        $file->move('dist/img');
        $data = $this->request->getPost();
        $data['product-image'] = $file->getName();
        $this->productModel->AddNewProduct($data);
        session()->setFlashdata('message', 'Berhasil menambahkan produk baru');
        return redirect()->to('Admin/Product');
    }
    // Fungsi untuk menambahkan produk baru

    // Fungsi untuk mengedit produk 
    public function EditProduct()
    {
        if (!$this->validate([
            'product-id' => 'required',
            'edit-product-name' => 'required',
            'edit-price' => 'required',
            'edit-product-category' => 'required',
            'edit-product-description' => 'required',
            'edit-gross-weight' => 'required',
            'edit-nett-weight' => 'required',
            'edit-length' => 'required',
            'edit-width' => 'required',
            'edit-height' => 'required',
            'edit-product-image' => [
                'rules' => 'max_size[edit-product-image,2048]|is_image[edit-product-image]|mime_in[edit-product-image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar yang anda upload terlalu besar, maksimal ukuran gambar 2Mb',
                    'is_image' => 'File yang anda upload bukan gambar',
                    'mime_in' => 'File yang anda upload bukan gambar'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Gagal mengedit produk ');
            return redirect()->to('Admin/Product')->withInput();
        }
        $data = $this->request->getPost();
        $file = $this->request->getFile('edit-product-image');
        $data['edit-product-image'] = $file->getName();
        $old = $this->request->getPost('old-product-image');
        if ($data['edit-product-image']) {
            $path = 'dist/img/' . $old;
            unlink($path);
            $file->move('dist/img');
        }
        $this->productModel->EditProduct($data);
        session()->setFlashdata('message', 'Berhasil mengedit produk ');
        return redirect()->to('Admin/Product');
    }
    // Fungsi untuk mengedit produk 
}

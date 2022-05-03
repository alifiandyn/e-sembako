<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\CartModel;
use CodeIgniter\Session\Session;

class Shop extends BaseController
{
    protected $productModel;
    protected $productCategoryModel;
    protected $cartModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->cartModel = new CartModel();
    }

    // Data wajib yang harus dikirimin ke halaman
    // 'title' => 'E-Sembako' || Buat judul halaman
    // 'banner' => true || Buat ngasih info mau nampilin carousel di navbar apa tidak
    // 'cart' => $countCart || Buat ngasih info total barang yang sudah ditambah di cart

    public function index()
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getCategory = $this->productCategoryModel->findAll();
        $getProduct = $this->productModel->getAllProductAndImageNewest();
        $data = [
            'title' => 'E-Sembako',
            'banner' => true,
            'cart' => $countCart,
            'categories' => $getCategory,
            'newProducts' => $getProduct
        ];
        return view('shop/home', $data);
    }

    public function About()
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $data = [
            'title' => 'E-Sembako | Tentang Kami',
            'banner' => false,
            'cart' => $countCart
        ];
        return view('shop/about', $data);
    }

    public function Shop()
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getCategory = $this->productCategoryModel->findAll();
        $getProduct = $this->productModel->getAllProductAndImage();
        $data = [
            'title' => 'E-Sembako | Toko',
            'banner' => false,
            'cart' => $countCart,
            'categories' => $getCategory,
            'products' => $getProduct
        ];
        return view('shop/shop', $data);
    }

    public function Cart()
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getCart = $this->cartModel->GetDataCart(session()->get('UserID'));
        $data = [
            'title' => 'E-Sembako | Cart',
            'banner' => false,
            'cart' => $countCart,
            'cartContents' => $getCart,
        ];
        return view('shop/cart', $data);
    }

    // Fungsi untuk menambahkan barang kedalam keranjang (cart)
    public function CartAdd($productId)
    {
        if (!session()->get('UserID')) {
            session()->setFlashdata('message', 'Anda belum login, silahkan login untuk menambahkan ke keranjang');
            return redirect()->to('/Auth/SignIn');
        }
        $getCart = $this->cartModel->CheckUsedCart(session()->get('UserID'));

        if (!$getCart || $getCart['CartStatus'] == 1) {
            $this->cartModel->CreateUserCart(session()->get('UserID'));
            $getCart = $this->cartModel->CheckUsedCart(session()->get('UserID'));
        };
        $cartId = $getCart['CartID'];
        $this->cartModel->AddProductToCart($cartId, $productId);
        session()->setFlashdata('message', 'Berhasil menambahkan produk ke keranjang anda');
        return redirect()->to('/Shop');
    }
    // Fungsi untuk menambahkan barang kedalam keranjang (cart)

    // Fungsi untuk menghapus barang pada keranjang (cart)
    public function CartDelete($cartDetailId)
    {
        // $cartDetailId = 'fa2b64e3-c847-41ff-9549-f69b8e6030ba'; Buat ngetest notifikasi gagal
        $deletedProduct = $this->cartModel->DeleteProductFromCart($cartDetailId);
        if ($deletedProduct == true) {
            session()->setFlashdata('message', 'Berhasil menghapus produk dari keranjang anda');
            return redirect()->to('/Shop/Cart');
        } else {
            session()->setFlashdata('message', 'Gagal menghapus produk, terjadi kesalahan. Silahkan hubungi CC kami');
            return redirect()->to('/Shop/Cart');
        }
    }
    // Fungsi untuk menghapus barang pada keranjang (cart)
}

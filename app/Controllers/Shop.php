<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\ShippingModel;
use CodeIgniter\Database\Query;
use CodeIgniter\Session\Session;

class Shop extends BaseController
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
        $keyword = $this->request->getGet("keyword");
        $limit = ($this->request->getGet("limit")) ? $this->request->getGet("limit") : 10;
        $page = $this->request->getGet("page") ?? 0;
        $skipData = (!$page || $page == 0) ? 0 : $this->request->getGet("page") * $limit;
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getCategory = $this->productCategoryModel->findAll();
        $getProduct = $this->productModel->getAllProductAndImagePagination($keyword, $skipData, $limit);
        $getTotalData = $this->productModel->CountTotalProduct($keyword);
        $data = [
            'title' => 'E-Sembako | Toko',
            'banner' => false,
            'cart' => $countCart,
            'categories' => $getCategory,
            'products' => $getProduct,
            "page" => $page,
            "keyword" => $keyword,
            "limit" => $limit,
            "totalData" => $getTotalData['TotalProduct']
        ];
        return view('shop/shop', $data);
    }

    public function ProductDetail($productId)
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getProduct = $this->productModel->getProductAndImage($productId);
        $data = [
            'title' => 'E-Sembako | Produk',
            'banner' => false,
            'cart' => $countCart,
            'product' => $getProduct
        ];
        return view('shop/detail_product', $data);
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

    public function Checkout()
    {
        $countCart = $this->cartModel->CountCart(session()->get('UserID'));
        $getCart = $this->cartModel->GetDataCart(session()->get('UserID'));
        $getShippingAddress = $this->shippingModel->GetShippingAddress(session()->get('UserID'));
        $data = [
            'title' => 'E-Sembako | Checkout',
            'banner' => false,
            'cart' => $countCart,
            'cartContents' => $getCart,
            'listShippingAddress' => $getShippingAddress,
            "validation" => \Config\Services::validation(),
        ];
        return view('shop/checkout', $data);
    }

    public function CreateOrder()
    {
        if ($this->request->getPost('shipping-address-id') == 0) {
            session()->setFlashdata('message', 'Anda belum memilih alamat pengiriman');
            return redirect()->to('Checkout');
        }
        if (!$this->validate([
            'payment-image' => [
                'rules' => 'uploaded[payment-image]|max_size[payment-image,2048]|is_image[payment-image]|mime_in[payment-image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Harap upload terlebih dahulu bukti pembayaran',
                    'max_size' => 'Gambar yang anda upload terlalu besar, maksimal ukuran gambar 2Mb',
                    'is_image' => 'File yang anda upload bukan gambar',
                    'mime_in' => 'File yang anda upload bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('Checkout')->withInput();
        }
        $file = $this->request->getFile('payment-image');
        $file->move('dist/img/payment-evidence');
        $namaFile = $file->getName();
        $cartId = $this->request->getPost('cart-id');
        $shippingAddressId = $this->request->getPost('shipping-address-id');
        $this->cartModel->UpdateStatusCart($cartId);
        $this->orderModel->CreateOrder(session()->get('UserID'), $cartId, $shippingAddressId, $namaFile);
        session()->setFlashdata('message', 'Pesanan anda berhasil dibuat');
        return redirect()->to('/Shop');
    }

    // Fungsi API untuk mengambil Data Alamat Pengiriman
    public function GetShippingAddressData()
    {
        $ShippingAddressID = $this->request->getVar('ShippingAddressID');
        $data = $this->shippingModel->GetShippingAddressData($ShippingAddressID);
        return json_encode($data);
    }
    // Fungsi API untuk mengambil Data Alamat Pengiriman

    // Fungsi API untuk mengupdate qty pada halaman cart
    public function UpdateQtyOnCart()
    {
        $cartDetailId = $this->request->getGet('cartDetailId');
        $qty = $this->request->getVar('qty');
        $data = $this->cartModel->UpdateQtyOnCart($cartDetailId, $qty);
        return json_encode($data);
    }
    // Fungsi API untuk mengupdate qty pada halaman cart

    // Fungsi untuk membuat alamat pengiriman baru
    public function AddNewShippingAddress()
    {
        if (!$this->validate([
            'first-name' => 'required',
            'last-name' => 'required',
            'email' => 'required|valid_email',
            'phone-number' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'ward' => 'required',
            'street' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('Checkout')->withInput()->with('validation', $validation);
        }
        $this->shippingModel->CreateNewShippingAddress(session()->get('UserID'), $this->request->getPost());
        session()->setFlashdata('message', 'Berhasil membuat alamat pengiriman baru');
        return redirect()->to('/Checkout');
    }
    // Fungsi untuk membuat alamat pengiriman baru

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

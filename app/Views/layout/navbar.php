<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <?php if ($banner == true) : ?>
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php foreach ($categories as $category) : ?>
                            <a href="" class="nav-item nav-link"><?= $category["CategoryName"]; ?></a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            </div>
        <?php endif; ?>
        <div class="col-lg">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Sembako</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="<?= base_url() ?>" class="nav-item nav-link active">Home</a>
                        <a href="<?= base_url('Shop') ?>" class="nav-item nav-link">Toko</a>
                        <a href="detail.html" class="nav-item nav-link">Promo Ramadhan</a>
                        <a href="detail.html" class="nav-item nav-link">Program Subsidi</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="" class="nav-item nav-link">Login</a>
                        <a href="" class="nav-item nav-link">Register</a>
                    </div>
                </div>
            </nav>
            <?php if ($banner == true) : ?>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="https://blog.anteraja.id/wp-content/uploads/2020/10/Tips-Membuka-Usaha-Sembako-dengan-Modal-Kecil-untuk-Pemula-1280x720.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">Diskon sampai dengan 30%</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Promo Spesial Bulan Ramadhan</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Cek Sekarang</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2021/08/31/686219242.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">Program Sembako Murah</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">E-Sembako x Pemprov DKI Jakarta</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Cek Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Navbar End -->
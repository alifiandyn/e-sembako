    <?= $this->extend('shop/layout/templete'); ?>

    <?= $this->section('content'); ?>
    <?= $this->include('shop/layout/topbar'); ?>
    <?= $this->include('shop/layout/navbar'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Tentang Kami</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="<?= base_url('Shop') ?>">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Tentang Kami</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">PT. Sembilan Bahan Pokok</span></h2>
        </div>
        <div class="row px-xl-5 justify-content-center">
            <div class="col-md-4">
                <a href="<?= base_url('Shop') ?>" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold" style="font-size: 72px;"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Sembako</h1>
                </a>
            </div>
            <div class="col-md-4">
                <p class="text-justify">E-Sembako adalah sebuah platform untuk memudahkan masyarakat dalam mencari sembako (sembilan bahan pokok). Kami memiliki suplier-suplier lokal yang memiliki produk berkualitas. Kami juga sering bekerjasama dengan pemerintah daerah maupun pemerintah pusat untuk menggelar Pasar Sembako Online murah</p>
            </div>
        </div>
        <div class="row px-xl-5 justify-content-center mt-3 mb-3">
            <div class="col-md-4">
                <h3 class="text-center"><b>VISI</b></h3>
                <p class="text-justify">Mensejahterakan masyarakat Indonesia dengan membantu menjualkan produk-produk lokal dan mempermudah masyarakat dalam mencari bahan pokok untuk kelangsungan hidup.</p>
            </div>
        </div>
        <div class="row px-xl-5 justify-content-center mt-3 mb-3">
            <div class="col-md-4 p-0">
                <h3 class="text-center"><b>MISI</b></h3>
                <p class="">
                <ul>
                    <li>Memperkenalkan dan memasarkan produk-produk lokal.
                    </li>
                    <li>
                        Meningkatkan kesadaran masyarakat untuk mencintai produk-produk lokal.
                    </li>
                    <li>Mengadakan pelatihan untuk meningkatkan kemampuan masyarakat khususnya pada bidang ekonomi.</li>
                    <li>Menginisiasi program baru yang dapat memajukan masyarakat.
                    </li>
                    <li>Bekerja sama dengan instansi atau lembaga swasta maupun pemerintah untuk mengelola SDM.
                    </li>
                </ul>
                </p>
            </div>
        </div>
        <hr>
    </div>
    </div>
    <!-- Contact End -->
    <?= $this->include('shop/layout/footer'); ?>
    <?= $this->endSection(); ?>
    <?= $this->extend('layout/templete'); ?>

    <?= $this->section('content'); ?>
    <?= $this->include('layout/topbar'); ?>
    <?= $this->include('layout/navbar'); ?>

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter Sesuai Kategori</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all" disabled>
                            <label class="custom-control-label" for="price-all"><b>Semua Barang</b></label>
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php foreach ($categories as $category) : ?>
                            <?php $i = 1; ?>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="category-<?= $i ?>" disabled>
                                <label class="custom-control-label" for="category-<?= $i; ?>"><?= $category["CategoryName"]; ?></label>
                                <!-- <span class="badge border font-weight-normal">1000</span> -->
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter Sesuai Harga</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all" disabled>
                            <label class="custom-control-label" for="price-all"><b>Semua Harga</b></label>
                            <!-- <span class="badge border font-weight-normal">1000</span> -->
                        </div>
                        <?php $price = 0; ?>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="price-<?= $i ?>" disabled>
                                <label class="custom-control-label" for="price-<?= $i ?>"><?= rupiah($price); ?> - <?= rupiah($price = ($price + 1000000) - 1); ?></label>
                                <!-- <span class="badge border font-weight-normal">150</span> -->
                            </div>
                            <?php $price++; ?>
                        <?php endfor; ?>
                    </form>
                </div>
                <!-- Price End -->


            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="<?= base_url('dist/img/' . $product["MainImage"]); ?>" alt="" style="aspect-ratio:1/1;object-fit:contain">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?= $product["ProductName"]; ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <b><?= rupiah($product["Price"]); ?></b>
                                        <!-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> -->
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="<?= base_url('Product/' . $product["ProductID"]); ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="<?= base_url('Cart/Add/' . $product["ProductID"]); ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Modal Notification -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= session()->getFlashdata('message');  ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Modal Notification -->

    <?= $this->include('layout/footer'); ?>
    <?= $this->endSection(); ?>
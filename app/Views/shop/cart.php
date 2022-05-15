    <?= $this->extend('layout/templete'); ?>

    <?= $this->section('content'); ?>
    <?= $this->include('layout/topbar'); ?>
    <?= $this->include('layout/navbar'); ?>

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle cart-contents">
                        <?php $totalHarga = 0;
                        $i = 1; ?>
                        <?php foreach ($cartContents as $product) : ?>
                            <?php $totalHarga = $totalHarga + ($product["Price"] * $product["TotalBuy"]); ?>
                            <tr>
                                <td class="align-middle"><img src="<?= base_url('dist/img/' . $product['MainImage']) ?>" alt="" style="width: 50px;"> <?= $product['ProductName']; ?></td>
                                <td class="align-middle"><?= rupiah($product['Price']); ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" onclick="QtyChange(<?= $i ?>,'minus')">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center total-buy" value="<?= $product['TotalBuy']; ?>" id="total-buy-<?= $i ?>" onchange="QtyChange(<?= $i ?>,'')" data-unit-price="<?= $product['Price'] ?>" data-detail-id="<?= $product['CartDetailID'] ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" onclick="QtyChange(<?= $i ?>,'plus')">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total-price-<?= $i ?>"><?= rupiah($product['Price'] * $product['TotalBuy']); ?></td>
                                <td class="align-middle"><a class="btn btn-sm btn-primary" href="<?= base_url('Cart/Delete/' . $product["CartDetailID"]); ?>"><i class="fa fa-times"></i></a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                        <input type="hidden" name="total-price" id="total-price" value="<?= $totalHarga; ?>">
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Masukan Kode Kupon">
                        <div class="input-group-append">
                            <button class="btn btn-primary disabled" disabled>Cek Kupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-center">Info Belanja</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Total Harga</h6>
                            <h6 class="font-weight-medium" id="total-price-info"><?= rupiah($totalHarga); ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Biaya Pengiriman</h6>
                            <h6 class="font-weight-medium"><?= rupiah(10000); ?></h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="total-invoice"><?= rupiah($totalHarga + 10000); ?></h5>
                        </div>
                        <a href="<?= base_url('Checkout'); ?>" class="btn btn-block btn-primary my-3 py-3">Lanjut Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

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
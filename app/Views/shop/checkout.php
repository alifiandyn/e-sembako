    <?= $this->extend('layout/templete'); ?>

    <?= $this->section('content'); ?>
    <?= $this->include('layout/topbar'); ?>
    <?= $this->include('layout/navbar'); ?>

    <!-- Checkout Start -->
    <form enctype="multipart/form-data" method="POST" action="<?= base_url('Order'); ?>">
        <?= csrf_field(); ?>
        <div class=" container-fluid pt-5">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Alamat Pengiriman</h4>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="input-group">
                                    <select class="custom-select" id="selectShippingAddress" onchange="GetDataShippingAddress()" name="shipping-address-id">
                                        <option value="0" selected>Choose...</option>
                                        <?php foreach ($listShippingAddress as $shippingAddress) : ?>
                                            <option value="<?= $shippingAddress['ShippingAddressID']; ?>"><?= $shippingAddress['FirstName'] . " " . $shippingAddress['LastName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Alamat Baru</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nama Depan</label>
                                <input class="form-control disabled" type="text" placeholder="" id="first-name-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nama Belakang</label>
                                <input class="form-control disabled" type="text" placeholder="" id="last-name-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control disabled" type="email" placeholder="" id="email-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nomor Telepon</label>
                                <input class="form-control disabled" type="tel" placeholder="" id="phone-number-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Provinsi</label>
                                <input class="form-control disabled" type="text" placeholder="" id="province-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kota</label>
                                <input class="form-control disabled" type="text" placeholder="" id="city-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kecamatan</label>
                                <input class="form-control disabled" type="text" placeholder="" id="subdistrict-info" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kelurahan</label>
                                <input class="form-control disabled" type="text" placeholder="" id="ward-info" disabled>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Nama Jalan</label>
                                <input class="form-control disabled" type="text" placeholder="" id="street-info" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-info" role="alert">
                        Untuk sementara <b>E-Sembako</b> hanya bisa mendukung pembayaran via transfer manual, setelah melakukan transaksi dan mengupload bukti transfer harap menghubi Whatsapp admin kami!.
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-center"><img src="https://www.yayasansimetri.or.id/wp-content/uploads/2021/03/Logo-BCA-blue-A4.png" alt="" style="object-fit: contain;width:100px;aspect-ratio: 1 / 1;"><br>
                            <b>3213131312 </b> <br>A/N PT Sembilan Bahan Pokok
                        </div>
                        <div class="col-md-4 text-center"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="" style="object-fit: contain;width:100px;aspect-ratio: 1 / 1;"><br>
                            <b>354314213</b> <br>A/N PT Sembilan Bahan Pokok
                        </div>
                        <div class="col-md-4 text-center"><img src="https://rekreartive.com/wp-content/uploads/2019/04/Logo-BNI-Bank-Negara-Indonesia-46-Vector-.png" alt="" style="object-fit: contain;width:100px;aspect-ratio: 1 / 1;"><br>
                            <b>17097934 </b> <br>A/N PT Sembilan Bahan Pokok
                        </div>
                        <div class="col-md-4 text-center"><img src="https://blogger.googleusercontent.com/img/a/AVvXsEiL-Z4N4ZWA1XzsRey-BtSFNExzQoAG2uAeL7dPDHJdgGs9DC7JhGgvu3qWs7uyQBuuKKBIZvNiL1BtT70JIgM4xWOw4zJegKAtf6Gp1jIIXN_nhCj32CZCKt1iC1JQD2rW4VT9HxGWD1zPSs030CiphPTU7CGD-aq30yPFm2spAhuza9Pb5kfFSJzT1g=w320-h320" alt="" style="object-fit: contain;width:100px;aspect-ratio: 1 / 1;"><br>
                            <b>13364631 </b> <br>A/N PT Sembilan Bahan Pokok
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Info Belanja
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">
                                            <h5 class="font-weight-medium mb-3">Products</h5>
                                        </th>
                                        <th class=" text-center" scope="col">
                                            <h5 class="font-weight-medium mb-3">Qty</h5>
                                        </th>
                                        <th class=" text-center" scope="col">
                                            <h5 class="font-weight-medium mb-3">Harga</h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalHarga = 0; ?>
                                    <?php foreach ($cartContents as $cart) : ?>
                                        <?php $totalHarga = $totalHarga + ($cart["Price"] * $cart["TotalBuy"]); ?>
                                        <tr>
                                            <td class="w-50"><?= $cart['ProductName']; ?></td>
                                            <td class="w-10 text-center"><?= $cart['TotalBuy']; ?></td>
                                            <td class="w-40 text-right"><?= rupiah($cart['Price']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <hr class="mt-0">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Total Harga</h6>
                                <h6 class="font-weight-medium"><?= rupiah($totalHarga); ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Biaya Pengiriman</h6>
                                <h6 class="font-weight-medium"><?= rupiah(10000); ?></h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold"><?= rupiah($totalHarga + 10000); ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <p>Pilih Metode Pembayaran</p>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal" checked>
                                    <label class="custom-control-label" for="paypal">Bank Transfer (Manual Cek)</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input disabled" name="payment" id="" disabled>
                                    <label class="custom-control-label" for="">Virtual Account</label>
                                </div>
                            </div>
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input disabled" name="payment" id="" disabled>
                                    <label class="custom-control-label" for="">Credit Card</label>
                                </div>
                            </div>
                            <hr>
                            <p>Upload Bukti Pembayaran Disini</p>
                            <div class="form-group">
                                <div class="custom-control custom-file">
                                    <input type="file" class="custom-file-input <?= $validation->hasError('payment-image') ? 'is-invalid' : ''; ?>" id="customFile" name="payment-image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('payment-image'); ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cart-id" value="<?= $cartContents[0]['CartID'] ?>">
                        <div class="card-footer border-secondary bg-transparent">
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Pesan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Checkout End -->

    <!-- Modal Add New Shipping Address -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('Checkout/AddShippingAddress/'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Alamat Pengiriman Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nama Depan</label>
                                <input class="form-control <?= $validation->hasError('first-name') ? 'is-invalid' : ''; ?>" type="text" placeholder="Alifiandy" name="first-name">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('first-name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nama Belakang</label>
                                <input class="form-control <?= $validation->hasError('last-name') ? 'is-invalid' : ''; ?>" type="text" placeholder="Nugraha" name="last-name">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('last-name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" type="email" placeholder="contoh@email.com" name="email" value="<?= old('email'); ?>">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nomor Telepon</label>
                                <input class="form-control <?= $validation->hasError('phone-number') ? 'is-invalid' : ''; ?>" type="tel" minlength="11" maxlength="13" placeholder="088731313131" name="phone-number">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('phone-number'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Provinsi</label>
                                <input class="form-control <?= $validation->hasError('province') ? 'is-invalid' : ''; ?>" type="text" placeholder="DKI Jakarta" name="province">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('province'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kota</label>
                                <input class="form-control <?= $validation->hasError('city') ? 'is-invalid' : ''; ?>" type="text" placeholder="Jakarta Barat" name="city">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('city'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kecamatan</label>
                                <input class="form-control <?= $validation->hasError('subdistrict') ? 'is-invalid' : ''; ?>" type="text" placeholder="Cengkareng" name="subdistrict">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('subdistrict'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Kelurahan</label>
                                <input class="form-control <?= $validation->hasError('ward') ? 'is-invalid' : ''; ?>" type="text" placeholder="Cengkareng Timur" name="ward">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('ward'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Nama Jalan</label>
                                <input class="form-control <?= $validation->hasError('street') ? 'is-invalid' : ''; ?>" type="text" placeholder="Jl. Contoh (Depan SMK Contoh) RT.99/RW.99 No.99Z" name="street">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('street'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="Submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Add New Shipping Address End -->

    <!-- Modal Notification -->
    <?php if (session()->getFlashdata('message') || $validation->hasError('payment-image')) : ?>
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
                        <?= session()->getFlashdata('message') ? session()->getFlashdata('message') : $validation->getError('payment-image');  ?>
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
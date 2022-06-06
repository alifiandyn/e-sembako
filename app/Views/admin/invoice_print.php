<?= $this->extend('admin/layout/templete'); ?>

<?= $this->section('content'); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> E-Sembako
                        <small class="float-right">Date: <?= date('d-M-Y') ?></small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>PT SEMBILAN BAHAN POKOK</strong><br>
                        Jl. Pedongkelan Pintu No.Dalam, RT.14/RW.13<br>
                        Kapuk, Cengkareng, West Jakarta City, Jakarta 11720<br>
                        Phone: +62 887-1658-974<br>
                        Email: info@e-sembako.co.id
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?= $dataUserOrder['FirstName'] . ' ' . $dataUserOrder['LastName']; ?></strong><br>
                        <?= $dataUserOrder['Street']; ?><br>
                        <?= $dataUserOrder['Ward'] . ', ' . $dataUserOrder['Subdistrict'] . ', ' . $dataUserOrder['City'] . ', ' . $dataUserOrder['Province']; ?><br>
                        Phone: <?= $dataUserOrder['PhoneNumber']; ?><br>
                        Email: <?= $dataUserOrder['Email']; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice</b><br>
                    <br>
                    <b>Order ID:</b> <?= $dataUserOrder['UserOrderID']; ?><br>
                    <b>Payment Due:</b> <?= $dataUserOrder['CreatedAt']; ?><br>
                    <b>Account:</b> <?= $dataUserOrder['Username']; ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalHarga = 0;
                            $i = 1; ?>
                            <?php foreach ($dataCartOrder as $product) : ?>
                                <?php $totalHarga = $totalHarga + ($product["Price"] * $product["TotalBuy"]); ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td class="align-middle">
                                        <?= $product['ProductName']; ?>
                                    </td>
                                    <td class="align-middle"><?= rupiah($product['Price']); ?></td>
                                    <td class="align-middle"><?= $product['TotalBuy']; ?></td>
                                    <td class="align-middle" id="total-price-<?= $i ?>"><?= rupiah($product['Price'] * $product['TotalBuy']); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <!-- <p class="lead">Payment Methods:</p>
                                        <img src="../../dist/img/credit/visa.png" alt="Visa">
                                        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                            plugg
                                            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                        </p> -->
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due <?= date('d-M-Y') ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td><?= rupiah($totalHarga); ?></td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td><?= rupiah(10000); ?></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><?= rupiah($totalHarga + 10000); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <script>
        window.addEventListener("load", window.print());
    </script>
    <?= $this->endSection(); ?>
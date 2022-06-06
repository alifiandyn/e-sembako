<?= $this->extend('admin/layout/templete'); ?>

<?= $this->section('content'); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <?= $this->include('admin/layout/navbar'); ?>
        <?= $this->include('admin/layout/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Order</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Order</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                If the order has been sent, click the send button to update the database status.
                            </div>


                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
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

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="<?= base_url('Admin/PrintInvoice/' . $dataUserOrder['UserOrderID']) ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                            Payment
                                        </button> -->
                                        <a href="<?= base_url('Admin/OrderStatus/Send/' . $dataUserOrder['UserOrderID']) ?>" class="btn btn-success float-right <?= $dataUserOrder['OrderStatus'] == 0 || $dataUserOrder['OrderStatus'] == 1 || $dataUserOrder['OrderStatus'] == 3 || $dataUserOrder['OrderStatus'] == 4 ? "disabled" : ""; ?>" style="margin-right: 5px;">
                                            <i class="fa-solid fa-truck-fast"></i> Send
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?= $this->include('admin/layout/footer') ?>

    </div>
    <!-- ./wrapper -->



    <?= $this->endSection(); ?>
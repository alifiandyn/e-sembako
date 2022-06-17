<?= $this->extend('admin/layout/templete'); ?>

<?= $this->section('content'); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?= $this->include('admin/layout/navbar'); ?>
        <?= $this->include('admin/layout/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Home</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $totalProduct; ?></h3>

                                    <p>Product</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-solid fa-box"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $totalOrder; ?></h3>

                                    <p>Total Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $totalOrderWaitingCheck; ?></h3>

                                    <p>Waiting Verification</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $totalOrderProcess; ?></h3>

                                    <p>Order Processed</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email</th>
                                                <th>Payment Status</th>
                                                <th>Payment Evidence</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($dataOrder as $order) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $order['Email']; ?>
                                                    </td>
                                                    <td><?php if ($order['OrderStatus'] == 0) {
                                                            echo '<span class="badge badge-warning">Waiting Verification</span>';
                                                        } elseif ($order['OrderStatus'] == 1) {
                                                            echo '<span class="badge badge-danger">Payment Rejected</span>';
                                                        } elseif ($order['OrderStatus'] == 2) {
                                                            echo '<span class="badge badge-info">Order Processed</span>';
                                                        } elseif ($order['OrderStatus'] == 3) {
                                                            echo '<span class="badge badge-success">Order Sent</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <!-- <span class="badge badge-info"><a style="color:black" href="<?= base_url('dist/img/payment-evidence/' . $order['PaymentEvident']); ?>">view payment</a></span> -->
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewPaymentModal" onclick="ShowPaymentEvidence(`<?= base_url('dist/img/payment-evidence/' . $order['PaymentEvident']); ?>`)">
                                                            view payment
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('Admin/OrderStatus/Reject/' . $order['UserOrderID']) ?>" class="btn btn-danger <?= $order['OrderStatus'] != 0 ? "disabled" : ""; ?>">Reject</a>
                                                        <a href="<?= base_url('Admin/OrderStatus/Accept/' . $order['UserOrderID']) ?>" class="btn btn-success <?= $order['OrderStatus'] != 0 ? "disabled" : ""; ?>">Accept</a>
                                                        <a href="<?= base_url('Admin/DetailOrder/' . $order['UserOrderID']) ?>" class="btn btn-primary">Detail</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?= $this->include('admin/layout/footer') ?>

    </div>
    <!-- ./wrapper -->

    <!-- View Payment Modal -->
    <div class="modal fade" id="viewPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Evidence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="payment-evidence-image">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./View Payment Modal -->

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

    <?= $this->endSection(); ?>
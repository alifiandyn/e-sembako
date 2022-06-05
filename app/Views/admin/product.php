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
                            <h1 class="m-0">Product</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <!-- Large modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add New Product</button>
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product Name</th>
                                                <th style="width: 30vw;">Product Description</th>
                                                <th>Price</th>
                                                <th>Nett Weight</th>
                                                <th>Gross Weight</th>
                                                <th>Status Product</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($dataProduct as $product) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $product['ProductName']; ?>
                                                    <td><?= $product['ProductDescription']; ?>
                                                    <td><?= rupiah($product['Price']); ?>
                                                    <td><?= $product['Netto']; ?>
                                                    <td><?= $product['Bruto']; ?>
                                                    <td><?= $product['ProductStatus'] == 1 ? "Acitve" : "Non-Active"; ?>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="<?= base_url('/Admin/ProductStatus/' . $product['ProductStatus'] . '/' . $product['ProductID']); ?>" class="btn btn-<?= $product['ProductStatus'] == 1 ? "danger" : "warning"; ?>"><?= $product['ProductStatus'] == 1 ? "Deactivate" : "Active"; ?></a>
                                                            <button data-toggle="modal" data-target=".bd-example-modal-lg2" onclick="EditProduct('<?= $product['ProductID']; ?>')" class="btn btn-info">Edit</button>
                                                        </div>
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

    <!-- Modal Add Product -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('Admin/Product/Add'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Product Name</label>
                                <input class="form-control <?= $validation->hasError('product-name') ? 'is-invalid' : ''; ?>" type="text" placeholder="Alif Meal" name="product-name">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('product-name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Price</label>
                                <input class="form-control <?= $validation->hasError('price') ? 'is-invalid' : ''; ?>" type="number" placeholder="32131321" name="price">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('price'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                                    <select class="custom-select <?= $validation->hasError('product-category') ? 'is-invalid' : ''; ?>" name="product-category">
                                        <option value="" selected>Choose category!</option>
                                        <?php foreach ($dataProductCategory as $category) : ?>
                                            <option value="<?= $category['ProductCategoryID']; ?>"><?= $category['CategoryName']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="valid-feedback d-block">
                                        <?= $validation->getError('product-category'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Product Image</label>
                                <div class="custom-control custom-file">
                                    <input type="file" class="custom-file-input <?= $validation->hasError('product-image') ? 'is-invalid' : ''; ?>" id="customFile" name="product-image" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('product-image'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea class="form-control <?= $validation->hasError('product-description') ? 'is-invalid' : ''; ?>" rows="3" name="product-description">Write product description here!</textarea>
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('product-description'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Gross Weight (kg)</label>
                                <input class="form-control <?= $validation->hasError('gross-weight') ? 'is-invalid' : ''; ?>" type="number" placeholder="3" name="gross-weight">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('gross-weight'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nett Weight (kg)</label>
                                <input class="form-control <?= $validation->hasError('nett-weight') ? 'is-invalid' : ''; ?>" type="number" placeholder="5" name="nett-weight">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('nett-weight'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Length (mm)</label>
                                <input class="form-control <?= $validation->hasError('length') ? 'is-invalid' : ''; ?>" type="number" placeholder="5" name="length">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('length'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Width (mm)</label>
                                <input class="form-control <?= $validation->hasError('width') ? 'is-invalid' : ''; ?>" type="number" placeholder="13" name="width">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('width'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Height (mm)</label>
                                <input class="form-control <?= $validation->hasError('height') ? 'is-invalid' : ''; ?>" type="number" placeholder="3" name="height">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('height'); ?>
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
    <!-- Modal Add Product -->

    <!-- Modal Edit Product -->
    <div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('Admin/Product/Edit'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="edit-product">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="Submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit Product -->

    <?= $this->endSection(); ?>
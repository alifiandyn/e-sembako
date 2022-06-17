<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<?= $this->renderSection('content'); ?>

<!-- jQuery -->
<script src="<?= base_url(); ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?= base_url(); ?>/plugins/chart.js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url(); ?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url(); ?>/dist/js/pages/dashboard.js"></script>
<!-- Page specific script -->
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    const ShowPaymentEvidence = (image) => {
        $("#payment-evidence-image").empty();
        $('#payment-evidence-image').append(`
            <img src="${image}" class="img-fluid" alt="Responsive image">
            `);
    }

    $(window).on('load', function() {
        $('#modalNotification').modal('show');
    });

    const EditProduct = (productId) => {
        const i = 0;
        $.ajax({
            type: 'get',
            url: '<?= base_url('/api/getdataproduct'); ?>' + '/' + productId,
            contentType: "application/json",
            dataType: 'json',
            success: function(result) {
                console.log(result);
                $('#edit-product').empty();
                modalContent = (`
                    <div class="row">
                        <input type="hidden" value="${result.ProductID}" name="product-id">
                        <input type="hidden" value="${result.MainImage}" name="old-product-image">
                        <input type="hidden" value="${result.ProductImageID}" name="product-image-id">
                            <div class="col-md-6 form-group">
                                <label>Product Name</label>
                                <input class="form-control <?= $validation->hasError('edit-product-name') ? 'is-invalid' : ''; ?>" type="text" value="${result.ProductName}" name="edit-product-name">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-product-name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Price</label>
                                <input class="form-control <?= $validation->hasError('edit-price') ? 'is-invalid' : ''; ?>" type="number" value="${result.Price}" name="edit-price">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-price'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                                    <select class="custom-select <?= $validation->hasError('edit-product-category') ? 'is-invalid' : ''; ?>" name="edit-product-category">`);
                $.each(result.DataProductCategory, function(key, value) {
                    modalContent += (`<option value="${value.ProductCategoryID}" ${value.ProductCategoryID == result.ProductCategoryID ? "selected" : ""} >${value.CategoryName}</option>`)
                });
                modalContent += (`</select>
                                    <div class="valid-feedback d-block">
                                        <?= $validation->getError('edit-product-category'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Product Image</label>
                                <div class="custom-control custom-file">
                                    <input type="file" class="custom-file-input <?= $validation->hasError('edit-product-image') ? 'is-invalid' : ''; ?>" id="customFile2" name="edit-product-image" accept="image/*">
                                    <label class="custom-file-label customFile2" for="customFile2">Choose file</label>
                                </div>
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-product-image'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description</label>
                                <textarea class="form-control <?= $validation->hasError('edit-product-description') ? 'is-invalid' : ''; ?>" rows="3" name="edit-product-description">${result.ProductDescription}</textarea>
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-product-description'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Gross Weight (kg)</label>
                                <input class="form-control <?= $validation->hasError('edit-gross-weight') ? 'is-invalid' : ''; ?>" type="number" value="${result.Bruto}" name="edit-gross-weight">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-gross-weight'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nett Weight (kg)</label>
                                <input class="form-control <?= $validation->hasError('edit-nett-weight') ? 'is-invalid' : ''; ?>" type="number" value="${result.Netto}" name="edit-nett-weight">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-nett-weight'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Length (mm)</label>
                                <input class="form-control <?= $validation->hasError('edit-length') ? 'is-invalid' : ''; ?>" type="number" value="${result.ProductLength}" name="edit-length">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-length'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Width (mm)</label>
                                <input class="form-control <?= $validation->hasError('edit-width') ? 'is-invalid' : ''; ?>" type="number" value="${result.ProductWidth}" name="edit-width">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-width'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Height (mm)</label>
                                <input class="form-control <?= $validation->hasError('edit-height') ? 'is-invalid' : ''; ?>" type="number" value="${result.ProductHeight}" name="edit-height">
                                <div class="valid-feedback d-block">
                                    <?= $validation->getError('edit-height'); ?>
                                </div>
                            </div>
                        </div>`)
                $('#edit-product').append(modalContent);
                $('#customFile2').change(function() {
                    const filename = $('#customFile2').val().replace(/.*(\/|\\)/, '');
                    $('.customFile2').text(filename);
                })
            }
        });
    }

    $('#customFile').change(function() {
        const filename = $('#customFile').val().replace(/.*(\/|\\)/, '');
        $('.custom-file-label').text(filename);
    })

    // Untuk Menampilkan Data Pada ChartJS
    const dataProduct = <?= json_encode($dataTotalProductByCategory ?? ''); ?>;
    const labels = [];
    const dataLabel = [];

    dataProduct.forEach(function(value) {
        labels.push(value.CategoryName)
    });

    dataProduct.forEach(function(value) {
        dataLabel.push(value.TotalProduct)
    });

    const data = {
        labels: labels,
        datasets: [{
            label: 'Banyak Produk Berdasarkan Jenis Yang Dijual',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: dataLabel,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
</body>

</html>
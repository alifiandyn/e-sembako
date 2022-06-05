<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description"> -->

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('dist/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('dist/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <?= $this->renderSection('content'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('dist/lib/easing/easing.min.js') ?>"></script>
    <script src="<?= base_url('dist/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <!-- Contact Javascript File -->
    <script src="<?= base_url('dist/mail/jqBootstrapValidation.min.js') ?>"></script>
    <script src="<?= base_url('dist/mail/contact.js') ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('dist/js/main.js') ?>"></script>
    <script>
        // function GetDataCart() {
        //     $.ajax({
        //         type: 'GET',
        //         url: '<?= base_url('/api/cart'); ?>',
        //         contentType: "application/json",
        //         dataType: 'json',
        //         success: function(result) {
        //             $.each(result, function(index, value) {
        //                 $('.cart-contents').append(`<tr>
        //                         <td class="align-middle"><img src="<?= base_url('dist') ?>/img/product-1.jpg" alt="" style="width: 50px;">${result[index].ProductName}</td>
        //                         <td class="align-middle">321312312</td>
        //                         <td class="align-middle">
        //                             <div class="input-group quantity mx-auto" style="width: 100px;">
        //                                 <div class="input-group-btn">
        //                                     <button class="btn btn-sm btn-primary btn-minus">
        //                                         <i class="fa fa-minus"></i>
        //                                     </button>
        //                                 </div>
        //                                 <input type="text" class="form-control form-control-sm bg-secondary text-center" value="${result[index].TotalBuy}" id="total-buy">
        //                                 <div class="input-group-btn">
        //                                     <button class="btn btn-sm btn-primary btn-plus">
        //                                         <i class="fa fa-plus"></i>
        //                                     </button>
        //                                 </div>
        //                             </div>
        //                         </td>
        //                         <td class="align-middle">${result[index].Price * result[index].TotalBuy}</td>
        //                         <td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
        //                     </tr>`);
        //             });
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        // }
        // GetDataCart();

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        const QtyChange = (i, operation) => {
            const getItem = $("#total-buy-" + i);
            const unitPrice = getItem.data("unit-price");
            const cartDetailId = getItem.data("detail-id");
            console.log(cartDetailId)
            const totalPrice = $("#total-price").val();
            let qty;
            if (operation == 'minus') {
                qty = parseInt(getItem.val()) - 1;
            } else if (operation = 'plus') {
                qty = parseInt(getItem.val()) + 1;
            } else {
                qty = getItem.val();
            }
            const totalPriceItem = unitPrice * qty;
            const totalPriceNewest = (totalPrice - unitPrice) + totalPriceItem;
            $("#total-price-" + i).text(rupiah(totalPriceItem));
            $("#total-price-info").text(rupiah(totalPriceNewest));
            $("#total-invoice").text(rupiah(totalPriceNewest + 10000));
            $.ajax({
                type: 'get',
                url: '<?= base_url('api/updateqtyoncart'); ?>',
                contentType: "application/json",
                data: {
                    cartDetailId: cartDetailId,
                    qty: qty
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                }
            });
        }

        const GetDataShippingAddress = () => {
            const ShippingAddressID = $('#selectShippingAddress').val();
            if (ShippingAddressID != 0) {
                $.ajax({
                    type: 'get',
                    url: '<?= base_url('api/getshippingaddress'); ?>',
                    contentType: "application/json",
                    data: {
                        ShippingAddressID
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#first-name-info").val(result.FirstName);
                        $("#last-name-info").val(result.LastName);
                        $("#email-info").val(result.Email);
                        $("#phone-number-info").val(result.PhoneNumber);
                        $("#province-info").val(result.Province);
                        $("#city-info").val(result.City);
                        $("#subdistrict-info").val(result.Subdistrict);
                        $("#ward-info").val(result.Ward);
                        $("#street-info").val(result.Street);
                    }
                });
            } else {
                $("#first-name-info").val(" ");
                $("#last-name-info").val(" ");
                $("#email-info").val(" ");
                $("#phone-number-info").val(" ");
                $("#province-info").val(" ");
                $("#city-info").val(" ");
                $("#subdistrict-info").val(" ");
                $("#ward-info").val(" ");
                $("#street-info").val(" ");
            }
        }

        $(window).on('load', function() {
            $('#modalNotification').modal('show');
        });

        $('#customFile').change(function() {
            const filename = $('#customFile').val().replace(/.*(\/|\\)/, '');
            $('.custom-file-label').text(filename);
        })
    </script>
</body>

</html>
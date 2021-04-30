// -----------------------autoload when refreshing--------------------------

// modal input focus
$("#modal-default").on("shown.bs.modal", function () {
    $("#modal-amount").focus();
});
// modal pay input focus
$("#modal-pay").on("shown.bs.modal", function () {
    $("#cash-pay").focus();
});
$('#modal-default').on('hidden.bs.modal', function () {
    $("#search-box").val("");
    $("#search-box").focus();
    searchBox('');
})
// modal press enter
$("#modal-amount").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
        $("#modal-btn").click();
    }
});

loadPoCart(); //automatic load cart
$('#dtl-date').val(getNowTime());

function addSupplier(val) {
    if (val == "--- Tambah Supplier ---")
        window.location.href = "supplier";
}

// new preorder
if ($('#dtl-trx').html() == 0)
    addNewPo();

function addNewPo() {
    var user_id = $('#dtl-user').val();
    $.ajax({
        type: "POST",
        url: "/preorder/add_new_po",
        data: {
            'user_id': user_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            location.reload();
        }
    });
}

// call modal when product clicked
function callModal(purchase_id, product_id) {
    $("#modal-id").val(purchase_id);
    $("#modal-product-id").val(product_id);
    purchase_transaction_id = $('#purchase-transaction-id').val();

    $.ajax({
        type: "POST",
        url: "/preorder/get_modal_data_po",
        data: {
            'purchase_id': purchase_id,
            'product_id': product_id,
            'purchase_transaction_id': purchase_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
            // return 0;
            var in_stock, full_stock;
            if (data.already_in_cart) {
                $("#modal-name").html(data.product['name']);
                $("#modal-price").val(toNumberFormat(data.product.prices[data.product.prices.length - 1].harga_beli));
                $(".modal-product-head").css('background-image', 'url(' + base_url + data.product['image'] + ')');
                $("#modal-amount").val(data['amount']);
                in_stock = data.product.inventory['in_stock'];
                full_stock = data.product.inventory['full_stock'];
            } else {
                $("#modal-name").html(data['name']);
                $("#modal-price").val(toNumberFormat(data.prices[data.prices.length - 1].harga_beli));
                $(".modal-product-head").css('background-image', 'url(' + base_url + data['image'] + ')');
                $("#modal-amount").val(1);
                in_stock = data.inventory['in_stock'];
                full_stock = data.inventory['full_stock'];
            }
            $("#modal-amount").removeAttr('disabled');
            $("#modal-in-stock").html(in_stock);
            $("#modal-full-stock").html(full_stock);

            // set progress bar color
            var progress_width = Math.floor(in_stock / full_stock * 100);
            $("#modal-progress-bar").css('width', progress_width + '%');
            $("#modal-btn").removeClass("bg-gradient-secondary");
            $("#modal-btn").html("<b>Masukkan Ke Keranjang</b>");

            // set progress bar color
            if (progress_width < 21) {
                $("#modal-progress-bar").css('background-color', bs_color.danger);
                $('#stock-tittle').html('Stock Hampir Habis :');
                $('#stock-bar').css('color', bs_color.danger);
            } else if (progress_width < 41) {
                $("#modal-progress-bar").css('background-color', bs_color.warning);
                $('#stock-tittle').html('Stock Menipis :');
                $('#stock-bar').css('color', bs_color.warning);
            } else {
                $("#modal-progress-bar").css('background-color', bs_color.success);
                $('#stock-tittle').html('Stock Aman :');
                $('#stock-bar').css('color', bs_color.success);
            }
        }
    });
}

function modalInput(val) {
    if (val < 1)
        $("#modal-amount").val(1);
    console.log(val);
}


// add to cart from modal data
function addToPoCart() {
    if ($("#modal-btn").html() == ("<b>Kembali</b>"))
        return false;
    // get data
    var purchase_transaction_id = $('#purchase-transaction-id').val();
    var product_id = $("#modal-product-id").val();
    var product_amount = $("#modal-amount").val();

    $.ajax({
        type: "POST",
        url: "/preorder/add_to_cart_po",
        data: {
            'purchase_transaction_id': purchase_transaction_id,
            'product_id': product_id,
            'product_amount': product_amount,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {

        }
    })
    // reset when close modal close
    loadPoCart();
    $("#search-box").val("");
    $(".search-box")[0].focus();

    // window.scrollTo(0,$('#scrolltohere').scrollHeight);

}

// 'x' button in cart
function deleteBtn(purchase_id) {
    $.ajax({
        type: "POST",
        url: "/preorder/delete_item_po",
        data: {
            'purchase_id': purchase_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {}
    })
    loadPoCart();
}

function searchBox(key) {
    $.ajax({
        type: "GET",
        url: "/preorder/search_box_po",
        data: {
            'name': key,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            product_list = "";
            console.log(data);
            console.log(data.product.length);

            if (data.product.length) { // if product exixst
                data.product.forEach(function (product, index) {
                    $('#product-item').attr('onclick', 'callModal("",' + product.id + ')');
                    $('#product-name').html(product.name);
                    $('#product-price').html('Rp. ' + toNumberFormat(product.prices[product.prices.length - 1].harga_beli));
                    $('#product-in-stock').html(toNumberFormat(product.inventory['in_stock']));
                    $('#product-full-stock').html(toNumberFormat(product.inventory['full_stock']));

                    // set progress bar color
                    var progress_width = Math.floor(product.inventory['in_stock'] / product.inventory['full_stock'] * 100);
                    $("#product-progress-bar").css('width', progress_width + '%');

                    // set progress bar color
                    if (progress_width < 21) {
                        $("#product-progress-bar").css('background-color', bs_color.danger);
                    } else if (progress_width < 41) {
                        $("#product-progress-bar").css('background-color', bs_color.warning);
                    } else {
                        $("#product-progress-bar").css('background-color', bs_color.success);
                    }

                    product_list += $('#hide-product-list').html();
                });
                $('#product-list').html(product_list);
                $('#product-category').html("");
            } else {
                $('#product-list').html("<h4 class='text-danger m-1'>. . . Pencarian Tidak Ditemukan!!</h4>");
            }

            // if barcode was true
            if (data.barcode) {
                $('#product-item').click();
            }
        }
    });
}

function order() {
    //if cart is empty
    if ($('#cart-list').html() == '<p class="text-muted text-center"><b>Keranjang Kosong!!!</b></p>') {
        alert('Keranjang Kosong');
        return 0;
    }
    //confirm delete
    var confirm_order = confirm('Order Sekarang ??');
    if (!confirm_order)
        return 0;

    var purchase_transaction_id = $('#purchase-transaction-id').val();
    var total_price = numbersOnly($('#total-price').html());

    var supplier_id = $('#supplier-input').val();
    supplier_id = supplier_id.split('('); //supplier_id = ['UMUM ', '1000001)']
    supplier_id = supplier_id[1].slice(0, -1); //supplier_id = '1000001'

    $.ajax({
        type: "POST",
        url: "/preorder/order",
        data: {
            'purchase_transaction_id': purchase_transaction_id,
            'supplier_id': supplier_id,
            'total_price': total_price,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            window.location.href = "preorder";
        }
    });


}

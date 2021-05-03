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

var selling_transaction_id = $('.trx-active > .trx > input').val();
// function activateTab(){}
$('.trx-tab').on('click', function () {
    localStorage.tab_index = $(this).closest('.tab-parent').index();

    // toogle activate
    $('.trx-active').removeClass('trx-active');
    $(this).addClass('trx-active');

    // .trx-active set width
    $('#minwidth-18').attr('id', '');
    $(this).closest('.tab-parent').attr('id', 'minwidth-18');

    // get this tab selling_transaction_id
    selling_transaction_id = $('.trx-active > .trx > input').val();
    loadCart();
    $(".search-box")[0].focus();
})

// auto load when reload
// loadProduct();
tabEmpty(); //automatic cek if tab is empty
$('.trx-tab')[localStorage.tab_index].classList.add('trx-active'); // add active to active tab
$('.trx-tab')[localStorage.tab_index].parentNode.id = "minwidth-18"; // set width to active tab
loadCart(); //automatic load cart


// ------------------------------------------ functions ---------------------------------------------
function allFunction() { //note
    // general
    addNewTransaction(); // add a new transaction "tombol '+' di tab, tombol hold"
    payTransaction(); //pay button "tombol bayar"
    addToCart(); // add to this transaction cart "tombol tambahkan ke keranjang"
    callModal(); // call product modal
    modalInput(); // modal input
    callPayModal(); // tombol bayar di keranjang
    filterCategory(); // filter by product category
    searchBox(); // search box
    cashPayInput(); //oninput ketika memasukkan jumlah uang
    deleteBtn(); // delete this item in cart "tombol delete item di cart"
    deleteCart(); // delete this transaction "tombol batal"
    closeTransaction(); // close tab "tombol 'x' di tab"
}

function filterCategory(category_id) {
    $.ajax({
        type: "POST",
        url: "/cashier/filter_category",
        data: {
            'category_id': category_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            // data.forEach(createList);    
        }
    });
}

function searchBox(key) {
    $.ajax({
        type: "GET",
        url: "/cashier/search_box",
        data: {
            'name': key,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            product_list = "";
            data.product.forEach(function (product, index) {
                $('#product-item').attr('onclick', 'callModal("",' + product.product.id + ')');
                $('#product-name').html(product.product.name);
                $('#product-price').html('Rp. ' + toNumberFormat(product.product.prices[product.product.prices.length - 1].harga_jual));
                $("#product-image").attr('src', base_url + product.product.image);

                product_list += $('#hide-product-list').html();
            });
            $('#product-list').html(product_list);
            $('#product-category').html("");

            // if product is empty
            if (!data.product.length) {
                $('#product-list').html("<h4 class='text-danger m-1'>. . . Pencarian Tidak Ditemukan!!</h4>");
            }
            // if barcode was true
            if (data.barcode) {
                $('#product-item').click();
            }
        }
    });
}



// new transaction
function addNewTransaction() {
    localStorage.tab_index = $('.tab-parent').length;
    var user_id = $('#user-id').val();
    $.ajax({
        type: "POST",
        url: "/cashier/add_new_transaction",
        data: {
            'user_id': user_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            location.reload();
        }
    });
}

// Pay transaction
function payTransaction() {
    // if keranjang kosong
    if ($('.cart-list').html() == '<p class="text-muted text-center"><b>Keranjang Kosong!!!</b></p>') {
        alert('keranjang kosong');
        return 0;
    }
    // if uang bayar < total harga
    var cash_pay = parseInt(numbersOnly($('#cash-pay').val()));
    var total_pay = parseInt(numbersOnly($('#total-pay').val()));
    if (cash_pay < total_pay) {
        alert('uang kurang');
        return false;
    } else {
        var selling_transaction_id = $('.trx-active > .trx > input').val();
        var transaction_number = $('#transaction-number').val();

        var member_id = $('#member-input').val(); //member_id = 'UMUM (1000001)'
        member_id = member_id.split('('); //member_id = ['UMUM ', '1000001)']
        member_id = member_id[1].slice(0, -1); //member_id = '1000001'

        var pay_cost = numbersOnly($('#paid-cost').val());
        var total_price = numbersOnly($('#total-pay').val());
        var transaction_date = $('#transaction-date').val();
        $.ajax({
            type: "POST",
            url: "/cashier/pay_transaction",
            data: {
                'selling_transaction_id': selling_transaction_id,
                'transaction_number': transaction_number,
                'member_id': member_id,
                'pay_cost': pay_cost,
                'total_price': total_price,
                'transaction_date': transaction_date,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                location.reload();
            }
        });
    }
}

// add to cart from modal data
function addToCart() {
    if ($("#modal-btn").html() == ("<b>Kembali</b>"))
        return false;
    // get data
    var selling_transaction_id = $('.trx-active > .trx > input').val();
    var product_id = $("#modal-product-id").val();
    var product_amount = $("#modal-amount").val();

    $.ajax({
        type: "POST",
        url: "/cashier/add_to_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            'product_id': product_id,
            'product_amount': product_amount,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {

        }
    })
    // reset when close modal close
    loadCart();
    $("#search-box").val("");
    $(".search-box")[0].focus();

    // window.scrollTo(0,$('#scrolltohere').scrollHeight);

}

// call pay modal
function callPayModal() {
    transaction_number = 'TRX' + Date.now(); // + (Math.floor(Math.random() * 100) + 1);
    selling_transaction_id = $('.trx-active > .trx > input').val();
    $('#transaction-number').val(transaction_number);
    $('#total-pay').val($('#total-price').html());
    $('#transaction-date').val(getNowTime());
}

// call modal when product clicked
function callModal(selling_id, product_id) {
    $("#modal-id").val(selling_id);
    $("#modal-product-id").val(product_id);
    selling_transaction_id = $('.trx-active > .trx > input').val();

    $.ajax({
        type: "POST",
        url: "/cashier/get_modal_data",
        data: {
            'selling_id': selling_id,
            'product_id': product_id,
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
            // return 0;
            var in_stock, full_stock;
            if (data.already_in_cart) {
                $("#modal-name").html(data.product['name']);
                $("#modal-price").val(toNumberFormat(data.product.prices[data.product.prices.length - 1].harga_jual));
                $(".modal-product-head").css('background-image', 'url(' + base_url + data.product['image'] + ')');
                $("#modal-amount").val(data['amount'] + 1);
                in_stock = data.product.inventory['in_stock'];
                full_stock = data.product.inventory['full_stock'];
            } else {
                $("#modal-name").html(data['name']);
                $("#modal-price").val(toNumberFormat(data.prices[data.prices.length - 1].harga_jual));
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

            // if stock kosong
            if (in_stock < 1 && data['amount'] == null) {
                $("#modal-amount").val(0);
                $("#modal-amount").attr('disabled', 'true');
                $('#stock-tittle').html('Stock Habis :');
                $("#modal-btn").addClass("bg-gradient-secondary");
                $("#modal-btn").html("<b>Kembali</b>");
            }

        }
    });
}

function modalInput(val) {
    var max_input = parseInt($("#modal-in-stock").html());
    if (val > max_input)
        $("#modal-amount").val(max_input);
    if (val < 1)
        $("#modal-amount").val(1);
    console.log(val);
}

// 
function cashPayInput() {
    if ($('#cash-pay').val() == '')
        $('#cash-pay').val(0);
    var cash_pay = numbersOnly($('#cash-pay').val());
    var total_pay = numbersOnly($('#total-pay').val());
    $('#cash-pay').val(toNumberFormat(cash_pay));
    var return_cash = cash_pay - total_pay;
    if (return_cash == '')
        return_cash = 0;
    $('#paid-cost').val(toNumberFormat(cash_pay));
    $('#return-cost').val(toNumberFormat(return_cash));
}


// 'x' button in cart
function deleteBtn(selling_id, selling_amount) {
    $.ajax({
        type: "POST",
        url: "/cashier/delete_item",
        data: {
            'selling_id': selling_id,
            'selling_amount': selling_amount,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {}
    })
    loadCart();
}
// batal button
function deleteCart() {
    // if delete the last cart
    if (localStorage.tab_index == ($('.tab-parent').length - 1))
        localStorage.tab_index = localStorage.tab_index - 1;

    selling_transaction_id = $('.trx-active > .trx > input').val();

    //confirm delete
    var confirm_delete = confirm('anda yakin menghapus keranjang ini ??')
    if (!confirm_delete)
        return 0;

    $.ajax({
        type: "GET",
        url: "/cashier/delete_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            location.reload();
        }
    });
}

// close tab
function closeTransaction(selling_transaction_id) {
    // if close the last cart
    if (localStorage.tab_index == ($('.tab-parent').length - 1))
        localStorage.tab_index = localStorage.tab_index - 1;

    var confirm_delete = confirm('anda yakin menghapus keranjang ini ??')
    if (!confirm_delete)
        return 0;

    $.ajax({
        type: "GET",
        url: "/cashier/delete_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            location.reload();
        }
    });
}

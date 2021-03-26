// -----------------------autoload when refreshing--------------------------

// modal input focus
$("#modal-default").on("shown.bs.modal", function () {
    $("#modal-amount").focus();
});
// modal pay input focus
$("#modal-pay").on("shown.bs.modal", function () {
    $("#cash-pay").focus();
});

// modal press enter
$("#modal-amount").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
        // Do something
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
    callPayModal(); // tombol bayar di keranjang
    filterCategory(); // filter by product category
    searchBox(); // search box
    cashPayInput(); //oninput ketika memasukkan jumlah uang
    loadCart(); // load cart of this transaction
    createList(); // load loop
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

var product_list = "";

function searchBox(key) {
    $.ajax({
        type: "GET",
        url: "/cashier/",
        data: {
            'name': key,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            product_list = "";
            data.forEach(createProduct);
            console.log(data, 'key');
            $('#product-list').html(product_list);
        }
    });
}

function createProduct(product, index) {
    $('#product-item').attr('onclick', 'callModal("",' + product.product.id + ')');
    $('#product-name').html(product.product.name);
    $('#product-price').html(product.product.price);

    product_list += $('#hide-product-list').html()
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
        alert('keranjang kosong')
        return 0;
    }
    // if uang bayar < total harga
    var cash_pay = parseInt(numbersOnly($('#cash-pay').val()));
    var total_pay = parseInt(numbersOnly($('#total-pay').val()));
    if (cash_pay < total_pay) {
        alert('uang kurang')
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

// call mmodal when product clicked
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
            if (data.already_in_cart) {
                $("#modal-name").html(data.product['name']);
                $("#modal-price").val(data.product['price']);
                $("#modal-amount").val(data['amount']);
            } else {
                $("#modal-name").html(data['name']);
                $("#modal-price").val(data['price']);
                $("#modal-amount").val(1);
            }
            // $("#modal-btn").attr("onclick", ("addToCart('" + $("#amount").val() + "')"));
        }
    });
}






// 
function cashPayInput() {
    var paid_cost = numbersOnly($('#cash-pay').val());
    $('#cash-pay').val(toNumberFormat(paid_cost));

    var return_cash = numbersOnly($('#cash-pay').val()) - numbersOnly($('#total-pay').val());
    $('#paid-cost').val(toNumberFormat(paid_cost));
    $('#return-cost').val(toNumberFormat(return_cash));
}

// load cart
var total_price = 0;
var list = "";

function loadCart() {
    selling_transaction_id = $('.trx-active > .trx > input').val();
    total_price = 0;
    list = "";
    // ---------------------------------------
    $.ajax({
        type: "POST",
        url: "/cashier/load_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            if (data.length == 0) {
                $(".cart-list")[0].innerHTML = "<p class='text-muted text-center'><b>Keranjang Kosong!!!</b></p>";
                return 0;
            }
            data.forEach(createList);

            $(".cart-list")[0].innerHTML = list;
            $(".total-price")[0].innerHTML = toNumberFormat(total_price);

        }
    });

}
// create list selesai
function createList(selling, index) {
    // passing new data to #cart-item
    $("#set-name").html(selling.product.name);
    $("#set-price").html(toNumberFormat(selling.product.price));
    $("#set-amount").html(toNumberFormat(selling.amount));
    $("#set-total").html(toNumberFormat(selling.product.price * selling.amount));

    $("#close-btn").html('<button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteBtn(' + selling.id + ')">&#10005;</button>');
    $(".cart-hover")[0].setAttribute("onclick", ("callModal('" + selling.id + "','" + selling.product.id + "')"));

    // set new list to .cart-list
    list += $(".hide-list")[0].innerHTML;

    // set value to .total
    total_price = total_price + (selling.product.price * selling.amount);
}

// 'x' button in cart
function deleteBtn(selling_id) {
    $.ajax({
        type: "POST",
        url: "/cashier/delete_item",
        data: {
            'selling_id': selling_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {

        }
    })
    loadCart();
}
// batal button
function deleteCart() {
    // if delete the last cart
    if (localStorage.tab_index == ($('.tab-parent').length - 1))
        localStorage.tab_index = localStorage.tab_index - 1;

    selling_transaction_id = $('.trx-active > .trx > input').val();

    //cek if cart not empty
    // if ($('.cart-list').html() != "")
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

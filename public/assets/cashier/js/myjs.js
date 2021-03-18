// -----------------------autoload when refreshing--------------------------

// modal input focus
$("#modal-default").on("shown.bs.modal", function () {
    $("#modal-amount").focus();
});

// modal press enter
$("#modal-amount").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
        // Do something
        $("#modal-btn").click();
    }
});

// search press enter
$(".search-box").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
        // Do something
    }
});

// tab clik
$('.trx-tab').on('click', function () {
    $('.trx-active').removeClass('trx-active');
    $(this).addClass('trx-active');
})


// auto load first transaction
loadCart();
$('.trx-tab')[localStorage.tab_index].classList.add('trx-active');

// set new transcation
function setSellingTransactionId(id, index) {
    localStorage.selling_transaction_id = id;
    localStorage.tab_index = (index - 1);
    $('.trx-active').removeClass('trx-active');
    $(this).addClass('trx-active');

    loadCart();
}

// new transaction
function addNewTransaction() {
    var user_id = $('#user-id').val();
    $.ajax({
        type: "POST",
        url: "/cashier/add_new_transaction",
        data: {
            'user_id': user_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            localStorage.selling_transaction_id = data;
            localStorage.tab_index = $('.tab-parent').length;
            location.reload();
        }
    });
}

function deleteCart() {
    selling_transaction_id = localStorage.selling_transaction_id;

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
            console.log('susces');
            if (localStorage.tab_index == ($('.tab-parent').length - 1))
                localStorage.tab_index = (localStorage.tab_index - 1);
            location.reload();
        }
    });
}

// menu
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
            console.log('susces');
        }
    });
}

function search_box(key) {
    $.ajax({
        type: "POST",
        url: "/cashier/search_box",
        data: {
            'key': key,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
            // document.location.href = '{{route(cashier/master)}}';
            console.log('susces');
        }
    });
}

function loadCart() {
    var selling_transaction_id = localStorage.selling_transaction_id;
    $(".cart-list")[0].innerHTML = "";
    $(".total-price")[0].innerHTML = "0";
    total_price = 0;
    // ---------------------------------------
    $.ajax({
        type: "POST",
        url: "/cashier/load_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            data.forEach(createList);
        }
    });
}
// create list selesai
var total_price = 0;

function createList(selling, index) {
    console.log(selling.id);
    // passing new data to #cart-item
    $("#set-name").html(selling.product.name);
    $("#set-price").html(new Intl.NumberFormat("id-ID").format(selling.product.price));
    $("#set-amount").html(new Intl.NumberFormat("id-ID").format(selling.amount));
    $("#set-total").html(new Intl.NumberFormat("id-ID").format(selling.product.price * selling.amount));

    $("#close-btn").html('<button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteBtn(' + selling.id + ')">&#10005;</button>');
    $(".cart-hover")[0].setAttribute("onclick", ("callModal('" + selling.id + "','" + selling.product.id + "')"));

    // set new list to .cart-list
    var list = $(".hide-list")[0].innerHTML;
    $(".cart-list")[0].innerHTML += list;

    // set value to .total
    total_price = total_price + (selling.product.price * selling.amount);
    $(".total-price")[0].innerHTML = new Intl.NumberFormat("id-ID").format(total_price);
}

function callModal(selling_id, product_id) {

    $("#modal-id").val(selling_id);
    $("#modal-product-id").val(product_id);
    selling_transaction_id = localStorage.selling_transaction_id;

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

function addToCart() {
    // get data
    var selling_transaction_id = localStorage.selling_transaction_id;
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
            // console.log(data);
        }
    })
    loadCart();

    // reset when close modal close
    $(".search-box")[0].focus();

    // window.scrollTo(0,$('#scrolltohere').scrollHeight);
}

// ----------- selesai
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

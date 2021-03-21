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

var selling_transaction_id = $('.trx-active > .trx > input').val();
// function activateTab(){}
$('.trx-tab').on('click', function () {
    console.log('activateTab()');
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
tabEmpty(); //automatic cek if tab is empty
$('.trx-tab')[localStorage.tab_index].classList.add('trx-active'); // add active to active tab
$('.trx-tab')[localStorage.tab_index].parentNode.id = "minwidth-18"; // set width to active tab
loadCart(); //automatic load cart

function allFunction() { //note
    // general
    tabEmpty(); // if tab is emprty > make a new transaction
    addNewTransaction(); // add a new transaction "tombol '+' di tab, tombol hold"
    pay(); //pay button "tombol bayar"
    filterCategory(); // filter by product category
    searchBox(); // search box
    callModal(); // call product modal
    addToCart(); // add to this transaction cart "tombol tambahkan ke keranjang"
    loadCart(); // load cart of this transaction
    createList(); // load loop
    deleteBtn(); // delete this item in cart "tombol delete item di cart"
    deleteCart(); // delete this transaction "tombol batal"
    closeTab(); // close tab "tombol 'x' di tab"
}

// if tab is emprty > make a new transaction
function tabEmpty() {
    if ($('.tab-parent').html() == null)
        addNewTransaction();
}

// new transaction
function addNewTransaction() {
    console.log('addNewTransaction()');
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

// filter by category
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

function searchBox(key) {
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
            // console.log(data);
        }
    })
    // reset when close modal close
    loadCart();
    $(".search-box")[0].focus();

    // window.scrollTo(0,$('#scrolltohere').scrollHeight);

}

// load cart
function loadCart() {
    console.log('loadCart()');
    selling_transaction_id = $('.trx-active > .trx > input').val();
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
            if (data.length == 0)
                $(".cart-list")[0].innerHTML = "<p class='text-muted text-center'><b>Keranjang Kosong!!!</b></p>";
        }
    });
    $(".cart-item")[($(".cart-item").length) - 1].scrollIntoView();
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

// 'x' button in cart
function deleteBtn(selling_id) {
    console.log('deleteBtn()');
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
            console.log('susces');
            location.reload();
        }
    });
}

// close tab
function closeTab(selling_transaction_id) {
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
            console.log('susces');
            location.reload();
        }
    });
}

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
loadCart();

// ------------------------- Cart functions ---------------------------------
/*CART FUNCTIONS*/

// call modal --selesai
function callModal(selling_id, product_price, product_name) {

    $("#modal-id").val(selling_id);
    $("#modal-name").html(product_name);
    $("#modal-price").val(product_price);

    $.ajax({
        type: "POST",
        url: "/cashier/get_modal_data",
        data: {
            'selling_id': selling_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
            console.log('data apa sih');
            if (data.length == 0) {
                console.log('data tidak ada');
                $("#modal-amount").val(1);
            } else {
                console.log('data tidak ada');
                $("#modal-amount").val(data['amount']);
            }
            // $("#modal-btn").attr("onclick", ("addToCart('" + $("#amount").val() + "')"));
        }
    });
}

// load cart from transaction --selesai
function loadCart() {
    var selling_transaction_id = $("#transaction-id").val();

    $(".cart-list")[0].innerHTML = "";
    // ---------------------------------------
    $.ajax({
        type: "POST",
        url: "/cashier/load_cart",
        data: {
            'selling_transaction_id': selling_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            // console.log(data);
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
    $("#set-price").html(selling.product.price);
    $("#set-amount").html(selling.amount);
    $("#set-total").html(new Intl.NumberFormat("id-ID").format(selling.product.price * selling.amount));

    $("#close-btn").html('<button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteBtn(' + selling.selling_transaction_id + ',' + selling.product.id + ')">&#10005;</button>');
    $(".cart-hover")[0].setAttribute("onclick", ("callModal('" + selling.id + "','" + (selling.amount * selling.product.price) + "','" + selling.product.name + "')"));

    // set new list to .cart-list
    var list = $(".hide-list")[0].innerHTML;
    $(".cart-list")[0].innerHTML += list;

    // set value to .total
    total_price = total_price + selling.product.price * selling.amount;
    $(".total-price")[0].innerHTML = new Intl.NumberFormat("id-ID").format(total_price);

    // console.log(item);
}
// ----------- selesai
function deleteBtn(selling_transaction_id, product_id) {
    $.ajax({
        type: "POST",
        url: "/cashier/delete_item",
        data: {
            'selling_transaction_id': selling_transaction_id,
            'product_id': product_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {

        }
    })
    loadCart();
}


// ------------------------------------------ belum selesai --------------------------------
function addToCart() {
    // get modal input amount
    product_amount = $("#modal-amount").val();

    transaction_id = $("#transaction-id").val();
    product_id = $("#modal-id").val();

    console.log(product_amount);
    console.log(product_id);
    console.log(transaction_id);

    $.ajax({
        type: "POST",
        url: "/cashier/add_to_cart",
        data: {
            'transaction_id': transaction_id,
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

function deleteAllCart() {
    localStorage.clear();
    location.reload();
}

function read_transaction() {
    $.ajax({
        type: "POST",
        url: "/cashier/read_transaction",
        data: {
            'id': 1,
            '_token': $('input[name=_token]').val()
        },
        success: function (data) {
            console.log(data);
        }
    })
}

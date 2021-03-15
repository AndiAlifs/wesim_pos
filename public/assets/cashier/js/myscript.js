// -----------------------autoload when refreshing--------------------------
// modal input focus
$("#modal-default").on("shown.bs.modal", function () {
    $("#amount").focus();
});
// modal press enter
$(".amount").on("keyup", function (e) {
    if (e.key === "Enter" || e.keyCode === 13) {
        // Do something
        document.getElementById("modalbtn").click();
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
function callModal(product_id, product_price, product_name) {

    $(".product_id")[0].value = product_id;
    $(".product_name")[0].innerHTML = product_name;
    $(".product_price")[0].value = product_price;

    // focus to modal amount input
    $(".amount")[0].focus();

    $.ajax({
        type: "POST",
        url: "/cashier/get_modal_data",
        data: {
            'transaction_number': 'TRX16158201380002',
            'product_id': product_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
            if (data.length == 0)
                $("#amount").val(1);
            else
                $("#amount").val(data[0].amount);
        }
    });
}

// load cart from transaction --selesai
function loadCart() {
    var selling_transaction_id = $(".trx-id").val();
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
            console.log(data);
            data.forEach(createList);
        }
    });
}

// create list selesai
var total_price = 0;

function createList(item, index) {
    // passing new data to #cart-item
    $("#set-name").html(item.product.name);
    $("#set-price").html(item.product.price);
    $("#set-amount").html(item.amount);
    $("#set-total").html(new Intl.NumberFormat("id-ID").format(item.product.price * item.amount));

    $("#close-btn").html('<button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2" onclick="deleteBtn(' + item.selling_transaction_id + ',' + item.product.id + ')">&#10005;</button>');
    $("#cart-hover").attr("onclick", ("callModal('" + item.product_id + "','" + (item.amount * item.product.price) + "','" + item.product.name + "')"));

    // set new list to .cart-list
    var list = $(".hide-list")[0].innerHTML;
    $(".cart-list")[0].innerHTML += list;

    // set value to .total
    total_price = total_price + item.product.price * item.amount;
    $(".total-price")[0].innerHTML = new Intl.NumberFormat("id-ID").format(total_price);

    console.log(item);
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

function addToCart() {
    // get modal input amount
    // product.transaction_id = $('.trx-number')[0].innerHTML;
    // product.amount = $(".amount")[0].value;
    console.log(product);

    $.ajax({
        type: "POST",
        url: "/cashier/add_to_hold",
        data: {
            'product': product,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            console.log(data);
        }
    })
    loadCart();

    // reset when close modal close
    $(".search-box")[0].focus();

    // window.scrollTo(0,$('#scrolltohere').scrollHeight);
}

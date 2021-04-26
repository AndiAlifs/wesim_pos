// global variabel -------------------
var base_url = 'http://localhost:8000/';
var bs_color = {
    primary: '#007bff',
    success: '#28a745',
    warning: '#ffc107',
    danger: '#dc3545',
};
var total_price = 0;
var list = "";
var product_list = "";
var product_id = "";
// end global variabel ----------------

// delay modal call so it has time to load to the modal -----
$('[data-toggle=modal]').on('click', function (e) {
    var $target = $($(this).data('target'));
    $target.data('triggered', true);
    setTimeout(function () {
        if ($target.data('triggered')) {
            $target.modal('show')
                .data('triggered', false); // prevents multiple clicks from reopening
        };
    }, 200); // milliseconds
    return false;
});
// -----------------------------------------------------------

// if tab is empty > make a new transaction
function tabEmpty() {
    if (!$('.tab-parent')[0]) //if .tab-parent doesnt exists
        addNewTransaction();
}

// number format
function toNumberFormat(val) {
    return new Intl.NumberFormat("id-ID").format(val)
}

// get numbersonly
function numbersOnly(val) {
    val = val.match((/\d/g));
    val = val.join("");
    return val;
}

function getNowTime() {

    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var dd = String(today.getDate()).padStart(2, '0');
    var hh = String(today.getHours()).padStart(2, '0');
    var ii = String(today.getMinutes()).padStart(2, '0');
    var nowTime = yyyy + '-' + mm + '-' + dd + 'T' + hh + ':' + ii;

    return nowTime;
}

function loadPoCart() {
    var purchase_transaction_id = $('#purchase-transaction-id').val();
    var total_price = 0;
    var list = "";
    // ---------------------------------------
    $.ajax({
        type: "POST",
        url: "/preorder/load_cart_po",
        data: {
            'purchase_transaction_id': purchase_transaction_id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            if (data.length == 0) {
                $("#cart-list").html("<p class='text-muted text-center'><b>Keranjang Kosong!!!</b></p>");
                $("#total-price").html(0);
                return 0;
            }
            data.forEach(function (purchase, index) {
                // passing new data to #cart-item
                console.log(purchase);
                $("#set-name").html(purchase.product.name);
                $("#set-price").html(toNumberFormat(purchase.product.prices[purchase.product.prices.length - 1].harga_beli));
                $("#set-amount").html(toNumberFormat(purchase.amount));
                $("#set-total").html(toNumberFormat(purchase.product.prices[purchase.product.prices.length - 1].harga_beli * purchase.amount));

                $("#close-btn").html('<button type="button" class="btn bg-gradient-danger btn-xs float-right mr-2 px-2" onclick="deleteBtn(' + purchase.id + ')"><i class="nav-icon fas fa-trash"></i></button>');
                $("#list-item")[0].setAttribute("onclick", ("callModal('" + purchase.id + "','" + purchase.product.id + "')"));

                // set new list to .cart-list
                list += $(".hide-list")[0].innerHTML;

                // set value to .total
                total_price = total_price + (purchase.product.prices[purchase.product.prices.length - 1].harga_beli * purchase.amount);
            });

            $("#cart-list").html(list);
            $("#total-price").html(toNumberFormat(total_price));
        }
    });

}

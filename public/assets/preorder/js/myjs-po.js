$('#dtl-date').val(getNowTime());

function poEmpty() {
    if (!$('#dtl-trx')) {
        var user_id = $('#user-id').val();
        $.ajax({
            type: "POST",
            url: "/preorder/add_new_po_cart",
            data: {
                'user_id': user_id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                location.reload();
            }
        });

    }
}

function addSupplier(val) {
    if (val == "--- Tambah Supplier ---")
        window.location.href = "supplier";
}

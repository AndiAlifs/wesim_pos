// function activateTab(){}
$('.list-item').on('click', function () {
    // toogle activate
    $('.list-active').removeClass('list-active');
    $(this).addClass('list-active');
})

function detailTransaction(id) {
    $(this).addClass('list-active');
    $.ajax({
        type: "GET",
        url: "/cashier/detail_transaction",
        data: {
            'id': id,
            '_token': $('input[name=_token]').val(),
        },
        success: function (data) {
            $('#dtl-trx').html(data.sellingTransaction.transaction_number);
            $('#dtl-date').html(data.sellingTransaction.updated_at);
            $('#dtl-member').html(data.sellingTransaction.member.name + '(' + data.sellingTransaction.member.member_id + ')');
            var row = '';
            var trx_total_price = 0;
            data.selling.forEach(function (selling, index) {
                row += '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + selling.product.name + '</td>' +
                    '<td>' + toNumberFormat(selling.amount) + '</td>' +
                    '<td>Rp. ' + toNumberFormat(selling.product.price) + '</td>' +
                    '<td>' + selling.discount_percent + '</td>' +
                    '<td>Rp. ' + toNumberFormat(selling.price) + '</td>' +
                    '</tr>';
            });
            $('#table-detail-transaction tbody').html(row);
            $('#total-price').html(toNumberFormat(data.sellingTransaction.total_price));
        }
    });
}

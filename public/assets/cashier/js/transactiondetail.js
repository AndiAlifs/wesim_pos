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
            var selling_list = '';
            data.selling.forEach(function (selling, index) {
                selling_list += '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + selling.product.name + '</td>' +
                    '<td>' + toNumberFormat(selling.amount) + '</td>' +
                    '<td>Rp. ' + toNumberFormat(selling.product.prices[selling.product.prices.length - 1].harga_jual) + '</td>' +
                    '<td>' + selling.discount_percent + '</td>' +
                    '<td>Rp. ' + toNumberFormat(selling.price) + '</td>' +
                    '</tr>';
            });
            $('#table-detail-transaction tbody').html(selling_list);
            $('#total-price').html(toNumberFormat(data.sellingTransaction.total_price));
        }
    });
}

function printArea(element) {
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = element.html();
    window.print();
    document.body.innerHTML = originalContents;
}

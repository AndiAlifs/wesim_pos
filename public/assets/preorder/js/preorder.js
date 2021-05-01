function setTotalPO(val, i, j) {

    if (val < 0) {
        $('#amount' + i + j + '').val(0);
        return 0;
    }

    var total = numbersOnly($('#total-po' + i + '').html());
    var subTotal = numbersOnly($('#subtotal-harga' + i + j + '').html());
    total = parseInt(total) - parseInt(subTotal);
    $('#subtotal-harga' + i + j + '').html(toNumberFormat(val * $('#harga-beli' + i + j + '').val()));
    subTotal = numbersOnly($('#subtotal-harga' + i + j + '').html());
    total = parseInt(total) + parseInt(subTotal);
    $('#total-po' + i).html(toNumberFormat(total));
}

function setTotalPO2(val, i, j) {

    if (val < 0) {
        $('#harga-beli' + i + j + '').val(0);
        return 0;
    }

    var total = numbersOnly($('#total-po' + i + '').html());
    var subTotal = numbersOnly($('#subtotal-harga' + i + j + '').html());

    total = parseInt(total) - parseInt(subTotal);
    $('#subtotal-harga' + i + j + '').html(toNumberFormat(val * $('#amount' + i + j + '').val()));
    subTotal = numbersOnly($('#subtotal-harga' + i + j + '').html());
    total = parseInt(total) + parseInt(subTotal);
    $('#total-po' + i + j + '').html(toNumberFormat(total));

    //set harga jual base on harga beli input
    $('#harga-jual' + i + j + '').val(parseInt(val) + (parseInt($('#profit' + i + j + '').val()) * val / 100));
}

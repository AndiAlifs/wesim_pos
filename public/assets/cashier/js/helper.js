// if tab is emprty > make a new transaction
function tabEmpty() {
    if ($('.tab-parent').html() == null)
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

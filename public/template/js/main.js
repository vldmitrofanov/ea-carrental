function processing() {
    $.blockUI({message: '<h1><img src="../../../images/processing.gif" /></h1>',
        css: {
            width: '750px',
            top: '15%',
            left: '25%',
            backgroundColor: 'none',
            border: 'none'
        }});
}

function displayMessageAlert(message, type='success', sign='ok'){
    $.notify({
        icon: 'glyphicon glyphicon-'+sign,
        message:message
    },{type: type,allow_dismiss: false,placement: {align: 'right',from: 'bottom'}});
}

function pageRefresh() {
    setTimeout(window.location.href = window.location, 8000);
}

function redirectPage(url) {
    setTimeout(window.location.href = url, 8000);
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
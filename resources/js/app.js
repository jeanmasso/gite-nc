require('./bootstrap');

let token = $('meta[name=api-token]').attr('content');

jQuery.ajaxSetup({
    dataType: JSON,
    headers: {'Authorization': 'Bearer ' + token},
});
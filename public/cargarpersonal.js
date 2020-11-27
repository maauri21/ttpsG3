$('#tipo').change(function(){
    if(($(this).val() == "administrador") || ($(this).val() == "configurador")) {
        $('#legajo').hide();
        $('#sistema').hide();
    } else {
        $('#legajo').show();
        $('#sistema').show();
    }
}); 
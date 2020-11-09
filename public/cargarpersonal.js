$('#tipo').change(function(){
    if($(this).val() == "administrador") {
        $('#legajo').hide();
        $('#sistema').hide();
    } else {
        $('#legajo').show();
        $('#sistema').show();
    }
}); 
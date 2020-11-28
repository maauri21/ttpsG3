$('#tipo').change(function(){
    if(($(this).val() == "administrador") || ($(this).val() == "configurador")) {
        $('#legajo').hide();
        $('#sistema').hide();
    } else {
        $('#legajo').show();
        $('#sistema').show();
    }
}); 

window.onload = () => {
    var tipo=(document.getElementById('tipo').value);
    if ((tipo == 'administrador') || (tipo == 'configurador')) {
        $('#legajo').hide();
        $('#sistema').hide();
    }
};

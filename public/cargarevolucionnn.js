$('#o2suplementario').change(function(){
    var x=$("#o2suplementario").is(":checked");
    if(x) {
        $('#canulanasal').show();
        $('#mascarares').show();
    } else {
        $('#canulanasal').hide();
        $('#mascarares').hide();
    }
}); 

$('#pafi').change(function(){
    var x=$("#pafi").is(":checked");
    if(x) {
        $('#valorpafi').show();
    } else {
        $('#valorpafi').hide();
    }
}); 

$('#rxtx').change(function(){
    var x=$("#rxtx").is(":checked");
    if(x) {
        $('#tiporxtx').show();
    } else {
        $('#tiporxtx').hide();
    }
}); 

$('#tiporxtx').change(function(){
    if($(this).val() == "normal") {
        $('#descripcionrx').hide();
    } else {
        $('#descripcionrx').show();
    }
}); 

$('#tactorax').change(function(){
    var x=$("#tactorax").is(":checked");
    if(x) {
        $('#tipotactorax').show();
    } else {
        $('#tipotactorax').hide();
    }
}); 

$('#tipotactorax').change(function(){
    if($(this).val() == "normal") {
        $('#descripciontactorax').hide();
    } else {
        $('#descripciontactorax').show();
    }
}); 

$('#ecg').change(function(){
    var x=$("#ecg").is(":checked");
    if(x) {
        $('#tipoecg').show();
    } else {
        $('#tipoecg').hide();
    }
}); 

$('#tipoecg').change(function(){
    if($(this).val() == "normal") {
        $('#descripcionecg').hide();
    } else {
        $('#descripcionecg').show();
    }
}); 

$('#pcr').change(function(){
    var x=$("#pcr").is(":checked");
    if(x) {
        $('#tipopcr').show();
    } else {
        $('#tipopcr').hide();
    }
}); 

$('#tipopcr').change(function(){
    if($(this).val() == "normal") {
        $('#descripcionpcr').hide();
    } else {
        $('#descripcionpcr').show();
    }
}); 

$('#laboratorio').change(function(){
    var x=$("#laboratorio").is(":checked");
    if(x) {
        $('#hto').show();
    } else {
        $('#hto').hide();
    }
}); 
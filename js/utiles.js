var timestamp = get_hour_number();

var ResultData = {};

function get_value(purl, pparameters) {
    var valor = 'N/A_';
    
    //var v = show_as_modal_dialog("<img src='./images/loader.gif'> Espere",'...');

    $.ajax({
        url: base_url + 'index.php/' + purl,
        type: 'POST',
        data: pparameters,
        async: false,
        cache: false,
        dataType: 'text',
        timeout: 30000,
        error: function(a, b) {
            valor = b;
        },
        success: function(msg) {
            valor = msg;
        }
    });
    
    //close_dialog(v); 

    document.body.style.cursor="wait";
    setTimeout(function(){
        document.body.style.cursor="default";
    },400);
    return valor;
}

function get_object(purl, pparameters) {
    var t = get_value(purl, pparameters);
    var j = eval('(' + t + ')');
    return j;
}

function redirect_to(purl) {
    setTimeout(function() {
        window.location.href = base_url + 'index.php/' + purl;
    },
    0);
}

function open_in_new(purl){
    window.open(base_url + 'index.php/' + purl,"_new");
}

function trim(inputString) {
    return $.trim(inputString);
}

function close_dialog(d) {
    d.dialog('close');
}

function show_as_modal_dialog(t, tit, callb){
    var l =  "<div>"+t+"</div>";
    var d = $(l).dialog({
        autoOpen: false,
        dialogClass: "dialogwindow",
        closeOnEscape: false,
        minHeight: 50,
        title: tit,
        modal: true,
        buttons: {},
        resizable: false,
        open: function() {
            $('body').css('overflow','hidden');
        },
        close: function() {
            $('body').css('overflow','auto');
            if (callb) {
                callb();
            }
        }
    }); 
    d.dialog('open');
    return d; 
}

function get_hour_number(){
    return (new Date().getTime());
}

jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}
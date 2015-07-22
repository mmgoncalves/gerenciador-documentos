function datapicker(){
    $('#datetimepicker2').datetimepicker({
        sideBySide: true,
        //format:"DD/MM/YYYY H:mm:ss",
        locale:"pt-br"
    });
}

function toggleMenu(){
    $('#accordion').find('.accordion-header').click(function(){

        $(".accordion-content").not($(this).next()).slideUp('fast');
        $(this).next().slideToggle('fast');

    });
}
function chamaEditor(){
    tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

        // Theme options
        theme_advanced_buttons1 : "|bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect, |, bullist,numlist, preview, hr, | , fullscreen",
        theme_advanced_buttons2 : "tablecontrols, |, print",

        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        // Style formats
        style_formats : [
            {title : 'Bold text', inline : 'b'},
            {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
            {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
            {title : 'Example 1', inline : 'span', classes : 'example1'},
            {title : 'Example 2', inline : 'span', classes : 'example2'},
            {title : 'Table styles'},
            {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
        ],

        formats : {
            alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
            aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
            alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
            alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
            bold : {inline : 'span', 'classes' : 'bold'},
            italic : {inline : 'span', 'classes' : 'italic'},
            underline : {inline : 'span', 'classes' : 'underline', exact : true},
            strikethrough : {inline : 'del'}
        },

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        },
        height : "500px",
        width : "100%"
    });
}

// <![CDATA[
jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    //Inicio Mascara Telefone
    $('input[type=tel]').mask("(99) 9999-9999?9").ready(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone =  target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    //Inicio Mascara CEP
    $('input[type=cep]').mask("99999-999").ready(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 8) {
            element.mask("99999-999");
        } else {
            element.mask("99999-999");
        }
    });

    //Inicio Mascara CPF
    $('input[type=cpf]').mask("999.999.999-99").ready(function(event){
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 11){
            element.mask("999.999.999-99");
        }else{
            element.mask("999.999.999-99");
        }
    });

    //Inicio Mascara CNPJ
    $('input[type=cnpj]').mask("99.999.999/9999-99").ready(function(event){
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 14){
            element.mask("99.999.999/9999-99");
        }else{
            element.mask("99.999.999/9999-99");
        }
    });

    //Inicio Mascara HORARIO
    $('input[type=hora]').mask("99:99").ready(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 4) {
            element.mask("99:99");
        } else {
            element.mask("99:99");
        }
    });



});
// ]]>
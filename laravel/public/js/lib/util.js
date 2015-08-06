function datapicker(){
    $('#datetimepicker2').datetimepicker({
        sideBySide: true,
        locale:"pt-br"
    });
}

function toggleMenu(){
    $('#accordion').find('.accordion-header').click(function(){
        $(".accordion-content").not($(this).next()).slideUp('fast');
        $(this).next().slideToggle('fast');
    });
}
function toggleMenu2(box){
    $(".accordion-content").slideUp('fast');
    $(box).slideToggle('fast');
}

function chamaEditor(){
    $.cleditor.defaultOptions.height = 500;
    $("#inpConteudo").cleditor();
}

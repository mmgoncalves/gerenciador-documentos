function datapicker(){
    $('#datetimepicker2').datetimepicker({
        sideBySide: true,
        locale:"pt-br"
    });

    $('#datetimepicker').datetimepicker({
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


function apenasNumero(s){
    if(s != undefined){
        return s.replace(/[^0-9]+/g,'');
    }
}

//Verifica se CPF é válido
function ValidarCPF(cpf) {
    var strCPF = cpf.replace('.','').replace('.','').replace('-','');
    var Soma;
    var Resto;
    Soma = 0;
    //strCPF  = RetiraCaracteresInvalidos(strCPF,11);
    if (strCPF == "00000000000")
        return false;
    for (i=1; i<=9; i++)
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) )
        return false;
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) )
        return false;
    return true;
}

function mostraCalendario(){
    $("#datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        showAnim: 'drop',
        autoSize: true,
        dayNames: [ "Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado" ],
        dayNamesMin: [ "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb" ],
        maxDate: "+1y",
        minDate: "0",
        monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        monthNamesShort: [ "Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez" ],
        onSelect: function(data, obj){
            verificaDiasDisponiveis(obj);
        },
        onClose: function(){
            validaData();
        }
    });
}
function toggleMenu(){
    $('#accordion').find('.accordion-header').click(function(){
        var passo = $(this).attr('data-step');

        switch (passo){
            case 'passo1':
                break;
            case 'passo2':
                break;
            case 'passo3':
                break;
            case 'passo4':
                break;
            case 'passo5':
                break;
        }

        $(".accordion-content").not($(this).next()).slideUp('fast');
        $(this).next().slideToggle('fast');

    });
}
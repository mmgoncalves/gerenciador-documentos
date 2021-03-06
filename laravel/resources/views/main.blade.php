<!DOCTYPE html>
<html>
    <head>
        <title>Gerenciamento de documentos</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">

        <!-- ANGULAR -->
        <script src="js/angular/angular-1.3.min.js" type="text/javascript"></script>
        <script src="js/angular/angular-route.min.js" type="text/javascript"></script>
        <script src="js/lib/dirPagination.js" type="text/javascript"></script>

        <!-- JQUERY BOOTSTRAP -->
        <script src="js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript"> CONSTTK = "{{ csrf_token() }}";</script>

        <script src="js/main-app.js" type="text/javascript"></script>
        <script src="js/controller/main-controller.js" type="text/javascript"></script>
        <script src="js/service/services.js" type="text/javascript"></script>
        <script src="js/directive/directive.js" type="text/javascript"></script>
        <script src="js/lib/util.js" type="text/javascript"></script>

        <!-- BOOTSTRAP DATEPICKER -->
        <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="/bower_components/moment/locale/pt-br.js"></script>
        <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    </head>
    <body ng-app="App">

        <!-- TOPO -->
        <section class="bg-primary col-md-12">
            <div class="mainTopo">
                <div class="col-md-8">
                    <h1>{{ $config->nome }}</h1>
                </div>

                <img class="pull-right img-thumbnail" width="106px" src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfa1/v/t1.0-1/p160x160/250036_10151163421672838_2055278144_n.png?oh=e6cd466643322cd09624b404a250712d&oe=567AE4E6&__gda__=1447192620_d673fd8afcc9c18cdab6d02b8e080d18" />
            </div>
        </section>

        <!-- CONTEUDO -->
        <div ng-view></div>

        <!-- TABELA DE ARQUIVOS -->
        <section class="col-md-12">
            <div class="panel-footer navbar-fixed-bottom">
                <div class="col-md-1"></div>

                <div class="col-md-2">
                    <p>{{ $config->endereco }}</p>
                    <p>{{ $config->numero }}</p>
                    <p>{{ $config->bairro }}</p>
                </div>
                <div class="col-md-2">
                    <p>{{ $config->cep }}</p>
                    <p>{{ $config->cnpj }}</p>
                </div>

                <div class="col-md-5">

                </div>
            </div>
        </section>

        <!-- RODAPE -->
    </body>
</html>

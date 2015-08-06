<!DOCTYPE html>
<html>
    <head>
        <title></title>

        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">

        <!-- ANGULAR -->
        <script src="js/angular/angular-1.3.min.js" type="text/javascript"></script>
        <script src="js/angular/angular-route.min.js" type="text/javascript"></script>
        <script src="js/lib/loading-bar.js" type="text/javascript"></script>
        <script src="js/lib/dirPagination.js" type="text/javascript"></script>

        <!-- JQUERY BOOTSTRAP -->
        <script src="js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap/ui-bootstrap-tpls-0.6.js" type="text/javascript"></script>
        <script src="js/lib/dialogs.js" type="text/javascript"></script>

        <!-- MASKED INPUT -->
        <script src="js/jquery/jquery.maskedinput-1.3.1.min.js" type="text/javascript"></script>

        <script type="text/javascript"> CONSTTK = "{{ csrf_token() }}";  CONSTTK_US = { "idAdm": {{ $adm->idAdm  }}, "nome":"{{ $adm->nome }}", "ultimo_acesso": "{{ $adm->ultimo_acesso }}" }</script>

        <script src="js/app.js" type="text/javascript"></script>
        <script src="js/controller/controller.js" type="text/javascript"></script>
        <script src="js/service/services.js" type="text/javascript"></script>
        <script src="js/directive/directive.js" type="text/javascript"></script>
        <script src="js/lib/util.js" type="text/javascript"></script>


        <!-- CLEditor EDITOR HTML -->
        <link href="js/CLEditor/jquery.cleditor.css" rel="stylesheet" type="text/css">
        <script src="js/CLEditor/jquery.cleditor.min.js" type="text/javascript"></script>

        <!-- BOOTSTRAP DATEPICKER -->
        <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="/bower_components/moment/locale/pt-br.js"></script>
        <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    </head>
    <body ng-app="App">
        <menu-principal></menu-principal>
        <div ng-view></div>
    </body>
</html>

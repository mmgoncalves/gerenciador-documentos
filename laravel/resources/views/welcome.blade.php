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
        <script src="js/angular.min.js" type="text/javascript"></script>
        <script src="js/angular-route.min.js" type="text/javascript"></script>
        <script src="js/loading-bar.js" type="text/javascript"></script>

        <!-- JQUERY BOOTSTRAP -->
        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <!-- MASKED INPUT -->
        <script src="js/jquery.maskedinput-1.3.1.min.js" type="text/javascript"></script>

        <script type="text/javascript">var CONSTTK = "{{ csrf_token() }}";</script>

        <script src="js/app.js" type="text/javascript"></script>
        <script src="js/controller.js" type="text/javascript"></script>
        <script src="js/services.js" type="text/javascript"></script>
        <script src="js/directive.js" type="text/javascript"></script>
        <script src="js/util.js" type="text/javascript"></script>


        <!-- TINY_MCE EDITOR -->
        <script src="js/tiny_mce/tiny_mce.js" type="text/javascript"></script>

        <!-- BOOTSTRAP DATEPICKER -->
        <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="/bower_components/moment/locale/pt-br.js"></script>
        <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />



    </head>
    <body ng-app="App">
        <div ng-view></div>
    </body>
</html>

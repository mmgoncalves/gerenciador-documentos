<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/style.css" rel="stylesheet" type="text/css">

    <!-- ANGULAR -->
    <script src="../js/angular/angular-1.3.min.js" type="text/javascript"></script>
    <script src="../js/angular/angular-route.min.js" type="text/javascript"></script>

    <!-- JQUERY BOOTSTRAP -->
    <script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">var CONSTTK = "{{ csrf_token() }}"; {{ isset($error) ? 'var ERROR = true;' : 'var ERROR = false;' }}</script>
    <script src="../js/app-login.js" type="text/javascript"></script>
    <script src="../js/controller/loginController.js" type="text/javascript"></script>
    <script src="../js/lib/util.js" type="text/javascript"></script>


</head>
<body ng-app="AppLogin">
    <div ng-view></div>
</body>
</html>


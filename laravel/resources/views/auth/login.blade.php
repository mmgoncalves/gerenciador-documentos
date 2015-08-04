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
    <script src="js/angular-1.3.min.js" type="text/javascript"></script>
    <script src="js/angular-route.min.js" type="text/javascript"></script>
    <script src="js/loading-bar.js" type="text/javascript"></script>

    <!-- JQUERY BOOTSTRAP -->
    <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>


    <script src="js/app.js" type="text/javascript"></script>
    <script src="js/controller.js" type="text/javascript"></script>


</head>
<body ng-app="App">

<div>
    <form method="POST" action="/adm/auth">
        {!! csrf_field() !!}

        <div>
            CPF
            <input type="text" name="cpf" value="">
        </div>

        <div>
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>


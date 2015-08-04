var Mod = angular.module('AppLogin', ['ngRoute'])
    .config(['$routeProvider', function($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl : '../templates/login.html',
                controller: 'LoginController'
            })
            // caso não seja nenhum desses, redirecione para a rota '/'
            .otherwise ({ redirectTo: '/' });
    }]);

Mod.constant("CSRF_TOKEN", CONSTTK);

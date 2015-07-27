var Mod = angular.module('App', ['ngRoute', 'angular-loading-bar'])
.config(['$routeProvider', '$locationProvider', function($routeProvider) {
    // remove o # da url
   //$locationProvider.html5Mode(true);
 
   $routeProvider
    .when('/', {
      templateUrl : 'templates/home.html'
   })

   .when('/adm', {
       templateUrl : 'templates/adm.html',
       controller: 'AdministradorController'
   })

   .when('/categorias', {
       templateUrl : 'templates/categorias.html'
   })
   .when('/config', {
       templateUrl : 'templates/config.html'
   })
   .when('/sair', {
       controller:function(){
           alert('teste');
       }
   })

   // caso não seja nenhum desses, redirecione para a rota '/'
   .otherwise ({ redirectTo: '/' });
}]);

Mod.constant("CSRF_TOKEN", CONSTTK);
Mod.run(['$http', 'CSRF_TOKEN', function($http, CSRF_TOKEN) {
    $http.defaults.headers.common['X-Csrf-Token'] = CSRF_TOKEN;
}]);
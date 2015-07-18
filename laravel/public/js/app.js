var Mod = angular.module('App', ['ngRoute'])
.config(['$routeProvider', '$locationProvider', function($routeProvider) {
    // remove o # da url
   //$locationProvider.html5Mode(true);
 
   $routeProvider
    .when('/', {
      templateUrl : 'templates/home.html'
   })

   // caso não seja nenhum desses, redirecione para a rota '/'
   .otherwise ({ redirectTo: '/' });
    
}]);
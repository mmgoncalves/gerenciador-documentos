var Mod = angular.module('App', ['ngRoute', 'angular-loading-bar', 'ui.bootstrap', 'dialogs'])
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
       templateUrl : 'templates/categorias.html',
       controller: 'CategoriaController'
   })
   .when('/config', {
       templateUrl : 'templates/config.html',
       controller: 'ConfigController'
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
}])

.run(['$templateCache',function($templateCache){
    $templateCache.put('/dialogs/whatsyourname.html','<div class="modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> User\'s Name</h4></div><div class="modal-body"><ng-form name="nameDialog" novalidate role="form"><div class="form-group input-group-lg" ng-class="{true: \'has-error\'}[nameDialog.username.$dirty && nameDialog.username.$invalid]"><label class="control-label" for="username">Name:</label><input type="text" class="form-control" name="username" id="username" ng-model="user.name" ng-keyup="hitEnter($event)" required><span class="help-block">Enter your full name, first &amp; last.</span></div></ng-form></div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button><button type="button" class="btn btn-primary" ng-click="save()" ng-disabled="(nameDialog.$dirty && nameDialog.$invalid) || nameDialog.$pristine">Save</button></div></div></div></div>');
}]);
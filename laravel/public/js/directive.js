Mod.directive('menuPrincipal', function(){
    return{
        restrict: 'E',
        link: function($scope){
           $scope.menuClick = function(selected){
               $scope.menuActive = selected;
           };
        },
        replace: true,
        templateUrl: 'directives/menu.html'
    };
});
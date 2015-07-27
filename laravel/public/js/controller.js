function TopoCtrl(){

}

function HomeController(){
    var Ctrl = this;

    toggleMenu();
    datapicker();
    chamaEditor();
}

function CategoriaController(){
    var Ctrl = this;

    Ctrl.buscaPorCategoria = function () {

    };

    Ctrl.addCategoria = function () {

    };

    Ctrl.addSubCategoria = function () {

    };

    toggleMenu();
}


function AdministradorController($scope, Request, validaFormAdm){
    $scope.hasSuccess = false;
    $scope.search = "";
    $scope.add = {};

    $scope.listaAdm = function(){
        $scope.erroSearch = false;
        Request.get_request('admSearch', {busca:$scope.search}, 'POST')
            .success(function(data, status){
                if(status == 201){
                    $scope.list = data;
                }else{
                    $scope.erroSearch = data.erroMsg;
                    $scope.list = false;
                }
            });

    };

    $scope.addAdm = function () {
        var values = {nome:$scope.add.nome, login:$scope.add.login, senha:$scope.add.senha, reSenha:$scope.add.reSenha};

        if($scope.validaForm(values)){
            Request.get_request("admAdd", values, "POST")
                .success(function(data, status){
                    if(status == 201){
                        $scope.hasError = false;
                        $scope.hasSuccess = true;
                        $scope.add = {};
                    }else{
                        $scope.erro = [{erro:data.erroMsg}];
                        $scope.hasError = true;
                    }
                });
        }
    };

    $scope.excluir = function($index){
        var values = {id:$scope.list[$index].idAdm};

        Request.get_request("admDelete", values, "GET")
            .success(function (data, status) {
                if(status == 201){
                    $scope.list.splice($index, 1);
                }
            });
    };

    $scope.editar = function ($index) {

    };

    $scope.validaForm = function (values) {
        $scope.hasError = false;
        var retorno = validaFormAdm.do(values)

        if(!retorno.success){
            $scope.erro = retorno.resp;
            $scope.hasError = true;
            return false;
        }else{
            return true;
        }

    };

    $scope.validaNumero = function(){
        $scope.add.login = apenasNumero($scope.add.login);
    };

    toggleMenu();
}

function ConfigController(){
    var Ctrl = this;

    Ctrl.listaConfig = function () {

    };

    Ctrl.addCabecalho = function () {

    };

    Ctrl.addRodape = function () {

    };

    toggleMenu();
}
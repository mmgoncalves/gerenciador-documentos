function TopoCtrl(){

}

function ConfigController($scope, Request, Dialog, UpLogo){
    $scope.config = {};

    $scope.lista = function () {
        Request.get_request("confList", "", "GET")
            .success(function(data, status){
                if(status == 201){
                    $scope.config = data;
                }
            });
    };

    $scope.salvar = function () {
        // verifica se a logo foi alterada
        var input = document.getElementById("take-picture");
        if($(input).val() != ''){
            // upload da foto
            UpLogo.do(input);
        }

        Request.get_request("confUpdade", $scope.config, "POST")
            .success(function(data, status){
                if(status == 201){
                    Dialog.show({tipo:"notify", titulo:"Configurações atualizadas."});
                }
            });
    };

    $scope.upload = function(){
        $('#take-picture').click();
    };

    toggleMenu();
    $scope.lista();
    UpLogo.init();
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


function AdministradorController($scope, Request, validaFormAdm, Dialog){
    $scope.hasSuccess = false;
    $scope.search = "";
    $scope.add = {};

    $scope.listaAdm = function(){
        $scope.hasSuccess = '';
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
        var values = $scope.add;

        if($scope.validaForm(values)){
            if($scope.add.idAdm == undefined){
                // novo
                var tipo = "admAdd";
            }else{
                //editar
                var tipo = "admUpdate";
            }
            Request.get_request(tipo, values, "POST")
                .success(function(data, status){
                    if(status == 201){
                        $scope.hasError = false;
                        Dialog.show({tipo:"notify", titulo:data.successMsg});
                        $scope.limpaForm();
                    }else{
                        $scope.erro = [{erro:data.erroMsg}];
                        $scope.hasError = true;
                    }
                });
        }
    };

    $scope.excluir = function($index){
        Dialog.show({tipo:"confirm", titulo:"Deseja remover este registro?"})
            .then(function(r){
                var values = {id:$scope.list[$index].idAdm};
                Request.get_request("admDelete", values, "GET")
                    .success(function (data, status) {
                        if(status == 201){
                            $scope.list.splice($index, 1);
                        }
                    });
            });
    };

    $scope.editar = function ($index) {
        var values = {id:$scope.list[$index].idAdm};

        Request.get_request("admFind", values, "GET")
            .success(function(data, status){
                $scope.add = data;
                toggleMenu2(".box2");
            });
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

    $scope.limpaForm = function(){
        $scope.add = {};
    };

    toggleMenu();
}


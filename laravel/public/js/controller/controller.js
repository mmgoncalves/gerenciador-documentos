Mod.controller('CategoriaController', CategoriaController)
    .controller('ConfigController', ConfigController)
    .controller('AdministradorController', AdministradorController)
    .controller('TopoController', TopoController)
    .controller('HomeController', HomeController);

/*
 * TOPO CONTROLLER
 */
function TopoController($scope, ADM){
    $scope.adm = ADM;
}

/*
 * HOME CONTROLLER
 */
function HomeController($scope, Request, Dialog, validaFormArq){
    $scope.listCat = {};
    $scope.listSub = {};
    $scope.arq = {};

    // Buscando todas as categorias
    $scope.buscaCat = function(){
        Request.get_request("catList", "", "GET")
            .success(function (data, status) {
                if(status == 201){
                    $scope.listCat = data;
                }else{
                    // categoria nao encontrada
                }
            });
    };

    // Buscando todas as subcategorias de uma categoria especifica
    $scope.buscaSub = function () {
        if($scope.arq.id_categoria != undefined && $scope.arq.id_categoria != ''){
            var values = {id:$scope.arq.id_categoria};
            Request.get_request("findSubCat", values, "GET")
                .success(function (data, status) {
                    if(status == 201){
                        $scope.listSub = data;
                    }else{
                        // sub categoria nao encontrada
                    }
                });
        }else{
            $scope.listSub = {}
        }
    };
    $scope.buscaCat();
    toggleMenu();
    chamaEditor();
}

/*
 * TELA CATEGORIAS
 */
function CategoriaController($scope, Request, Dialog){
    $scope.listCat = {};
    $scope.listSub = {};
    $scope.searchCat = '';
    $scope.searchSub = '';
    $scope.currentPage = 1;

    $scope.buscaCat = function () {
        Request.get_request("catList", "", "GET")
            .success(function(data, status){
                if(status == 201){
                    $scope.listCat = data;
                }
            });
    };

    // Funcao que cira uma nova categoria
    $scope.addCategoria = function () {
        if($scope.cat.nome != undefined && $scope.cat.nome != ''){

            if($scope.cat.idCategoria == undefined){
                var tipo = "catAdd";
            }else{
                var tipo = "catUpdate";
            }
            Request.get_request(tipo, $scope.cat, "POST")
                .success(function(data, status){
                    if(status == 201){
                        // Mensagem de sucesso
                        Dialog.show({tipo:"notify", titulo:data.successMsg});
                        if(data.idCategoria != undefined){
                            // atualiza a lista de categorias
                            $scope.listCat.push({idCategoria:data.idCategoria, nome:$scope.cat.nome});
                        }

                        // limpa o form
                        $scope.cat = {};
                    }
                });
        }
    };

    $scope.addSubCategoria = function () {
        if($scope.sub != undefined && $scope.sub != ''){

            if($scope.sub.idSubCategoria == undefined){
                var tipo = "subAdd";
            }else{
                var tipo = "subUpdate";
            }
            Request.get_request(tipo, $scope.sub, "POST")
                .success(function (data, status) {
                    if(status == 201){
                        // Mensagem de sucesso
                        Dialog.show({tipo:"notify", titulo:data.successMsg});
                        // limpa o form
                        $scope.sub = {};
                    }
                });
        }
    };

    $scope.buscaCategoria = function (){
        var values = {busca:$scope.searchCat};
        Request.get_request("catSearch", values, "POST")
            .success(function (data, status) {
                if(status == 201){
                    $scope.listCat = data;
                }
            });
    };

    $scope.buscaSubCategoria = function (){
        var values = {busca:$scope.searchSub};
        Request.get_request("subSearch", values, "POST")
            .success(function (data, status) {
                if(status == 201){
                    $scope.listSub = data;
                }
            });
    };

    $scope.editarCat = function ($index) {
        $scope.cat = $scope.listCat[$index];
        toggleMenu2('.box2');
    };

    $scope.editarSub = function ($index) {
        $scope.sub = $scope.listSub[$index];
        toggleMenu2('.box4');
    };

    $scope.excluirCat = function($index){
        Dialog.show({tipo:"confirm", titulo:"Deseja remover esta categoria?"})
            .then(function(r){
                var values = {id:$scope.listCat[$index].idCategoria};
                Request.get_request("catDelete", values, "GET")
                    .success(function (data, status) {
                        if(status == 201){
                            $scope.listCat.splice($index, 1);
                        }
                    });
            });
    };

    $scope.excluirSub = function($index){
        Dialog.show({tipo:"confirm", titulo:"Deseja remover esta sub categoria?"})
            .then(function(r){
                var values = {id:$scope.listSub[$index].idSubCategoria};
                Request.get_request("subDelete", values, "GET")
                    .success(function (data, status) {
                        if(status == 201){
                            $scope.listSub.splice($index, 1);
                        }
                    });
            });
    };

    $scope.buscaCat();
    toggleMenu();
}

/*
 * TELA CONFIGURACOES
 */
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


/*
 * TELA ADMINISTRADOR
 */
function AdministradorController($scope, Request, validaFormAdm, Dialog){
    //$scope.hasSuccess = false;
    $scope.search = "";
    $scope.add = {};
    $scope.currentPage = 1;

    // Funcao que faz a busca por adm no banco
    $scope.listaAdm = function(){
        //$scope.hasSuccess = '';
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

    // Funcao que cadastra um novo ADM, ou edita um existente
    $scope.addAdm = function () {
        var values = $scope.add;

        if($scope.validaForm(values)){
            if($scope.add.idAdm == undefined){
                var tipo = "admAdd"; // novo
            }else{
                var tipo = "admUpdate"; // editar
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

    // Funcao que exclui um adm
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

    // Funcao que
    $scope.editar = function ($index) {
        var values = {id:$scope.list[$index].idAdm};

        $scope.add = $scope.list[$index];
        toggleMenu2(".box2");
    };

    // Funcao para validar o formulario principal
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

    // Funcao que forca o campo cpf para ter apenas numeros
    $scope.validaNumero = function(){
        $scope.add.login = apenasNumero($scope.add.login);
    };

    // Funcao para limpar o formulario
    $scope.limpaForm = function(){
        $scope.add = {};
    };

    // Chama a funcao que contrala os Boxers
    toggleMenu();
}

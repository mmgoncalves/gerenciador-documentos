Mod.controller('MainController', MainController);

function MainController($scope, CSRF_TOKEN, Request){
    $scope.filtro = {};
    $scope.arq = {};
    $scope.currentPage = 1;
    $scope.csrf = CSRF_TOKEN;

    // Recupera os ultimos 100 registros
    $scope.listAll = function () {

    };

    // BUSCA POR FILTROS \\
    $scope.searchFiltro = function () {
        $scope.filtro.data = $("#inpDataFiltro").val();
        Request.get_request("findArq", $scope.filtro, "POST")
            .success(function (data, status) {
                $scope.listArq = data;
            });
    };

    // RETORNA TODOS OS DADOS NECESSARIOS PARA O FILTRO DE BUSCA \\
    $scope.buscaFiltros = function () {
        Request.get_request("findFilters", "", "GET")
            .success(function (data, status) {
                if(status == 201){
                    $scope.listArq = data.arq;
                    $scope.listCat = data.cat;
                    $scope.listEdc = data.edicoes;
                }
            });
    };

    $scope.buscaSubFiltro = function () {
        if($scope.filtro.id_categoria != undefined && $scope.filtro.id_categoria != ''){
            var values = {id:$scope.filtro.id_categoria};
            Request.get_request("findSubCat", values, "GET")
                .success(function (data, status) {
                    if(status == 201 && data != ""){
                        $scope.filtro.id_subCategoria = data[1].idSubCategoria;
                        $scope.listSub = data;
                    }else{
                        // entra aqui caso nao exista sub categoria
                        delete $scope.listSub; // deleta a variavel para esconder o select de subcategorias
                    }
                });
        }else{
            delete $scope.listSub; // deleta a variavel para esconder o select de subcategorias
            delete $scope.filtro.id_subCategoria;
        }
    };

    // TOGGLEFILTER \\
    $scope.toggleFilter = function () {
        $('.formFilter').slideToggle('fast');
    };

    datapicker(); // chama a funcao que inicia o calendario
    $scope.buscaFiltros(); // chama a funcao que lista todos os arquivos
}

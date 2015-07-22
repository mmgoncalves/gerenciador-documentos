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


function AdministradorController(Request){
    var Ctrl = this;

    Ctrl.listaAdm = function(){

        Request.get_request('admList', '', 'GET')
            .success(function(data){
                console.log(data);
                Ctrl.list = data[0];
            });
    };

    Ctrl.addAdm = function () {
        console.log(Ctrl.add);
    };

    toggleMenu();
    Ctrl.listaAdm();
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
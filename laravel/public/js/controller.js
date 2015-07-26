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


function AdministradorController(Request, validaFormAdm){
    var Ctrl = this;
    Ctrl.hasSuccess = false;
    Ctrl.add = {};

    Ctrl.listaAdm = function(){
        Ctrl.erroSearch = false;
        if(Ctrl.search != undefined && Ctrl.search != ""){
            Request.get_request('admSearch', {busca:Ctrl.search}, 'POST')
                .success(function(data, status){
                    if(status == 201){
                        Ctrl.list = data;
                    }else{
                        Ctrl.erroSearch = data.erroMsg;
                        Ctrl.list = false;
                    }
                });
        }
    };

    Ctrl.addAdm = function () {
        var values = {nome:Ctrl.add.nome, login:Ctrl.add.login, senha:Ctrl.add.senha, reSenha:Ctrl.add.reSenha};

        if(Ctrl.validaForm(values)){
            Request.get_request("admAdd", values, "POST")
                .success(function(data, status){
                    if(status == 201){
                        Ctrl.hasError = false;
                        Ctrl.hasSuccess = true;
                    }else{
                        Ctrl.erro = [{erro:data.erroMsg}];
                        Ctrl.hasError = true;
                    }
                });
        }
    };

    Ctrl.validaForm = function (values) {
        Ctrl.hasError = false;
        var retorno = validaFormAdm.do(values)

        if(!retorno.success){
            Ctrl.erro = retorno.resp;
            Ctrl.hasError = true;
            return false;
        }else{
            return true;
        }

    };

    Ctrl.validaNumero = function(){
        Ctrl.add.login = apenasNumero(Ctrl.add.login);
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
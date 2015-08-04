Mod.controller('LoginController', LoginController);


function LoginController($scope, CSRF_TOKEN){
    $scope.adm = {};
    $scope.token = CSRF_TOKEN;

    if(ERROR != undefined && ERROR){
        $scope.error = [{erro:"CPF ou senha incorretos."}];
        $scope.hasError = true;
    }

    $scope.logar = function(){
        if($scope.validaForm()){
            $('form').submit();
        }
    };

    $scope.validaForm = function(){
        $scope.hasError = false;
        var retorno = $scope.validaFormLogin($scope.adm);
        if(!retorno.success){
            $scope.error = retorno.resp;
            $scope.hasError = true;
            return false;
        }else{
            return true;
        }
    };

    $scope.validaNumero = function(){
        $scope.adm.login = apenasNumero($scope.adm.login);
    };

    $scope.validaFormLogin = function(values){
        var resp = [];

        if(values.login == undefined || values.login == "" || values.login.length != 11){resp.push({erro:'Digite o CPF corretamente.'})}

        else if(!ValidarCPF(values.login)){resp.push({erro:'CPF inválido.'})}

        if(values.senha == undefined || values.senha == "" || values.senha.length > 20 || values.senha.length < 6){resp.push({erro:'A senha deve conter entre 6 e 20 caracteres.'})}

        if(resp.length > 0){
            return {success:false, resp:resp}
        }

        return {success:true}
    };
}
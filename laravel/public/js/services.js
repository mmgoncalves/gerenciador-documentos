var URL = 'http://localhost:8000';

// servico que controla as requisicoes HTTP
Mod.factory('Request', ['RequestHttp', function(RequestHttp){
    return{
        get_request:function(tipo, value, metodo){
            //Loading.func('show');
            
            // verifica qual o tipo de requisicao, e monta a URL adequada
            switch (tipo){
                case 'logar':       var url = URL + '/logar'; break;
                case 'attPass':     var url = URL + '/attPass'; break;
                case 'admList':     var url = URL + '/adm/listAll'; break;
                case 'admSearch':   var url = URL + '/adm/search'; break;
                case 'admAdd':      var url = URL + '/adm/create'; break;
                case 'admDelete':   var url = URL + '/adm/delete/'+value.id; break;
                case 'admFind':     var url = URL + '/adm/find/'+value.id; break;
                case 'admUpdate':   var url = URL + '/adm/update/'; break;
                    
                default : return false;
            }
            
            // faz o retorno da requisicao
            return RequestHttp.get_request(url, value, metodo);
        }
    };
}])

// servico que executa e retorna uma requisicao POST ou GET
.factory('RequestHttp', ['$http', function($http){
    return{
        get_request: function(url, value, metodo){
            switch (metodo){
                case 'GET' : return $http.get(url);
                case 'POST': return $http.post(url, value);
            }
        }
    };
}])

.factory('LocalStorage', [function(){
    return{
        get:function(){
            var user =  window.localStorage.getItem("user");
            return JSON.parse(user);
        },
        set:function(n){
            console.log(n);
            var user = JSON.stringify(n);
            window.localStorage.setItem("user", user);
        },
        del:function(){
            window.localStorage.removeItem("user");
        }
    };
}])

.factory('validaFormAdm', [function(){
    return{
        do: function(values){
            var resp = [];

            if(values.nome == undefined || values.nome == ""){resp.push({erro:'Digite o nome corretamente.'})}

            if(values.login == undefined || values.login == "" || values.login.length != 11){resp.push({erro:'Digite o CPF corretamente.'})}

            else if(!ValidarCPF(values.login)){resp.push({erro:'CPF inválido.'})}

            if(values.senha == undefined || values.senha == "" || values.senha.length > 20 || values.senha.length < 6){resp.push({erro:'A senha deve conter entre 6 e 20 caracteres.'})}

            else if(values.senha != values.reSenha){resp.push({erro:'Os campos SENHA e REPETIR SENHA estão diferentes.'})}

            if(resp.length > 0){
                return {success:false, resp:resp}
            }

            return {success:true}
        }
    };
}])
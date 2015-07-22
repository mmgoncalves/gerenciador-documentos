var URL = 'http://localhost:8000/';

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
                case 'admAdd':      var url = URL + '/adm/create'; break;
                    
                default : return false;
            }
            
            // faz o retorno da requisicao
            return RequestHttp.get_request(url, value, metodo);
                /*.success(function(data){
                    console.log(data);
                });*/
        }
    };
}])

// servico que executa e retorna uma requisicao POST ou GET
.factory('RequestHttp', ['$http', function($http){
    return{
        get_request: function(url, value, metodo){
            switch (metodo){
                case 'GET' : return $http.get(url);
                case 'POST': $http.defaults.headers.common['X-Csrf-Token'] = TOKEN; return $http.post(url, value);
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
}]);
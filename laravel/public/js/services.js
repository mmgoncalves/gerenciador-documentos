// servico que controla as requisicoes HTTP
Mod.factory('RequisicaoHttp', ['Request', function(Request){
    return{
        get_request:function(tipo, value, metodo){
            //Loading.func('show');
            
            // verifica qual o tipo de requisicao, e monta a URL adequada
            switch (tipo){
                case 'logar':
                    var url = URL+'/logar';
                    break;
                    
                case 'attPass':
                    var url = URL+'/attPass';
                    break;
                    
                default : return false;
            }
            
            // faz o retorno da requisicao
            return Request.get_request(url, value, metodo).success(function(data){
                console.log(data);
            });
        }
    };
}])

// servico que executa e retorna uma requisicao POST ou GET
.factory('Request', ['$http', function($http){
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
}]);
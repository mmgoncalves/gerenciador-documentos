//var URL = 'http://projetoluciano.web2229.uni5.net';
var URL = 'http://localhost:8000';

// servico que controla as requisicoes HTTP
Mod.factory('Request', ['RequestHttp', function(RequestHttp){
    return{
        get_request:function(tipo, value, metodo){
            //Loading.func('show');
            
            // verifica qual o tipo de requisicao, e monta a URL adequada
            switch (tipo){
                case 'subAdd':      var url = URL + '/sub/create'; break;
                case 'subSearch':   var url = URL + '/sub/search'; break;

                case 'catList':     var url = URL + '/cat'; break;
                case 'catAdd':      var url = URL + '/cat/create'; break;
                case 'catSearch':   var url = URL + '/cat/search'; break;

                case 'confList':    var url = URL + '/config'; break;
                case 'confUpdade':  var url = URL + '/config/update'; break;

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

.factory('Dialog', ['$dialogs', '$rootScope', '$timeout', function($dialogs, $rootScope, $timeout){
    return{
        show: function(values){
            switch (values.tipo){
                case "confirm":
                    dlg = $dialogs.confirm(values.titulo, "");
                    return dlg.result;

                case "error":
                    dlg = $dialogs.error(values.titulo);
                    return true;

                case "notify":
                    dlg = $dialogs.notify(values.titulo);
                    return true;
            }
        }
    };
}])
// servico de upload de fotos
.factory('UpLogo', ['CSRF_TOKEN', function(CSRF_TOKEN){
    return {
        do:function(input){
            var i = 0, len = input.files.length, img, reader, file, formdata = new FormData();

            for ( ; i < len; i++ ) {
                file = input.files[i];
                if (!!file.type.match(/image.*/)) {
                    formdata.append("images[]", file);
                }
            }

            console.log(formdata);

            $.ajax({
                beforeSend: function (r){r.setRequestHeader("X-Csrf-Token", CSRF_TOKEN);},
                url: URL + '/config/logo',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {}
            });
        },
        init:function(){
            var takePicture = document.querySelector("#take-picture"), showPicture = document.querySelector("#show-picture");
            if (takePicture && showPicture) {
                // Set events
                takePicture.onchange = function (event) {
                    // Get a reference to the taken picture or chosen file
                    var files = event.target.files,file;
                    if (files && files.length > 0) {
                        file = files[0];
                        try {
                            // Get window.URL object
                            var URL = window.URL || window.webkitURL;

                            // Create ObjectURL
                            var imgURL = URL.createObjectURL(file);

                            // Set img src to ObjectURL
                            showPicture.src = imgURL;
                            console.log('foi');

                            // Revoke ObjectURL
                            URL.revokeObjectURL(imgURL);
                        }catch (e) {
                            try {
                                // Fallback if createObjectURL is not supported
                                var fileReader = new FileReader();
                                fileReader.onload = function (event) {
                                    showPicture.src = event.target.result;
                                };
                                fileReader.readAsDataURL(file);
                            }
                            catch (e) {
                                //alert('deu ruim');
                            }
                        }
                    }
                };
            }
        }
    };
}]);
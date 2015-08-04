<form method="POST" action="/adm/auth">
    {!! csrf_field() !!}

    <div>
        CPF
        <input type="text" name="cpf" value="">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

<div class="col-md-4"></div>

<section class="col-md-4 boxLogin">
    <form class="form-group">
        <img src="img/padlock.jpg" class="pull-right"/>
        <div class="form-group">
            <h3> Autentique-se para acessar o sistema</h3>
        </div>

        <div class="form-group col-md-8">

            <div class="form-group">
                <input type="text" ng-keyup="validaNumero()" class="form-control" placeholder="CPF: Apenas n�meros" ng-model="adm.login" maxlength="11">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" placeholder="Digite sua senha" ng-model="adm.senha" maxlength="20">
            </div>

            <div class="form-group">
                <button class="btn btn-primary" ng-click="logar()">Entrar</button>
            </div>
        </div>

        <div class="form-group form-inline has-error col-md-12" ng-show="hasError">
            <label class="control-label col-sm-6">
                <span class="glyphicon glyphicon-warning-sign"></span>
                Erro ao enviar <br/>
                <ul>
                    <li ng-repeat="e in error"> {{ e.erro }}</li>
                </ul>
            </label>
        </div>
    </form>
</section>
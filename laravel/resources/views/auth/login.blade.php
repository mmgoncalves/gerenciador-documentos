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
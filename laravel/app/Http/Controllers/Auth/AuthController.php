<?php

namespace App\Http\Controllers\Auth;
use App\Adm;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cpf' => 'required|max:11',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /*
     * Metodo que recebe uma requisicao de login, chama o model ADM para validar os dados.
     * Caso os dados estejam corretos, abre a sessao e redireciona para a pagina home.
     * Caso esteja erro, chama a view de login, informando que houve um erro.
     */
    public function postLogin(Request $request){
        // Encerro todas as sessoes por garantia
        Auth::logout();
        // recupero os dados da requisicao
        $input = $request->all();

        // chamo o metodo que valida os dados
        $admDao = new Adm();
        if(($idAdm = $admDao->authAdm($input))){
            // abre a sessao e redireciona para home
            $adm = $admDao->find($idAdm);
            Auth::login($adm);
            return redirect('home');
        }else{
            // chama a view de login, e informa que houve um erro
            return view('auth.login', ['error' => 'true']);
        }
    }

    /*
     * Metodo que encerrar a sessao do usuario, e redireciona para pagina de login
     */
    public function getLogout(){
        Auth::logout();
        return redirect('auth/login');
    }
}

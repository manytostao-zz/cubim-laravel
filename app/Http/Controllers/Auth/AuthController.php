<?php

namespace CUBiM\Http\Controllers\Auth;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use CUBiM\Model\User;
use Validator;
use CUBiM\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package CUBiM\Http\Controllers\Auth
 */
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
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
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

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('users.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        $user = null;
        try {

            $user = \Sentinel::findByCredentials($credentials);
            \Sentinel::authenticate($credentials, $request->get('remember_me'));

            if (is_null($user) or !($user = \Sentinel::check()))
                return \Redirect::back()->withInput()->withErrors('Credenciales incorrectas.');

            $this->permit($user);

            return \Redirect::intended();

        } catch (NotActivatedException $exception) {

            $activation = \Activation::completed($user);
            if ($activation == false or !$activation->completed) {
                $activation = \Activation::create($user);
                \Activation::complete($user, $activation->code);
            }
            \Sentinel::authenticate($credentials, $request->get('remember_me'));

            $this->permit($user);

            return \Redirect::intended();

        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        \Sentinel::logout();

        return \Redirect::route('auth.login');
    }

    /**
     * @param $user
     */
    private function permit($user)
    {
        foreach ($user->roles as $role)
            $user->permissions = config('permissions.' . $role->name);
        $user->save();
    }
}

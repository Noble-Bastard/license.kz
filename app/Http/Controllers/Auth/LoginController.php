<?php

namespace App\Http\Controllers\Auth;

use App\Data\Core\Dal\UserDal;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * Это свойство НЕ используется, т.к. перенаправление происходит через UserDal::login()
     *
     * @var string
     */
    protected $redirectTo = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Log::info("LoginController constructor called");
        Session::put('backUrl', URL::current());

        $this->middleware('guest')->except('logout');
    }

    public function sendLoginResponse(Request $request){
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = $this->guard()->user();
        \Log::info("Login attempt for user: " . $user->id . " (" . $user->email . ")");

        if ($response = $this->authenticated($request, $user)) {
            \Log::info("Custom authenticated method returned response");
            return $response;
        }

        // Принудительно перенаправляем в ЛК согласно роли пользователя
        file_put_contents(storage_path('logs/debug.txt'), "Calling UserDal::login for user: " . $user->id . " at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        $redirectResponse = UserDal::login($user);
        file_put_contents(storage_path('logs/debug.txt'), "UserDal::login returned: " . get_class($redirectResponse) . " at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        
        return $redirectResponse;
    }

    /**
     * Переопределяем стандартный метод перенаправления
     * Всегда используем логику из UserDal::login()
     */
    protected function redirectTo()
    {
        // Этот метод НЕ должен использоваться, 
        // т.к. перенаправление происходит в sendLoginResponse()
        return null;
    }

    /**
     * Метод вызывается после успешной аутентификации
     * Возвращаем null, чтобы не мешать логике в sendLoginResponse()
     */
    protected function authenticated(Request $request, $user)
    {
        // Логика перенаправления полностью делегирована UserDal::login()
        return null;
    }

    /**
     * Переопределяем основной метод login для принудительного использования нашей логики
     */
    public function login(Request $request)
    {
        // Простой дебаг в файл
        file_put_contents(storage_path('logs/debug.txt'), "Login method called at " . date('Y-m-d H:i:s') . " with email: " . $request->input('email') . "\n", FILE_APPEND);
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            file_put_contents(storage_path('logs/debug.txt'), "Login successful, calling sendLoginResponse at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}

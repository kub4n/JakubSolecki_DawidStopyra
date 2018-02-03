<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\User\Exceptions\InvalidOrExpiredResetCode;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\ResetCompleteRequest;
use Modules\User\Http\Requests\ResetRequest;
use Modules\User\Services\UserRegistration;
use Modules\User\Services\UserResetter;

class AuthController extends BasePublicController
{
    use DispatchesJobs;

    public function __construct()
    {
        parent::__construct();
    }

    public function getLogin()
    {
        return view('user::public.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        $error = $this->auth->login($credentials);

        if ($error) {
            return redirect()->back()->withInput()->withError($error);
        }

        return redirect()->intended(route(config('asgard.user.config.redirect_route_after_login')))
                ->withSuccess(trans('user::messages.successfully logged in'));
    }

    public function getRegister()
    {
        return view('user::public.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        app(UserRegistration::class)->register($request->all());

        return redirect()->route('register')
            ->withSuccess();
    }

    public function getLogout()
    {
        $this->auth->logout();

        return redirect()->route('login');
    }



    public function getReset()
    {
        return view('user::public.reset.begin');
    }

    public function postReset(ResetRequest $request)
    {
        try {
            app(UserResetter::class)->startReset($request->all());
        } catch (UserNotFoundException $e) {
            return redirect()->back()->withInput()
                ->withError(trans('user::messages.no user found'));
        }

        return redirect()->route('reset')
            ->withSuccess(trans('user::messages.check email to reset password'));
    }

    public function getResetComplete()
    {
        return view('user::public.reset.complete');
    }


}

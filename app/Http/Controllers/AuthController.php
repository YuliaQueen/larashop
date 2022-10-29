<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function signUp()
    {
        return view('auth.sign-up');
    }

    /**
     * @param SignInFormRequest $request
     *
     * @return RedirectResponse
     */
    public function signIn(SignInFormRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function store(SignUpFormRequest $request)
    {
        $user = User::query()->create([
            'name'     => $request->get('name'),
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->intended(route('home'));
    }

    public function logOut()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function forgot()
    {
        return view('auth.forgot-password');
    }

    public function reset()
    {
        return view('auth.reset-password');
    }
}

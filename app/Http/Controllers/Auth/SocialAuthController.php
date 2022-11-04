<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $driver)
    {
        try {
            return Socialite::driver($driver)->redirect();
        } catch (\Throwable $e) {
            throw new \DomainException('Произошла ошибка или драйвер не поддерживается');
        }
    }

    public function callback(string $driver)
    {
        if ($driver !== 'github') {
            throw new \DomainException('Драйвер не поддерживается');
        }

        $driverUser = Socialite::driver($driver)->user();

        $user = User::query()->updateOrCreate([
             "{$driver}_id" => $driverUser->id,
        ],
         [
             'name'     => $driverUser->name,
             'email'    => $driverUser->email,
             'password' => bcrypt(1234567890)
         ]);

        auth()->login($user);

        return redirect()->intended(route('home'));
    }
}

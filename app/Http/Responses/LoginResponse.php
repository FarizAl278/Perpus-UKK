<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as ContractsLoginResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/');

    }
}

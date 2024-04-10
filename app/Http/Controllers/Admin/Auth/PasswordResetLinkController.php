<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController as FortifyPasswordResetLinkController;
use Laravel\Fortify\Http\Responses\SuccessfulPasswordResetLinkRequestResponse;

class PasswordResetLinkController extends FortifyPasswordResetLinkController
{
    public function store(Request $request) : \Illuminate\Contracts\Support\Responsable
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status]);
        } else {
            return app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => "A password reset link has been sent to your email address."]);
        }
    }
}

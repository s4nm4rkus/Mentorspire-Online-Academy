<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Determine the email address to send the reset link to
        $request->validate([
            'email' => 'required|email',
        ]);

        // Assuming $request->email contains the recipient's email address
        $recipientEmail = $request->email;

        // Send the email using the Mail facade
        Mail::to($recipientEmail)->send(new ResetPasswordEmail());

        // Optionally, redirect back with a success message
        return redirect()->back()->with('status', 'Password reset link sent successfully');
    
    }
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}

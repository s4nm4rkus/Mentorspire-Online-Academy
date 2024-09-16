<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        return route('home'); // Default redirect after login
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
       
        // Check if the user's email is verified
        if (!$user->hasVerifiedEmail()) {
            Auth::logout();
            return redirect()->route('login')->with('message', 'You need to verify your email address before logging in.');
        }

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('home')->with('admin_login_notification', 'Welcome, Admin! You have successfully logged in.');
        } else {
            return redirect()->intended('home'); // Redirect regular users to user dashboard
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect('/');
    }
}


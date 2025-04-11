<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        $user_data = $request->only(['email', 'password']);
        if (Auth::attempt($user_data)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin == true) {
                return redirect()->route('admin.top');
            } else if (Auth::user()->is_admin == false) {
                return redirect()->route('user.top');
            }
        }
        return back()->withInput($request->only('email'))->withErrors([
            'login_error' => '入力された情報に誤りがあります。',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('user.top');
    }
}
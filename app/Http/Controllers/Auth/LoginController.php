<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('flash', 'Has cerrado sesion correnctamente');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('identity', 'password');

        if (Auth::attempt(['identity' => $request->identity, 'password' => $request->password, 'status' => '1'])) {
            $tipo_usuario = Auth::user()->user_type;
            switch ($tipo_usuario) {
                case 1:
                    return redirect()->route('master_index');
                    break;
                case 2:
                    return redirect()->route('coordinator_index');
                    break;
                case 3:
                    return redirect()->route('candidate_index');
                    break;
                case 4:
                    return redirect()->route('candidate_index');
                    break;
                default:
                    break;
            }
        } else {
            return "Fallo";
        }
    }
}

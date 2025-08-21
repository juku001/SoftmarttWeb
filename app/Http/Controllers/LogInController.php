<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRoutes;
use Auth;
use Http;
use Illuminate\Http\Request;
use Session;

class LogInController extends Controller
{
    public function index(Request $request)
    {
        $url = ApiRoutes::login();

        // validate form inputs first
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // send POST request to your API
        $response = Http::post($url, [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            $dataUser = $data['user'];

            $user = \App\Models\User::firstOrCreate(
                ['id' => $dataUser['id']], // primary key from API
                [
                    'name' => $dataUser['name'],
                    'email' => $dataUser['email'],
                    // You can leave password blank or hash a dummy value
                    'password' => bcrypt('api-login'),
                ]
            );

            Auth::login($user);
            Session::put('auth_token', $data['token']);

            return redirect()->route('dashboard');

        }

        return back()->withErrors([
            'email' => 'Invalid credentials or login failed.',
        ]);



    }




    public function destroy(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}

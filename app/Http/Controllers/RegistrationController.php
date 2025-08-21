<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRoutes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the form inputs
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'sex' => 'required|in:Male,Female',
            'dob' => 'required|date',
        ]);

        // 2. API URL
        $url = ApiRoutes::register();

        // 3. Send POST request to API
        $response = Http::withToken(Session::get('auth_token'))->post($url, [
            'name' => $request->fullname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'type'=> 'sales'
        ]);

        // 4. Handle response
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Admin created successfully!');
        }

        // If API fails
        $errorMessage = $response->json()['message'] ?? 'Failed to create admin.';
        return redirect()->back()->withErrors(['error' => $errorMessage]);
    }
}

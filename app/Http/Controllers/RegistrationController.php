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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:20',
            'sex' => 'required|in:male,female',
            'dob' => 'required|date',
        ]);

        $url = ApiRoutes::register();

        $request['type']= 'sales';


        $response = Http::withToken(Session::get('auth_token'))->post($url, $request->all());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Admin created successfully!');
        }

        // Handle API validation errors
        if ($response->status() == 422) {
            $apiErrors = $response->json()['errors'] ?? [];
            // Flatten the errors for withErrors()
            $flattened = [];
            foreach ($apiErrors as $field => $messages) {
                $flattened[$field] = $messages[0]; // just take the first error
            }
            return redirect()->back()->withInput()->withErrors($flattened);
        }

        // General API error
        $errorMessage = $response->json()['message'] ?? 'Failed to create admin.';
        return redirect()->back()->withInput()->withErrors(['error' => $errorMessage]);
    }

}

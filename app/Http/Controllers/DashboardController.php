<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRoutes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class DashboardController extends Controller
{
    public function create()
    {
        $adminUrl = ApiRoutes::getUsersByType('sales');

        // Call the API with the auth token
        $response = Http::withToken(Session::get('auth_token'))->get($adminUrl);

        if ($response->successful()) {
            $admins = $response->json()['data'] ?? []; // get the data array from API
        } else {
            $admins = [];
        }

        return view('dashboard', compact('admins'));
    }
}

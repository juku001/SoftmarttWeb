<?php

namespace App\Helpers;

class ApiRoutes
{
    /**
     * Get the base API URL from the environment.
     */
    public static function baseUrl(): string
    {
        return env('ENGINE_BASE_URL', 'https://default-url.com/');
    }

    /**
     * Get the full API base URL.
     */
    public static function apiUrl(): string
    {
        return self::baseUrl() . '/' . 'api/';
    }



    public static function displayUrl(): string
    {
        return self::baseUrl() . '/' . 'display/';
    }


    public static function storageUrl(): string
    {
        return self::baseUrl() . '/' . 'storage/';
    }

    /**
     * Authentication Routes
     */



    public static function welcome()
    {
        return self::apiUrl() . 'welcome';
    }

    public static function login(): string
    {
        return self::apiUrl() . 'login';
    }

    public static function register(): string
    {
        return self::apiUrl() . 'register';
    }


    public static function getUsersByType(string $type): string
    {
        return self::apiUrl() . 'users/user-type/' . $type;
    }

}
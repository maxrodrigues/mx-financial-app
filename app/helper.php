<?php

if (!function_exists('getLoggedUser')) {
    /**
     * @return array<string, string>
     */
    function getLoggedUser(): array
    {
        if (Auth::check()) {
            return Auth::user()->toArray();
        }

        return [];
    }
}

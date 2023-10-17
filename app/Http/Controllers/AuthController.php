<?php

namespace App\Http\Controllers;

use App\Helpers\Connector;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function __construct(
        public Connector $connector
    ) {}

    /**
     * @param LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $this->connector->getToken(data: $request->toArray());

        return response()->redirectTo(route('authors.list'));
    }

    /**
     * @return void
     */
    public function logout(): RedirectResponse
    {
        Cache::flush();

        return response()->redirectTo(route('home'));
    }
}

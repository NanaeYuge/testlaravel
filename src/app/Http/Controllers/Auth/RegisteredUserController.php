<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;


class RegisteredUserController extends Controller
{
    public function store(Request $request, CreatesNewUsers $creator)
    {
        $user = $creator->create($request->all());

        Auth::login($user);

        return redirect('/thanks'); // サンクスページへ
    }
}
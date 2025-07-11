<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{

    public function store(Request $request, CreatesNewUsers $creator)
    {
        $user = $creator->create($request->all());

        Auth::login($user);

        // 登録後にサンクスページへリダイレクト
        return redirect('/thanks');
    }


    }

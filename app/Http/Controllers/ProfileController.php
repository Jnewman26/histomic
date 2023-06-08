<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->USER_ID;
        $User = User::where('USER_ID', '=', $userid)
        ->get();

        return Inertia::render('Application/Profile', [
            'user' => $User
        ]);
    }
}

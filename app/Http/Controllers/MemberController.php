<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $user = User::with('role')->get();
    	return view('adminlte/member/member', compact('user'));
    }
}

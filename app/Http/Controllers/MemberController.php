<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\member;

class MemberController extends Controller
{
    public function index(){
        $member = Member::all();
        return view('adminlte/member/member',['member' => $member]);
    }
}

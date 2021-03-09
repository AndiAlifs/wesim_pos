<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('adminlte/member/member',['members' => $members]);
    }

    public function create()
    {
        
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $member = Member::find($id);
        $member->name = $request->name;
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->save();
        return redirect('/member');
    }

    public function destroy($id)
    {

        $member = Member::find($id);
        $member->delete();
        return redirect('/member');
    }
}

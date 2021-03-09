<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\member;
use Faker\Factory as Faker;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('adminlte/member/member',['members' => $members]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'member_code' => "34123",
            'address' => $request->address,
            'point' => 0,
        ]);
        return redirect('/member');
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

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
        return view('adminlte/member/member',['member' => $members]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'member_id' => Faker::create('id_ID')->numberBetween(1000000,9999999),
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

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
            'email' => 'required',
            'address' => 'required',
        ]);

        $faker = Faker::create('id_ID');

        Member::create([
            'name' => $request->name,
            'member_id' => $faker->numberBetween(1000000,9999999),
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'point' => 0,
        ]);
        return redirect()->route('member');
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
        return redirect()->route('member');
    }

    public function destroy($id)
    {

        $member = Member::find($id);
        $member->delete();
        return redirect()->route('member');
    }
}

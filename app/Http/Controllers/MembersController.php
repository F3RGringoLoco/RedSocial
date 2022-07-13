<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profesional;
use App\Member;
use App\Company;
use DB;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::get()->pluck('user_id');
        $profesionals = DB::table('profesionals')
                            ->where('id', '<>', Auth::id())
                            ->whereNotIn('id', $members)
                            ->select('id', 'career', 'name')
                            ->get();

        if ($profesionals->isEmpty()) {
            return back()->with('error','Lo sentimos, no hay profesionales registrados y/o disponibles por el momento');
        } else {
            return view('member.create', compact('profesionals'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'field' => 'required|string',
            'position' => 'nullable|max:1999',
        ]);

        $member = new Member();
        $member->field = $request->input('field');
        $member->position = $request->input('position');
        $member->user_id = $request->input('user_id');
        $company = Company::where('owner_id', Auth::id())->value('com_id');
        $member->company_id = $company;
        $member->save();

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

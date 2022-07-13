<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Company;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company = Company::where('owner_id', Auth::id())->value('com_id');
        $contacts = Contact::where([['company_id', $company], ['accepted', false]])->pluck('relate_id');
        $requests = DB::table('companies')
                        ->whereIn('com_id', $contacts)
                        ->select('com_id', 'com_name', 'society', 'sector', 'property', 'location', 'com_image', 'created_at')
                        ->get();

        return view('home', compact('requests'));
    }

    public function acceptRequest(Request $request){
        $company = Company::where('owner_id', Auth::id())->value('com_id');
        $accept = Contact::where([['company_id', $company], ['relate_id', $request->input('acceptCompany')]])->first();
        $accept->accepted = true;
        $accept->save();

        return redirect()->route('home');
    }

    public function rejectRequest(Request $request){
        $company = Company::where('owner_id', Auth::id())->value('com_id');
        $accept = DB::table('contacts')
                        ->where([['company_id', $company], ['relate_id', $request->input('rejectCompany')]])
                        ->delete();

        return redirect()->route('home');
    }
}

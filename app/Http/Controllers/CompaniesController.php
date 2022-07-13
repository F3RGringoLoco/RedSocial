<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Brands;
use App\Contact;
use App\Profesional;
use App\Follow;
use App\Member;
use App\Post;
use App\Like;
use DB;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::where('owner_id', Auth::id())->where('status', false)->first();
        $brands = null;
        $contacts1 = null;
        $contacts2 = null;
        $owner = null;
        $follows = null;
        $members = null;
        $posts = null;

        if (!empty($company)) {
            $owner = DB::table('profesionals')
                            ->where('user_id', Auth::id())
                            ->value('name');

            if (Brands::where('company_id', $company->com_id)->exists()) {
                $brands = DB::table('brands') 
                            ->join('companies', 'brands.company_id', '=', 'companies.com_id') 
                            ->where([
                                ['company_id', '=', $company->com_id],
                                ['brands.status', '=', 0]
                            ])
                            ->select('brands.br_id', 'brands.pro_name', 'brands.image')
                            ->get();
            }
            if (Contact::where([['relate_id', $company->com_id], ['accepted', true]])->exists()) {
                $contacts1 = DB::table('contacts')
                            ->join('companies', 'contacts.company_id', '=', 'companies.com_id') 
                            ->where('accepted', true)
                            ->select('companies.com_id', 'companies.com_name', 'companies.location', 'companies.com_image', 'contacts.created_at')
                            ->get();
            }
            if (Contact::where([['company_id', '=', $company->com_id], ['accepted', true]])->exists()) {
                $contacts2 = DB::table('contacts')
                            ->join('companies', 'contacts.relate_id', '=', 'companies.com_id') 
                            ->where('accepted', true)
                            ->select('companies.com_id', 'companies.com_name', 'companies.location', 'companies.com_image', 'contacts.created_at')
                            ->get();
            }
            if (Follow::where('company_id', $company->com_id)->exists()) {
                $list = Follow::where('company_id', $company->com_id)->pluck('follower_id');
                $follows = DB::table('profesionals')
                            ->whereIn('id', $list)
                            ->select('id', 'name', 'image', 'career')
                            ->get();
            }
            if (Member::where('company_id', $company->com_id)->exists()) {
                $list = Member::where('company_id', $company->com_id)->pluck('user_id');
                $members = DB::table('profesionals')
                            ->whereIn('id', $list)
                            ->select('id', 'name', 'image', 'career')
                            ->get();
            }
            if (Post::where('company_id', $company->com_id)->exists()) {
                $posts = DB::table('posts')
                            ->join('profesionals', 'posts.user_id', '=', 'profesionals.user_id') 
                            ->where('company_id', $company->com_id)
                            ->orderBy('posts.updated_at', 'desc')
                            ->select('profesionals.id', 'profesionals.name', 'profesionals.career', 'posts.post_id', 'posts.description', 'posts.image', 
                                    'posts.shares', 'posts.updated_at')
                            ->get();
                foreach ($posts as $pts) {
                    $count = Like::where('post_id', $pts->post_id)->count();
                    $pts->likeCount = $count;
                }
            }
        }

        return view('company.index', compact('company', 'brands', 'contacts1', 'contacts2', 'owner', 'follows', 'members', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'com_name' => 'required|string',
            'society' => 'required|string',
            'sector' => 'required|string',
            'property' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|nullable|max:1999',
        ]);

        $company = new Company();
        $company->com_name = $request->input('com_name');
        $company->society = $request->input('society');
        $company->sector = $request->input('sector');
        $company->property = $request->input('property');
        $company->location = $request->input('location');
        $company->description = $request->input('description');
        $company->owner_id = Auth::id();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileNameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt ,PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->storeAs('companies_pics/', $fileNameToStore, 's3');

            $company->com_image = $fileNameToStore;
        }
        $company->save();

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
        $company = Company::where('com_id', $id)->first();
        $followed = false;
        if (Follow::where([['company_id', $id], ['follower_id', Auth::id()]])->exists()) {
            $followed = true;
        }
        $company->followed = $followed;
        $owner = DB::table('profesionals')
                            ->where('id', $company->owner_id)
                            ->select('id', 'name')
                            ->first();
        $brands = null;
        $contacts1 = null;
        $contacts2 = null;
        $follows = null;
        $members = null;
        $posts = null;

        if (!empty($company)) {
            if (Brands::where('company_id', $id)->exists()) {
                $brands = DB::table('brands') 
                            ->join('companies', 'brands.company_id', '=', 'companies.com_id') 
                            ->where([
                                ['company_id', '=', $id],
                                ['brands.status', '=', 0]
                            ])
                            ->select('brands.br_id', 'brands.pro_name', 'brands.image')
                            ->get();
            }
            if (Contact::where([['relate_id', $company->com_id], ['accepted', true]])->exists()) {
                $contacts1 = DB::table('contacts')
                            ->join('companies', 'contacts.company_id', '=', 'companies.com_id') 
                            ->where('accepted', true)
                            ->select('companies.com_id', 'companies.com_name', 'companies.location', 'companies.com_image', 'contacts.created_at')
                            ->get();
            }
            if (Contact::where([['company_id', '=', $company->com_id], ['accepted', true]])->exists()) {
                $contacts2 = DB::table('contacts')
                            ->join('companies', 'contacts.relate_id', '=', 'companies.com_id') 
                            ->where('accepted', true)
                            ->select('companies.com_id', 'companies.com_name', 'companies.location', 'companies.com_image', 'contacts.created_at')
                            ->get();
            }
            if (Follow::where('company_id', $id)->exists()) {
                $list = Follow::where('company_id', $id)->pluck('follower_id');
                $follows = DB::table('profesionals')
                            ->whereIn('id', $list)
                            ->select('id', 'name', 'image', 'career')
                            ->get();
            }
            if (Member::where('company_id', $id)->exists()) {
                $list = Member::where('company_id', $id)->pluck('user_id');
                $members = DB::table('profesionals')
                            ->whereIn('id', $list)
                            ->select('id', 'name', 'image', 'career')
                            ->get();
            }
            if (Post::where('company_id', $id)->exists()) {
                $posts = DB::table('posts')
                            ->join('profesionals', 'posts.user_id', '=', 'profesionals.user_id') 
                            ->where('company_id', $id)
                            ->orderBy('posts.updated_at', 'desc')
                            ->select('profesionals.id', 'profesionals.name', 'profesionals.career', 'posts.post_id', 'posts.description', 'posts.image', 
                                    'posts.shares', 'posts.updated_at')
                            ->get();

                foreach ($posts as $pts) {
                    $count = Like::where('post_id', $pts->post_id)->count();
                    $liked = false;
                    if(Like::where([['post_id', $pts->post_id], ['user_id', Auth::id()]])->exists()){
                        $liked = true;
                    }
                    $pts->likeCount = $count;
                    $pts->liked = $liked;
                }
            }
        }
        
        return view('company.show', compact('company', 'brands', 'owner', 'contacts1', 'contacts2', 'follows', 'members', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::where('com_id', $id)->first();

        return view('company.edit', compact('company'));
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
        $this->validate($request, [
            'com_name' => 'required|string',
            'society' => 'required|string',
            'sector' => 'required|string',
            'property' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|max:1999',
            'cover' => 'nullable|max:1999',
        ]);

        $company = Company::findOrFail($id);
        $company->com_name = $request->input('com_name');
        $company->society = $request->input('society');
        $company->sector = $request->input('sector');
        $company->property = $request->input('property');
        $company->location = $request->input('location');
        $company->description = $request->input('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileNameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt ,PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->storeAs('companies_pics/', $fileNameToStore, 's3');

            $company->com_image = $fileNameToStore;
        }
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileNameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt ,PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $file->storeAs('companies_bg/', $fileNameToStore, 's3');

            $company->bg_image = $fileNameToStore;
        }
        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->status = true;
        $company->save();

        return redirect()->route('company.index');
    }

    public function followProfile(Request $request)
    {
        if (Follow::where([['company_id', $request->input('companyId')], ['follower_id', Auth::id()]])->exists()) {
            Follow::where([['company_id', $request->input('companyId')], ['follower_id', Auth::id()]])->delete();
        }else{
            $follow = new Follow();
            $follow->company_id = $request->input('companyId');
            $follow->follower_id = Auth::id();
            $follow->save();
        }
        $followsCount = Follow::where('company_id', $request->input('companyId'))->count();

        return response()->json(array('followsCount'=>$followsCount), 200);
    }

    public function sendRequest(Request $request)
    {
        $msg = "";
        if (Company::where('owner_id', Auth::id())->exists()) {
            $company = Company::where('owner_id', Auth::id())->value('com_id');
            if (Contact::where([['relate_id', $company], ['company_id', $request->input('companyId')], ['sended', true], ['accepted', true]])->exists() ||
                    Contact::where([['relate_id', $request->input('companyId')], ['company_id', $company], ['sended', true], ['accepted', true]])->exists()) {
                if (Contact::where([['relate_id', $company], ['company_id', $request->input('companyId')]])->exists()) {
                    Contact::where([['relate_id', $company], ['company_id', $request->input('companyId')]])->delete();
                }else{
                    Contact::where([['relate_id', $request->input('companyId')], ['company_id', $company]])->delete();
                }
                $msg = "Contacto eliminado con exito";
            }else {
                if (Contact::where([['relate_id', $company], ['company_id', $request->input('companyId')], ['sended', true], ['accepted', false]])->exists() ||
                        Contact::where([['relate_id', $request->input('companyId')], ['company_id', $company], ['sended', true], ['accepted', false]])->exists()){
                    $msg = "Solicitud en espera";
                }else{
                    $contact = new Contact();
                    $contact->relate_id = $company;
                    $contact->company_id = $request->input('companyId');
                    $contact->sended = true;
                    $contact->save();

                    $msg = "Solicitud enviado con exito";
                }       
            }
        }else{
            $msg = "Lo sentimos, no es posible realizar esta operación sin ser dueño de una empresa";
        }
        
        return response()->json(array('msg'=>$msg), 200);
    }
}

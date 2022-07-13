<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profesional;
use App\User;
use App\FollowProf;
use App\Like;
use DB;

class ProfesionalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesionals = DB::table('profesionals')
                            ->where('user_id', '<>', Auth::id())
                            ->select('id', 'name', 'birth', 'career', 'image')
                            ->get();
        
        return view('profesional.index', compact('profesionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesional = Profesional::findOrFail($id);
        $email = User::where('id', $profesional->user_id)->pluck('email');
        $followed = false;
        if (FollowProf::where([['following_id', $id], ['follower_id', Auth::id()]])->exists()) {
            $followed = true;
        }
        $profesional->followed = $followed;
        $following = DB::table('follow_profs')
                                ->join('profesionals', 'follow_profs.following_id', '=', 'profesionals.id')
                                ->where('following_id', $id)
                                ->select('profesionals.id', 'profesionals.name', 'profesionals.career', 'profesionals.image')
                                ->get();
        $followers =DB::table('follow_profs')
                                ->join('profesionals', 'follow_profs.follower_id', '=', 'profesionals.id')
                                ->where('follower_id', $id)
                                ->select('profesionals.id', 'profesionals.name', 'profesionals.career', 'profesionals.image')
                                ->get();
                                
        $posts = DB::table('posts')
                ->join('companies', 'posts.company_id', '=', 'companies.com_id') 
                ->where('user_id', $id)
                ->orderBy('posts.updated_at', 'desc')
                ->select('companies.com_id', 'companies.com_name', 'companies.com_image', 'posts.post_id', 'posts.description', 'posts.image', 
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
        
        return view('profesional.show', compact('profesional', 'email', 'followers', 'following', 'posts'));
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

    public function followProfesional(Request $request)
    {
        if (FollowProf::where([['following_id', $request->input('profesionalId')], ['follower_id', Auth::id()]])->exists()) {
            FollowProf::where([['following_id', $request->input('profesionalId')], ['follower_id', Auth::id()]])->delete();
        }else{
            $follow = new FollowProf();
            $follow->following_id = $request->input('profesionalId');
            $follow->follower_id = Auth::id();
            $follow->save();
        }
        $followsCount = FollowProf::where('company_id', $request->input('companyId'))->count();

        return response()->json(array('followsCount'=>$followsCount), 200);
    }
}

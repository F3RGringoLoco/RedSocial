<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Company;
use App\Like;
use App\Member;
use App\Brands;
use App\TraitsRecombee;
use DB;

class PostsController extends Controller
{

    function __construct(){
        //$this->middleware('auth')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
                        ->join('profesionals', 'posts.user_id', '=', 'profesionals.user_id') 
                        ->join('companies', 'posts.company_id', '=', 'companies.com_id') 
                        ->orderBy('posts.created_at', 'desc')
                        ->select('profesionals.id', 'profesionals.name', 'posts.post_id', 'posts.description', 'posts.image', 
                                'posts.shares', 'posts.created_at', 'companies.com_id', 'companies.com_name', 'companies.com_image')
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
        
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        app('App\Http\Controllers\TraitsProfController')->addItem("12");
        return back();
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
            'description' => 'required|string',
            'image' => 'nullable|max:1999',
        ]);

        if (Member::where('user_id', Auth::id())->exists() || 
                Company::where('owner_id', Auth::id())->exists()) {
            $post = new Post();
            $post->description = $request->input('description');
            $post->user_id = Auth::id();
            $company;
            if (Company::where('owner_id', Auth::id())->exists()) {
                $company = Company::where('owner_id', $post->user_id)->value('com_id');
            }else{
                $company = Member::where('user_id', $post->user_id)->value('company_id');
            }
            $post->company_id = $company;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileNameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt ,PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $file->storeAs('posts_pics/', $fileNameToStore, 's3');

                $post->image = $fileNameToStore;
            }

            $post->save();

            $ptid = strval($post->post_id);
            app('App\Http\Controllers\TraitsRecombeeController')->addItem($ptid);

            return back()->with('success', 'Publicado con exito!');
        } else {
            return back()->with('error', 'Lo sentimos, no puede publicar sin ser miembro o dueño de una empresa');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pts = DB::table('posts')
                        ->join('profesionals', 'posts.user_id', '=', 'profesionals.user_id') 
                        ->join('companies', 'posts.company_id', '=', 'companies.com_id') 
                        ->where('post_id', $id)
                        ->select('profesionals.id', 'profesionals.name', 'posts.post_id', 'posts.description', 'posts.image', 
                                'posts.shares', 'posts.created_at', 'companies.com_id', 'companies.com_name', 'companies.com_image')
                        ->first();

        $count = Like::where('post_id', $pts->post_id)->count();
        $liked = false;
        if(Like::where([['post_id', $pts->post_id], ['user_id', Auth::id()]])->exists()){
            $liked = true;
        }
        $pts->likeCount = $count;
        $pts->liked = $liked;

        return view('post.view', compact('pts'));
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

    public function likePost(Request $request)
    {
        if (Like::where([['post_id', $request->input('postId')], ['user_id', Auth::id()]])->exists()) {
            $like = Like::where([['post_id', $request->input('postId')], ['user_id', Auth::id()]])->delete();

            $likeCount = Like::where('post_id', $request->input('postId'))->count();

            $usid = strval(Auth::id());
            $ptid = strval($request->input('postId'));
            app('App\Http\Controllers\TraitsRecombeeController')->delPostLiked($usid, $ptid);

            return response()->json(array('likeCount'=>$likeCount), 200);
        }else{
            $like = new Like();
            $like->post_id = $request->input('postId');
            $like->user_id = Auth::id();
            $like->save();

            $likeCount = Like::where('post_id', $like->post_id)->count();

            $usid = strval($like->user_id);
            $ptid = strval($request->input('postId'));
            app('App\Http\Controllers\TraitsRecombeeController')->postLiked($usid, $ptid);

            return response()->json(array('likeCount'=>$likeCount), 200);
        }
    }

    public function sharePost(Request $request)
    {
        $post = Post::findOrFail($request->input('postId'));
        $post->shares = $post->shares + 1;
        $post->save();

        $usid = strval(Auth::id());
        $ptid = strval($post->post_id);
        app('App\Http\Controllers\TraitsRecombeeController')->postView($usid, $ptid);

        return response()->json(array('shareCount'=>$post->shares), 200);
    }
}

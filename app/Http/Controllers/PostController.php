<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use Session;
use Image;
use Log;
use App\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        //return view('posts.index')->with('posts', $posts);
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // validate the data
        // $this->validate($request, array(
        //   'body' => 'required'
        // ));

        // store in the database
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->body = $request->body;

        // save our image
        if ($request->get('image')) {
          $image = $request->get('image');
          $filename = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          $location = public_path('img/' . $filename);
          Image::make($image)->resize(400,400)->save($location);
          // save in databse
          $post->image = $filename;
        }
        // save our image code end

        $post->save();

        //return redirect()->route('posts.show', $post->id);
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      return view('posts.edit')->with('post', $post);
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
      // validate the data
      $this->validate($request, array(
        'body' => 'required'
      ));

      //save the data to database
      $post = Post::find($id);
      $post->body = $request->input('body');
      $post->save();

      return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        //return redirect()->route('posts.index');
        return 204;
    }

    // methods for get all post using vue
    public function getAllPosts()
    {
      //return $posts = Post::all();
      $posts = Post::with('user','likes')->orderBy('created_at', 'DESC')->get();
      return response()->json($posts);
    }

    // methods for get trending post using vue
    public function getTrendingPosts()
    {
      //return $posts = Post::all();
      $status = 1;
      return $posts = Post::with('user','likes')->where('trending', $status)->orderBy('created_at', 'DESC')->get();
    }

    // methods for get my post using vue
    public function getMyPosts()
    {
      //return $posts = Post::all();
      $userid = Auth::user()->id;
      return $posts = Post::with('user','likes')->where('user_id', $userid)->orderBy('created_at', 'DESC')->get();
    }

    // like and unlike using vue
    public function saveLike($id)
    {

      $likeusercheck = DB::table('likes')
                ->leftJoin('like_post', 'like_post.like_id', '=', 'likes.id')
                ->where([['likes.user_id',Auth::id()],['like_post.post_id',$id],])
                ->get();

      if ($likeusercheck->count()) {

        $likeusercheck = DB::table('likes')->where('user_id',Auth::id())->delete();
        return 'deleted';

      }
      else {

        $like = new Like;
        $like->user_id = Auth::id();
        $like->save();
        $like->posts()->sync($id, false);
      }


    }

    public function deletePost($id)
    {
      $post = Post::find($id);
      $post->delete();
      return $posts = Post::with('user','likes')->orderBy('created_at', 'DESC')->get();
    }


}

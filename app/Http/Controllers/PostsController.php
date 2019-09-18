<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        //latest() == orderBy('created_at','DESC')
        //$posts=Post::whereIn('user_id',$users)->latest()->get();
        //paginate(number of records in the page)
        //with('relationship name')
        $posts=Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);

//        $liked =auth()->user()->like->contains($_post->id);
       //$likes=$post->liked->count();
        //dd($posts);
        return view('posts.index',compact('posts'));
}
    public function show(Post $post)
    {
        //$_post = Post::findOrFail($post);
        $_post=$post;
        $follows = (auth()->user()) ? auth()->user()->following->contains($_post->user->id) : false;

        //$liked = ($_post->id) ? auth()->user()->like->contains($_post->id) : false;
        $liked =auth()->user()->like->contains($_post->id);
        $likes=$post->liked->count();
        return view('posts.show',compact('_post','follows','liked','likes'));
    }
    public function store()
    {
        $data = request()->validate([
            //'another'=>'',//another field doesn't require validation
            'caption' => 'required|min:3',
            //'image'=>'required|image',
            'image' => ['required', 'image'],
        ]);
//storing the image in uploads directory in public drive
        $imagePath = request('image')->store('uploads', 'public');
        //public_path() find the file directory
        //fit is to cut with required sizes
        $image = Image::make(public_path("storage/{$imagePath}" ))->fit(1200, 1200);
        $image->save();
        //store the image path in image field in data array
        $data['image'] = $imagePath;
        //add user id when you create new record in post table
        auth()->user()->posts()->create($data);

        //Post::create($data);
        // dd(request()->all());
        return redirect(route('profile.show',['profile'=>auth()->user()->username]));

    }


}

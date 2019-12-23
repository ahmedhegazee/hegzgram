<?php

namespace App\Http\Controllers;

use App\Post;
use App\ResourceType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function posts()
    {
        $users = auth()->user()->following()->pluck('followee')->toArray();
        //latest() == orderBy('created_at','DESC')
        //$posts=Post::whereIn('user_id',$users)->latest()->get();
        //paginate(number of records in the page)
        //with('relationship name')
        $id ="".auth()->user()->id;
//        dd($users);
        array_push($users,$id);


        $posts=Post::whereIn('user_id',$users)->with('user')->with('type')->latest()->get();
        return response()->json($posts);
    }
    public function index()
    {
        $users = auth()->user()->following()->pluck('followee')->toArray();
        //latest() == orderBy('created_at','DESC')
        //$posts=Post::whereIn('user_id',$users)->latest()->get();
        //paginate(number of records in the page)
        //with('relationship name')
        $id ="".auth()->user()->id;
//        dd($users);
        array_push($users,$id);


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
        if(auth()->user()!=null){
            $follows = (auth()->user()) ? auth()->user()->following->contains($_post->user->id) : false;

            //$liked = ($_post->id) ? auth()->user()->like->contains($_post->id) : false;
            $liked =auth()->user()->like->contains($_post->id);
        }else{
            $follows=false;
            $liked=false;
        }

        $likes=$post->liked->count();
        $comments = $post->comments;


        return view('posts.show',compact('_post','follows','liked','likes','comments'));
    }
    public function store()
    {




        $data = request()->validate([
            //'another'=>'',//another field doesn't require validation
            'caption' => 'required|min:3',
            //'image'=>'required|image',
            'resource' => 'required|file|mimes:jpeg,bmp,png,jpg,doc,docx,pdf,ppt,pptx,xls,xl,mp3,wav,ogg,mp4,webm,mkv|max:102400',
        ]);

        if (request()->file('resource')->getClientOriginalExtension() =="mp3")
        {
            $resourceType=ResourceType::where('name','audio')->first();
            $imagePath = request('resource')->store('uploads', 'public');
            $data['resource'] = "/storage/".$imagePath;
            //add user id when you create new record in post table
            $post =auth()->user()->posts()->create($data);
//        dd($type);
            $post->update(['resource_type_id'=>$resourceType->id]);
        }else{
            $mimeType=request()->file('resource')->getMimeType();
            $type=explode('/',$mimeType);
            if($type[0]=='application'){
                $arr =explode('.',$type[1]);
                $len=sizeof($arr);

                if($len>1){
                    $resourceType=ResourceType::where('name',$arr[$len-1])->first();

                }

                else
                {
                    $resourceType= ResourceType::where('name',$arr[0])->first();

                }
            }
            else{
                $resourceType=ResourceType::where('name',$type[0])->first();
            }
//storing the image in uploads directory in public drive
            $imagePath = request('resource')->store('uploads', 'public');
            //public_path() find the file directory
            //fit is to cut with required sizes
            if($type[0]=='image'){
                $image = Image::make(public_path("storage/{$imagePath}" ))->fit(1200, 1200);
                $image->save();
                //store the image path in image field in data array

            }
            $data['resource'] = "/storage/".$imagePath;
            //add user id when you create new record in post table
            $post =auth()->user()->posts()->create($data);
//        dd($type);
            $post->update(['resource_type_id'=>$resourceType->id]);
            //Post::create($data);
            // dd(request()->all());
        }

        return redirect(route('profile.show',['profile'=>auth()->user()->username]));

    }

    public function edit(Post $post)
    {
        return view('posts.update',compact('post'));
    }

    public function update(Request $request,Post $post)
    {
        $data = request()->validate([
            //'another'=>'',//another field doesn't require validation
            'caption' => 'required|min:3',
            //'image'=>'required|image',
            'image' => 'sometimes|image',
        ]);
        if($request->has('image')){
            if(isset($post->image)){
                unlink(public_path( $post->image));
            }
            $imagePath = request('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}" ))->fit(1200, 1200);
            $image->save();
            $data['image'] = "/storage/".$imagePath;
        }

        $post->update($data);

        return Redirect::action('PostsController@show',compact('post'));
    }

    public function destroy(Post $post)
    {
        foreach ($post->comments as $comment)
        {
            $comment->replies()->delete();
            $comment->delete();
        }
        $post->delete();
        return Redirect::action('PostsController@index');
    }
}

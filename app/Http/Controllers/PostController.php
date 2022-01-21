<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;

class PostController extends Controller
{

    public function index()
    {
        $posts =Post::latest()->with('user')->paginate(2);
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comment->count());
        }
        return response()->json($posts);
    }

    public function show(Post $post)
    {
        return response()->json([
            'id'=>$post->id,
            'slug'=>$post->slug,
            'body'=>$post->body,
            'added_at'=>$post->created_at->diffForHumans(),
            'comments_count'=>$post->comment->count(),
            'image'=>$post->image,
            'user'=>$post->user,
            'title'=>$post->title,
            'category'=>$post->category,
            'comments'=>$post->comment->map(function ($comment) 
            {
                return 
                [
                    'id'=>$comment->id,
                    'body'=>$comment->body,
                    'user'=>$comment->user,
                    'added_at'=>$comment->created_at->diffForHumans()
                ];
            })
        ]);
    }

    public function commentsFormatted($comments)
    {
        $new_comments = [];
        foreach($comments as $comment){
            array_push($new_comments,[
                'id'=>$comment->id,
                'body'=>$comment->body,
                'user'=>$comment->user,
                'added_at'=>$comment->created_at->diffForHumans()
            ]);
        }
        return $new_comments;
    }


    public function categoryPosts($slug)
    {
        $category = Category::whereSlug($slug)->first();
        $posts = Post::whereCategoryId($category->id)->with('user')->get();
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comment->count());
        }
        return response()->json($posts);
    }

    public function searchposts($query)
    {
        $posts = Post::where('title','like','%'.$query.'%')->with('user');

        $nbposts = count($posts->get());

        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comment->count());
        }
        $posts = $posts->paginate(intval($nbposts));
        return response()->json($posts);
    }

}

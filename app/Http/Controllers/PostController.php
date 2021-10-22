<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
//        $posts = Post::all();
//        if ( $request->has('archive') ) {
//            $posts = Post::onlyTrashed()->get();
//        }
        $posts = Post::with('user')
            ->when($request->has('archive'), function ($query) {
                    $query->onlyTrashed();
            })->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post archived');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostStoreRequest $request)
    {
        auth()->user()->posts()->create($request->validated());
        return redirect()->route('posts')->with('success', 'New post created.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Post restored');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        Post::onlyTrashed()->restore();
        return back()->with('success', 'All Posts restored');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('posts')->with('success', 'Post deleted forever.');
    }
}

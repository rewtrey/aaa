<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $user = $request->user();

        $blog = Blog::with('user')
            ->orderBy ('updated_at', 'DESC')
            ->paginate(5);

        return view('blogs.index', [
            'blogs' => $blog,
            'userEmail' => $user->email ?? null]);
    }

    public function create()
    {
        return view('blogs/create');
    }


    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

/*
    public function show($blogId)
    {
        $blog = Blog::query()
            ->where('id', '=', $blogId)
            ->first();

        return view('blogs.show',compact('blog'));
    }
*/

    public function edit(Blog $blog)
    {
        return view('blogs.edit',compact('blog'));
    }

    public function store(CreateBlogRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $blog = new Blog();
        $blog->user_id = $request->user()->id;
        $blog->title = $validated['title'];
        $blog->description = $validated['description'];
        $blog->slug = str_replace(' ','-',strtolower($blog->title));
        $blog->save();
        $blog->load('user');
        return redirect('/blogs');

    }

    public function update(UpdateBlogRequest $request, $blogId)
    {
        $blog = Blog::query()
            ->where('id', '=', $blogId)
            ->first();

        if ($blog->user_id == Auth::user()->id)

            if (!$blog) {
                return response()->json(['error' => 'Пост не знайдений з ID: ' . $blogId], Response::HTTP_NOT_FOUND);
            }

        $validated = $request->validated();

        $blog->title = $validated['title'] ?? $blog->title;
        $blog->description = $validated['description'] ?? $blog->description;
        $blog->save();

        return redirect()->route('blogs.index')
            ->with('success', 'Пост оновлено');
    }

    public function destroy($blogId)
    {
        $blog = Blog::query()
            ->where('id', '=', $blogId)
            ->first();

        if (!$blog) {
            return response()->json(['error' => 'Пост не знайдений з ID: ' . $blogId], Response::HTTP_NOT_FOUND);
        }

        $blog->delete();

        return redirect('/blogs')
            ->with('success', 'Пост видалено!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BlogController extends Controller
{

    public function adminIndex()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin_blog', compact('blogs'));
    }


    public function adminStore(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'is_published' => 'nullable|boolean',
        ]);


        $slug = Str::slug($data['title']);
        $original = $slug;
        $i = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }
        $data['slug'] = $slug;


        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('blogs', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published']) {
            $data['published_at'] = Carbon::now();
        }


        Blog::create($data);

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog published successfully!');
    }

    public function adminDelete($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->thumbnail && !Str::startsWith($blog->thumbnail, 'http')) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog deleted successfully!');
    }


    public function adminToggle($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_published = !$blog->is_published;

        if ($blog->is_published && !$blog->published_at) {
            $blog->published_at = Carbon::now();
        }

        $blog->save();

        $status = $blog->is_published ? 'published' : 'set to draft';

        return back()->with('success', "Blog {$status} successfully!");
    }



    public function apiIndex(Request $request)
    {
        $query = Blog::where('is_published', true)
            ->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(
                fn($q) =>
                $q->where('title', 'like', "%$s%")
                    ->orWhere('excerpt', 'like', "%$s%")
            );
        }

        $perPage = min((int) $request->get('per_page', 6), 24);
        $blogs = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $blogs->items(),
            'meta' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ],
        ]);
    }


    public function apiFeatured()
    {
        $blogs = Blog::where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return response()->json(['success' => true, 'data' => $blogs]);
    }

    public function apiCategories()
    {
        $cats = Blog::where('is_published', true)
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return response()->json(['success' => true, 'data' => $cats]);
    }


    public function apiShow($slug)
    {
        $blog = Blog::where('is_published', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Blog::where('is_published', true)
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blog,
            'related' => $related,
        ]);
    }

    public function adminEdit($id)
    {
        $blogs = Blog::latest()->paginate(10);

        $editBlog = Blog::findOrFail($id);

        return view('admin_blog', compact('blogs', 'editBlog'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('thumbnail')) {

            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')
                ->store('blogs', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $blog->update($data);

        return redirect()->route('admin.blogs')
            ->with('success', 'Blog updated successfully!');
    }
}
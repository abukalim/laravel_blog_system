<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show the form for creating a new blog post
    public function create()
    {
        return view('blogs.create');
    }

    // Store a newly created blog in storage
    public function store(Request $request)
    {
        $validatedData = $this->validateBlog($request);

        // Create the blog
        $blog = new Blog($validatedData);
        $blog->author_id = auth()->id(); // Link the blog to the authenticated user

        // Handle file upload if there is an image
        $this->handleImageUpload($request, $blog);

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    // Display a listing of the blogs
    public function index()
    {
        $blogs = Blog::with('author')->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    // Display a specific blog post
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    // Show the form for editing the specified blog
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    // Update the specified blog in storage
    public function update(Request $request, Blog $blog)
    {
        $validatedData = $this->validateBlog($request);

        // Update the blog with new data
        $blog->fill($validatedData);

        // Handle file upload if there is a new image
        $this->handleImageUpload($request, $blog, true); // true indicates an update

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Remove the specified blog from storage
    public function destroy(Blog $blog)
    {
        // Optionally delete the associated image
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // Validate blog input
    protected function validateBlog(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Handle image upload for blog posts
    protected function handleImageUpload(Request $request, Blog $blog, $isUpdate = false)
    {
        if ($request->hasFile('image')) {
            // Delete old image if updating
            if ($isUpdate && $blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $blog->image = $request->file('image')->store('images', 'public');
        }
    }
    public function welcome()
    {
        $posts = Blog::with('author')->latest()->take(5)->get(); // Fetch latest 5 posts
        return view('welcome', compact('posts')); // Pass the posts to the welcome view
    }
    
}

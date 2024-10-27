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

        // Create the blog and associate it with the authenticated user
        $blog = new Blog($validatedData);
        $blog->user_id = auth()->id(); // Use 'user_id' for clarity

        // Handle file upload if there is an image
        $this->handleImageUpload($request, $blog);

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    // Display a listing of the blogs
    public function index()
    {
        $blogs = Blog::with('user')->latest()->get(); // Use 'user' for clarity
        return view('blogs.index', compact('blogs'));
    }

    // Display a specific blog post with its comments
    public function show(Blog $blog)
    {
        // Load comments for the specific blog post
        $comments = $blog->comments()->with('user')->get();

        return view('blogs.show', compact('blog', 'comments'));
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

    // Fetch all posts for the welcome page
    public function welcome()
    {
        $posts = Blog::with('user')->latest()->get(); // Use 'user' for clarity
        return view('welcome', compact('posts')); // Pass the posts to the welcome view
    }
}

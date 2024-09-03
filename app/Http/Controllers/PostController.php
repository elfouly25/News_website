<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        $posts = Post::latest()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Search for posts based on title, content, writer, or section title
        $posts = Post::where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%")
              ->orWhere('writer', 'LIKE', "%{$query}%")
              ->orWhereHas('section', function($q) use ($query) {
                  $q->where('title', 'LIKE', "%{$query}%");
              });
        })
        ->orWhereDate('created_at', $query) // Allows searching by exact date
        ->paginate(5); // Adjust pagination as needed
    
        return view('home', compact('posts'));
    }


    // public function indexBySection($id)
    // {
    //     $sections = Section::orderBy('order')->get(); // Fetch all sections
    //     $posts = Post::where('section_id', $id)->paginate(10); // Fetch posts by section ID

    //     return view('posts.show', compact('sections', 'posts')); // Change 'posts.show' to 'posts.index'
    // }
    
    // creating a new post
    public function create()
    {
        $sections = Section::all();
        return view('posts.create', compact('sections'));
    }

    // Store a newly created post in storage
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'writer' => 'required|string|max:255',
        'section_id' => 'nullable|exists:sections,id',
        'new_section' => 'nullable|string|max:255|unique:sections,title', 
        'image' => 'nullable|image|max:5120', 
    ]);

    // Handle section logic
    if ($request->filled('new_section')) {
        // Check if the section already exists
        $section = Section::firstOrCreate(
            ['title' => $request->new_section],
            []
        );
        $sectionId = $section->id; 
    } else {
        $sectionId = $request->section_id; 
    }

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public'); // Store the image
    }

    // Create the new post
    $post = Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'writer' => $request->writer,
        'section_id' => $sectionId,
        'image' => $imagePath, // Save the image path
    ]);

    // Redirect to the home page after creating the post
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    // Display the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        $sections = Section::all();
        return view('posts.edit', compact('post', 'sections'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'writer' => 'required|string|max:255',
            'section_id' => 'nullable|exists:sections,id',
            'new_section' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);

        // Determine the section to be updated (existing or new)
        if ($request->input('new_section')) {
            $section = Section::create(['title' => $request->input('new_section')]);
            $validatedData['section_id'] = $section->id;
        }

        // Update post with validated data
        $post->update($validatedData);

        // Handle image update if a new image is provided
        $this->handleImageUpdate($request, $post);

        return redirect()->route('posts.index', $post)->with('success', 'Post updated successfully!');
    }

 // Remove the specified post from storage
    public function destroy(Post $post)
    {
        // Delete the image if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Delete the post
        $post->delete();

        // Redirect to the posts index with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
    // Handle image update during post edit
    private function handleImageUpdate(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image); 
            }

            $path = $request->file('image')->store('images', 'public');
            $post->update(['image' => $path]);
        }
    }

}

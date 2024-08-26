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
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        $sections = Section::all();
        return view('posts.create', compact('sections'));
    }

    // Store a newly created post in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'writer' => 'required|string|max:255',
            'section_id' => 'nullable|exists:sections,id',
            'new_section' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Determine the section to be used (existing or new)
        $section_id = $this->handleSection($request);

        // Handle the image upload if provided
        $imagePath = $this->handleImageUpload($request);

        // Create the post with the validated data
        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'writer' => $validatedData['writer'],
            'section_id' => $section_id,
            'image' => $imagePath,
        ]);

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

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Handle section creation or selection
    private function handleSection(Request $request)
    {
        if ($request->filled('new_section')) {
            $section = Section::create(['title' => $request->input('new_section')]);
            return $section->id;
        }

        return $request->input('section_id');
    }

    // Handle image upload
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('images', 'public');
        }

        return null;
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

//     public function destroy(Post $post)
//     {
//         if ($post->image) {
//             Storage::disk('public')->delete($post->image);
//         }
//         $post->delete();

//         return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
//     }
// }
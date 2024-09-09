<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%")
              ->orWhere('writer', 'LIKE', "%{$query}%")
              ->orWhereHas('section', function($q) use ($query) {
                  $q->where('title', 'LIKE', "%{$query}%");
              });
        })
        ->orWhereDate('created_at', $query)
        ->paginate(5);

        $sections = Section::orderBy('order')->get();
        return view('home', compact('posts', 'sections'));
    }

    public function indexBySection($id)
    {
        // Retrieve all sections ordered by 'order'
        $sections = Section::orderBy('order')->get();
        
        // Retrieve posts for the selected section
        $posts = Post::where('section_id', $id)->paginate(10);
        
        // Retrieve the specific section by ID
        $section = Section::findOrFail($id); // This will throw a 404 if the section is not found
    
        // Pass sections, posts, and the specific section to the view
        return view('posts.postsBySection', compact('sections', 'posts', 'section'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('posts.create', compact('sections'));
    }

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

        $sectionId = $request->filled('new_section') 
            ? Section::firstOrCreate(['title' => $request->new_section])->id 
            : $request->section_id;

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'writer' => $request->writer,
            'section_id' => $sectionId,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $sections = Section::orderBy('order')->get();
        return view('posts.show', compact('post', 'sections'));
    }

    public function edit(Post $post)
    {
        $sections = Section::all();
        return view('posts.edit', compact('post', 'sections'));
    }

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

        if ($request->input('new_section')) {
            $section = Section::create(['title' => $request->input('new_section')]);
            $validatedData['section_id'] = $section->id;
        }

        $post->update($validatedData);
        $this->handleImageUpdate($request, $post);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

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
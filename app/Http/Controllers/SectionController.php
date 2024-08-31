<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SectionController extends Controller
{
    // Display a listing of the sections
    public function index()
    {
        $sections = Section::paginate(5); // Change to paginate
        return view('sections.index', compact('sections'));
    }

    // Show the form for creating a new section
    public function create()
    {
        return view('sections.create');
    }

    // Store a newly created section in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:sections,title',
        ]);
    
        Section::create($request->only('title'));
    
        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }
    // Show the form for editing the specified section
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    // Update the specified section in the database
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:sections,title,' . $section->id,
        ]);
    
        $section->update($request->only('title'));
    
        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }
    

    // Remove the specified section from the database
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }
}


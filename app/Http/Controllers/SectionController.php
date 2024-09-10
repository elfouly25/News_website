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
        $sections = Section::orderBy('order')->paginate(6);
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

        $maxOrder = Section::max('order') + 1;

        Section::create([
            'title' => $request->title,
            'order' => $maxOrder,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    // Show the form for editing the specified section
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }
    // Show the form for editing the specified section
    public function translate(Section $section)
    {
        $translations  = $section->translation;
        return view('sections.translate', compact('section' , 'translations'));
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
    /* save translation  */
    public  function submitTranslation(Request $request , Section $section){
        // lang ar 
        $request->validate(
            [
                "title"=>'required'
            ]
        ) ;
        
        $section->translation()->updateOrCreate([
            'languageCode'   =>$request->languageCode,
        ],[
            'title'     => $request->get('title')
        ]);
            return redirect()->back()->with("success" , "translated successfully !");
      
    } 
    // Remove the specified section from the database
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }

    // Reorder sections
    public function reorder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            Section::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section; // Import the Section model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
        
    //     // get user lang 
    //     $cookie = 'ar';
    //     //set locale 
    //     app()->setLocale($cookie ?? 'en');

    // }
    public function index()
    {   
        // Fetch the latest posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(3); 
    
        // Fetch sections ordered by the 'order' column
        $sections = Section::orderBy('order')->get();
    
        // Pass both posts and sections to the view
        return view('home', [
            'posts' => $posts,
            'sections' => $sections // Pass sections to the view
        ]);
    }



}
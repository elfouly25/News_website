<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Import the Admin model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    // Show all admins
    public function index()
    {
        $subAdmins = Admin::paginate(6);// Fetch all admin accounts (or sub-admins if you have a separate model)
        return view('admin.subAdmins.admin-index', compact('subAdmins')); // Pass the data to the view
    }

    // Show the form to create a new admin
    public function create()
    {
        return view('admin.subAdmins.create-admin'); // Create this Blade view
    }

    // Store a newly created admin in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Login_email' => 'required|email|unique:admins,Login_email', // Changed to match the Admin model
            'password' => 'required|min:6|confirmed', // Ensure you have a password confirmation field
        ]);

        // Create a new admin
        Admin::create([
            'Login_email' => $request->Login_email, // Changed to match the Admin model
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin account created successfully.');
    }

    // Show the form to edit an admin
    public function edit($id)
    {
        $subAdmin = Admin::findOrFail($id); // Find the admin by ID
        return view('admin.subAdmins.edit-admin', compact('subAdmin')); // Pass the data to the view
    }
    
    // Update the specified admin in the database
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id); // Find the admin by ID

        // Validate the form data
        $request->validate([
            'Login_email' => 'required|email|unique:admins,Login_email,' . $admin->id, // Changed to match the Admin model
            'password' => 'nullable|min:6|confirmed', // Password is optional
        ]);

        // Update the admin details
        $admin->Login_email = $request->Login_email; // Changed to match the Admin model

        // Update password only if it's provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save(); // Save the changes

        return redirect()->route('admin.index')->with('success', 'Admin account updated successfully.');
    }

    // Delete the specified admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id); // Find the admin by ID
        $admin->delete(); // Delete the admin

        return redirect()->route('admin.index')->with('success', 'Admin account deleted successfully.');
    }
}
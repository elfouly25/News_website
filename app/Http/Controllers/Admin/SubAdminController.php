<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubAdmin; // Import the SubAdmin model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    // Show all sub-admins
    public function index()
    {
        $subAdmins = SubAdmin::all(); // Fetch all sub-admin accounts
        return view('admin.subAdmins.admin-index', compact('subAdmins')); // Pass the data to the view
    }

    // Show the form to create a new sub-admin
    public function create()
    {
        return view('admin.subAdmins.create-admin'); // Create this Blade view
    }

    // Store a newly created sub-admin in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email|unique:sub_admins,email',
            'password' => 'required|min:6|confirmed', // Ensure you have a password confirmation field
        ]);

        // Create a new sub-admin
        SubAdmin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('admin.index')->with('success', 'Sub-admin account created successfully.');
    }

    // Show the form to edit a sub-admin
    public function edit($id)
    {
        $subAdmin = SubAdmin::findOrFail($id); // Find the sub-admin by ID
        return view('admin.subAdmins.edit-admin', compact('subAdmin')); // Pass the data to the view
    }

    // Update the specified sub-admin in the database
    public function update(Request $request, $id)
    {
        $subAdmin = SubAdmin::findOrFail($id); // Find the sub-admin by ID

        // Validate the form data
        $request->validate([
            'email' => 'required|email|unique:sub_admins,email,' . $subAdmin->id,
            'password' => 'nullable|min:6|confirmed', // Password is optional
        ]);

        // Update the sub-admin details
        $subAdmin->email = $request->email;

        // Update password only if it's provided
        if ($request->filled('password')) {
            $subAdmin->password = Hash::make($request->password);
        }

        $subAdmin->save(); // Save the changes

        return redirect()->route('admin.index')->with('success', 'Sub-admin account updated successfully.');
    }

    // Delete the specified sub-admin
    public function destroy($id)
    {
        $subAdmin = SubAdmin::findOrFail($id); // Find the sub-admin by ID
        $subAdmin->delete(); // Delete the sub-admin

        return redirect()->route('admin.index')->with('success', 'Sub-admin account deleted successfully.');
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    // Show the dashboard and pass the user's name and role
    public function dashboard()
    {
        $user = Auth::user();
        return Inertia::render('Dashboard', [
            'userName' => $user->name,
            'userRole' => $user->role_id, // Pass the user's current role
        ]);
    }

    // Update the role of the user
    public function updateRole(Request $request)
    {
        $user = Auth::user();
        
        // Ensure role can only be set once
        if ($user->role_id === null) {
            $user->role_id = $request->role_id;
            $user->save();
        }

        return redirect()->route('dashboard'); // Redirect back to the dashboard
    }
}

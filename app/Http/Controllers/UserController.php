<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HikingTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Controleer of de gebruiker voldoende hiking trails heeft aangemaakt
        $requiredTrails = 5;
        $trailCount = HikingTrail::where('created_by', auth()->id())->count();

        if ($trailCount < $requiredTrails) {
            // Bereken hoeveel trails de admin nog moet aanmaken
            $remainingTrails = $requiredTrails - $trailCount;
            return redirect()->route('dashboard')->with('error', "Je moet nog $remainingTrails hiking trails aanmaken om toegang te krijgen tot de gebruikerspagina.");
        }

        // Als de gebruiker voldoende trails heeft, haal dan de gebruikers op
        $users = User::all();

        return view('admin.users.show', compact('users'));
    }

    public function editRole(User $user)
    {
        // Check access for editing roles
        $currentUser = Auth::user();

        if ($currentUser->role !== 1) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $trailCount = HikingTrail::where('created_by', $currentUser->id)->count();
        if ($trailCount < 5) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // If allowed, show the edit role form
        return view('admin.users.edit-role', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Access validation before updating the role
        $currentUser = Auth::user();

        if ($currentUser->role !== 1) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $trailCount = HikingTrail::where('created_by', $currentUser->id)->count();
        if ($trailCount < 5) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Validate and update the role
        $request->validate([
            'role' => 'required|integer',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.show')->with('success', 'User role updated successfully!');
    }
}


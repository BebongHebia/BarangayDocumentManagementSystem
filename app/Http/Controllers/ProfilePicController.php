<?php

namespace App\Http\Controllers;

use App\Models\ProfilePic;
use Illuminate\Http\Request;

class ProfilePicController extends Controller
{
    public function uploadImage(Request $request){
    // Validate the request
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        'userCode' => 'required'
    ]);

    // Check if file exists before trying to store
    if ($request->hasFile('image') && $request->file('image')->isValid()) {

        // Check if user already has a profile picture
        $existingProfilePic = ProfilePic::where('userCode', $request->userCode)->first();

        // If existing image found, delete the old file from storage
        if ($existingProfilePic) {
            // Delete old image file from storage
            if (\Storage::disk('public')->exists($existingProfilePic->path)) {
                \Storage::disk('public')->delete($existingProfilePic->path);
            }
        }

        // Store the new file
        $imagePath = $request->file('image')->store('profile-pics', 'public');

        // Get original filename
        $originalName = $request->file('image')->getClientOriginalName();

        // Update or create record
        ProfilePic::updateOrCreate(
            ['userCode' => $request->userCode], // Search condition
            [                                   // Values to update/create
                'fileName' => $originalName,
                'path' => $imagePath,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $existingProfilePic ? 'Profile picture updated successfully' : 'Profile picture uploaded successfully',
            'path' => asset('storage/' . $imagePath)
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'No valid file uploaded'
    ], 400);
}
}
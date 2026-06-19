<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffOfficialProfile;
use Illuminate\Support\Facades\Storage;

class StaffOfficialProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $staffOfficial = StaffOfficialProfile::where('code', $request->code)->first();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Store the file in public/staff_images directory
            $path = $file->storeAs('staff_images', $fileName, 'public');

            // Delete old image if exists
            if ($staffOfficial && $staffOfficial->path) {
                Storage::disk('public')->delete($staffOfficial->path);
            }

            // Create or update the record
            StaffOfficialProfile::updateOrCreate(
                ['code' => $request->code],
                [
                    'path' => $path,
                    'fileName' => $fileName
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'image_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded'
        ], 400);
    }
}

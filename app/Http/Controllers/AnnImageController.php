<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnImage;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class AnnImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'annCode' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $announcement = Announcement::where('code', $request->annCode)->first();
        
        if (!$announcement) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }

        // Check if image exists for this announcement
        $existingImage = AnnImage::where('code', $request->annCode)->first();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('announcement_images', $filename, 'public');

            if ($existingImage) {
                // Delete old image if exists
                if ($existingImage->path && Storage::disk('public')->exists($existingImage->path)) {
                    Storage::disk('public')->delete($existingImage->path);
                }
                
                // Update existing image
                $existingImage->update([
                    'file' => $filename,
                    'path' => $path
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Image updated successfully',
                    'image' => $path
                ]);
            } else {
                // Create new image
                $image = AnnImage::create([
                    'code' => $request->annCode,
                    'file' => $filename,
                    'path' => $path
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully',
                    'image' => $path
                ]);
            }
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function getImage($annId)
    {
        $announcement = Announcement::find($annId);
        
        if (!$announcement) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }

        $image = AnnImage::where('code', $announcement->code)->first();
        
        if ($image && $image->path) {
            return response()->json([
                'image_path' => Storage::url($image->path),
                'image_exists' => true
            ]);
        }

        return response()->json([
            'image_exists' => false
        ]);
    }
}
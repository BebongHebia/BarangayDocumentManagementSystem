<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActImage;
use App\Models\CalendarActivity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ActImageController extends Controller
{
    public function uploadImage(Request $request, $activityId)
    {
        try {
            // Log the request for debugging
            Log::info('Upload image request received', [
                'code' => $activityId,
                'has_file' => $request->hasFile('image')
            ]);

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Find the activity
            $activity = CalendarActivity::find($activityId);
            if (!$activity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Activity not found'
                ], 404);
            }

            // Check if there's already an image
            $existingImage = ActImage::where('code', $activityId)->first();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                // Generate a unique filename
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                
                // Store the file
                $path = $file->storeAs('calendar_activity_images', $fileName, 'public');
                
                // Check if file was stored successfully
                if (!$path) {
                    throw new \Exception('Failed to store file');
                }
                
                // Generate full URL
                $fullPath = asset('storage/' . $path);

                if ($existingImage) {
                    // Delete old file if exists
                    if ($existingImage->path) {
                        // Extract the path from the URL
                        $oldPath = str_replace(asset('storage/'), '', $existingImage->path);
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }
                    
                    // Update existing image
                    $existingImage->update([
                        'fileName' => $fileName,
                        'path' => $fullPath,
                    ]);
                    
                    $imageData = $existingImage;
                    $message = 'Image updated successfully';
                } else {
                    // Create new image record
                    $imageData = ActImage::create([
                        'code' => 'ACT_IMG_' . uniqid(),
                        'fileName' => $fileName,
                        'path' => $fullPath,
                        'code' => $activityId,
                    ]);
                    
                    $message = 'Image uploaded successfully';
                }

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'image_path' => $fullPath,
                    'image_data' => $imageData
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No image file provided'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Image upload error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error uploading image: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteImage($activityId)
    {
        try {
            $image = ActImage::where('code', $activityId)->first();
            
            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found'
                ], 404);
            }

            // Delete the file
            if ($image->path) {
                // Extract the path from the URL
                $oldPath = str_replace(asset('storage/'), '', $image->path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Delete the record
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Image delete error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
}
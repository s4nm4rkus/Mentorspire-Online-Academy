<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activities;
use App\Models\ActivityFilesDoc;
use App\Models\ActivityFilesImages;
use App\Models\ActivityFilesVideos;
use Illuminate\Support\Facades\Storage;


class ActivityFilesController extends Controller
{
        public function storeActivityFiles(Request $request)
    {
        try {
        
            $validatedData = $request->validate([
                'activity_doc_name' => 'required|string',
                'activity_doc' => 'required|file',
                'activity_id' => 'required|integer',
            ]);

            if ($request->hasFile('activity_doc')) {
            
                $doc = $request->file('activity_doc');
                
                $filename = uniqid() . '.' . $doc->getClientOriginalExtension();

            Storage::disk('r2')->put('activityfiles/documents/' . $filename, file_get_contents($doc));
            
                $url = Storage::disk('r2')->url('activityfiles/documents/' . $filename);

                ActivityFilesDoc::create([
                    'activity_doc_name' => $validatedData['activity_doc_name'],
                    // 'handout_image_name' => $image->getClientOriginalName(),
                    'activity_doc' => $url,
                    'activity_id' => $request->input('activity_id'),
                ]);
                return redirect()->back()->with('success', 'Activity document uploaded successfully.');
            }
            throw new \Exception('No document file found in the request.');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            \Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File upload failed: ' . $e->getMessage()]);
        }


        
    }
    // _____________________________________________________________________________________________________________________

    // Activity Images Attatchments
    public function storeActivityFilesImages(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'activity_image_name' => 'required|string',
                'activity_image' => 'required|file',
                'activity_id' => 'required|integer',
            ]);
    
            if ($request->hasFile('activity_image')) {
                $image = $request->file('activity_image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    
                // Store the image on Cloudflare R2
                Storage::disk('r2')->put('activityfiles/images/' . $filename, file_get_contents($image));
                
                // Get the URL to the stored image
                $url = Storage::disk('r2')->url('activityfiles/images/' . $filename);
    
                // Create a new record in the database
                ActivityFilesImages::create([
                    'activity_image_name' => $validatedData['activity_image_name'],
                    'activity_image' => $url,
                    'activity_id' => $validatedData['activity_id'],
                ]);
    
                return redirect()->back()->with('success', 'Activity image uploaded successfully.');
            }
    
            throw new \Exception('No image file found in the request.');
        } catch (\Throwable $e) {
            \Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File upload failed: ' . $e->getMessage()]);
        }
    }
    

    // _______________________________________________________________________________________________________________________ 

        // Activity Vidoes Attatchments
        public function storeActivityFilesVideos(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'activity_video_name' => 'required|string',
                'activity_video' => 'required|file',
                'activity_id' => 'required|integer',
            ]);

            // Check if a video file is present in the request
            if ($request->hasFile('activity_video')) {
                $video = $request->file('activity_video');
                $filename = uniqid() . '.' . $video->getClientOriginalExtension();  // Corrected the variable name from $image to $video

                // Store the video on Cloudflare R2
                Storage::disk('r2')->put('activityfiles/videos/' . $filename, file_get_contents($video));
                
                // Get the URL to the stored video
                $url = Storage::disk('r2')->url('activityfiles/videos/' . $filename);

                // Create a new record in the database
                ActivityFilesVideos::create([
                    'activity_video_name' => $validatedData['activity_video_name'],
                    'activity_video' => $url,
                    'activity_id' => $validatedData['activity_id'],
                ]);

                return redirect()->back()->with('success', 'Activity video uploaded successfully.');
            }

            throw new \Exception('No video file found in the request.');
        } catch (\Throwable $e) {
            \Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File upload failed: ' . $e->getMessage()]);
        }
    }

    
    // _______________________________________________________________________________________________________________________
    
    public function displayActivityFiles(Request $request, $id)
    {
        $activityfiles = ActivitiesFilesDoc::findOrFail($id);
        return view('pages.viewactivity', compact('activityfiles'));
    }

    public function displayActivityFilesImages(Request $request, $id)
    {
        $activityFileImage = ActivityFilesImages::findOrFail($id);
        return view('pages.viewactivity', compact('activityFilesImages'));
    }

    public function displayActivityFilesVideo(Request $request, $id)
    {
        $activityFileImage = ActivityFilesVideo::findOrFail($id);
        return view('pages.viewactivity', compact('activityFilesImages'));
    }

    // ________________________________________________________________________________________________________________________

    public function downloadActivityFileDoc($id)
    {
        try {
           
            $activityDoc = ActivityFilesDoc::findOrFail($id);
            $fileUrl = $activityDoc->activity_doc;
            $filePath = parse_url($fileUrl, PHP_URL_PATH);

            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');

            if (Storage::disk('r2')->exists($filePath)) {
                // Download the file from R2 storage
                return Storage::disk('r2')->download($filePath, basename($filePath));
            } else {
                // Log the error, use dd() to debug, and return an error message
                \Log::error('File not found on R2: ' . $filePath);
                dd('File not found on R2:', $filePath);
            }
            } catch (\Throwable $e) {
                // Log any exceptions that occur and return an error message
                \Log::error('File download failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'File download failed: ' . $e->getMessage()]);
            }
    }


    public function downloadActivityFileImage($id)
    {
        try {
           
            $activityImage = ActivityFilesImages::findOrFail($id);
            $fileUrl = $activityImage->activity_image;
            $filePath = parse_url($fileUrl, PHP_URL_PATH);

            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');

            if (Storage::disk('r2')->exists($filePath)) {
                // Download the file from R2 storage
                return Storage::disk('r2')->download($filePath, basename($filePath));
            } else {
                // Log the error, use dd() to debug, and return an error message
                \Log::error('File not found on R2: ' . $filePath);
                dd('File not found on R2:', $filePath);
            }
            } catch (\Throwable $e) {
                // Log any exceptions that occur and return an error message
                \Log::error('File download failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'File download failed: ' . $e->getMessage()]);
            }
    }


    public function downloadActivityFileVideo($id)
    {
        try {
           
            $activityVideo = ActivityFilesVideos::findOrFail($id);
            $fileUrl = $activityVideo->activity_image;
            $filePath = parse_url($fileUrl, PHP_URL_PATH);

            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');

            if (Storage::disk('r2')->exists($filePath)) {
                // Download the file from R2 storage
                return Storage::disk('r2')->download($filePath, basename($filePath));
            } else {
                // Log the error, use dd() to debug, and return an error message
                \Log::error('File not found on R2: ' . $filePath);
                dd('File not found on R2:', $filePath);
            }
            } catch (\Throwable $e) {
                // Log any exceptions that occur and return an error message
                \Log::error('File download failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'File download failed: ' . $e->getMessage()]);
            }
    }


    // ________________________________________________________________________________________________________________________
    public function DeleteActivityFile($id)
    {
        $activityfile = ActivityFilesDoc::findOrFail($id);
        // Delete the file from R2 storage
        if ($activityfile->file_url) {
            $filePath = str_replace(Storage::disk('r2')->url(''), '', $activityfile->file_url);
            Storage::disk('r2')->delete($filePath);
        }
        // Delete the record from the database
        $activityfile->delete();
        return redirect()->back()->with('success', 'Activity file deleted successfully.');
    }

    public function DeleteActivityFileImages($id)
    {
        $activityfile = ActivityFilesImages::findOrFail($id);
        // Delete the file from R2 storage
        if ($activityfile->file_url) {
            $filePath = str_replace(Storage::disk('r2')->url(''), '', $activityfile->file_url);
            Storage::disk('r2')->delete($filePath);
        }
        // Delete the record from the database
        $activityfile->delete();
        return redirect()->back()->with('success', 'Activity file deleted successfully.');
    }

    public function DeleteActivityFileVideos($id)
    {
        $activityfile = ActivityFilesVideos::findOrFail($id);
        // Delete the file from R2 storage
        if ($activityfile->file_url) {
            $filePath = str_replace(Storage::disk('r2')->url(''), '', $activityfile->file_url);
            Storage::disk('r2')->delete($filePath);
        }
        // Delete the record from the database
        $activityfile->delete();
        return redirect()->back()->with('success', 'Activity file deleted successfully.');
    }
 
}

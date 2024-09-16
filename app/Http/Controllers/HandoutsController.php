<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\DocumentHandouts;
use App\Models\ImageHandouts;
use App\Models\VideoHandouts;
use Illuminate\Support\Facades\Storage;



class HandoutsController extends Controller
{

    // store

    public function storeHandout(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'handout_file_title' => 'required|string',
                'handout_doc' => 'required|file|mimes:pdf,doc,docx|max:102400', // 20 MB limit
            ]);

            if ($request->hasFile('handout_doc')) {
         
                $doc = $request->file('handout_doc');
                
                $filename = uniqid() . '.' . $doc->getClientOriginalExtension();
    
               Storage::disk('r2')->put('handout/documents/' . $filename, file_get_contents($doc));
              
                $filePath = Storage::disk('r2')->url('handout/documents/' . $filename);
    
            // Store the file on Cloudflare R2
            // $filePath = $request->file('handout_doc')->store('handout/doc', 'r2');
    
            DocumentHandouts::create([
                'handout_file_title' => $validatedData['handout_file_title'],
                'handout_file_name' => $request->file('handout_doc')->getClientOriginalName(),
                'handout_doc' => $filePath,
                'course_id' => $request->input('course_id'),
            ]);
        }
    
            return redirect()->back()->with('success', 'Handout uploaded successfully.');
        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File upload failed: ' . $e->getMessage()]);
        }
    }


    public function storeImage(Request $request)
{
    try {
       
        $validatedData = $request->validate([
            'handout_image_title' => 'required|string',
            'handout_image' => 'required|file|mimes:jpeg,png,jpg,gif|max:102400',
            'course_id' => 'required|integer',
        ]);

        if ($request->hasFile('handout_image')) {
         
            $image = $request->file('handout_image');
            
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

           Storage::disk('r2')->put('handout/images/' . $filename, file_get_contents($image));
          
            $url = Storage::disk('r2')->url('handout/images/' . $filename);

            ImageHandouts::create([
                'handout_image_title' => $validatedData['handout_image_title'],
                'handout_image_name' => $image->getClientOriginalName(),
                'handout_image' => $url,
                'course_id' => $request->input('course_id'),
            ]);
            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }
        throw new \Exception('No image file found in the request.');
    } catch (\Throwable $e) {
        \Log::error('Image upload failed: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Image upload failed: ' . $e->getMessage()]);
    }
}


    public function storeVideo(Request $request)
    {

        try {
       
            $validatedData = $request->validate([
                'handout_video_title' => 'required|string',
                'handout_video' => 'required|file',
                'course_id' => 'required|integer',
            ]);
    
            if ($request->hasFile('handout_video')) {
             
                $video = $request->file('handout_video');
                
                $filename = uniqid() . '.' . $video->getClientOriginalExtension();
    
               Storage::disk('r2')->put('handout/videos/' . $filename, file_get_contents($video));
              
                $url = Storage::disk('r2')->url('handout/videos/' . $filename);
    
                VideoHandouts::create([
                    'handout_video_title' => $validatedData['handout_video_title'],
                    'handout_video_name' => $video->getClientOriginalName(),
                    'handout_video' => $url,
                    'course_id' => $request->input('course_id'),
                ]);
                return redirect()->back()->with('success', 'Video uploaded successfully.');
            }
            throw new \Exception('No video file found in the request.');
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            \Log::error('Video upload failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Video upload failed: ' . $e->getMessage()]);
        }
    }


    // display

        public function displayHandouts()
    {
        $handout = DocumentHandouts::findOrFail($id);
        return view('pages.viewcourse', compact('handout'));
    }

    public function displayHandoutsImage($id)
    {
        $imageHandout = ImageHandouts::findOrFail($id);
        return view('pages.viewcourse', compact('imageHandout'));
    }
        

    public function displayHandoutsVideos()
    {
        $vidhandouts = VideoHandouts::findOrFail($id);
        return view('pages.viewcourse', compact('vidhandouts'));
    }

    // delete

    public function DeleteDocument($id)
    {
        try {
            $docHandout = DocumentHandouts::findOrFail($id);
    
            // Extract the filename from the URL or use your stored filename column if you have one
            $filePath = parse_url($docHandout->handout_doc, PHP_URL_PATH); // Assuming `handout_image` is the URL
    
            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');
    
            // Delete the file from R2
            Storage::disk('r2')->delete($filePath);
    
            // Delete the database record
            $docHandout->delete();
    
            return redirect()->back()->with('success', 'Document deleted successfully.');
        } catch (\Throwable $e) {
            \Log::error('Document deletion failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Document deletion failed: ' . $e->getMessage()]);
        }
    }

    public function DeleteImage($id)
    {
        try {
            $imgHandout = ImageHandouts::findOrFail($id);
    
            // Extract the filename from the URL or use your stored filename column if you have one
            $filePath = parse_url($imgHandout->handout_image, PHP_URL_PATH); // Assuming `handout_image` is the URL
    
            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');
    
            // Delete the file from R2
            Storage::disk('r2')->delete($filePath);
    
            // Delete the database record
            $imgHandout->delete();
    
            return redirect()->back()->with('success', 'Image deleted successfully.');
        } catch (\Throwable $e) {
            \Log::error('Image deletion failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Image deletion failed: ' . $e->getMessage()]);
        }
    }

    public function DeleteVideo($id)
    {

        try {
            $vidHandout = VideoHandouts::findOrFail($id);
    
            // Extract the filename from the URL or use your stored filename column if you have one
            $filePath = parse_url($vidHandout->handout_video, PHP_URL_PATH); // Assuming `handout_image` is the URL
    
            // Remove the leading '/' from the path if present
            $filePath = ltrim($filePath, '/');
    
            // Delete the file from R2
            Storage::disk('r2')->delete($filePath);
    
            // Delete the database record
            $vidHandout->delete();
    
            return redirect()->back()->with('success', 'Video deleted successfully.');
        } catch (\Throwable $e) {
            \Log::error('Video deletion failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Video deletion failed: ' . $e->getMessage()]);
        }
    }

        public function downloadHandoutDoc($id)
    {
        try {
           
            $docHandout = DocumentHandouts::findOrFail($id);
            $fileUrl = $docHandout->handout_doc;
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

   public function downloadHandoutImage($id)
    {
        try {
                $imgHandout = ImageHandouts::findOrFail($id);
                $fileUrl = $imgHandout->handout_image;
                $filePath = parse_url($fileUrl, PHP_URL_PATH);

                $filePath = ltrim($filePath, '/');

                if (Storage::disk('r2')->exists($filePath)) {
                    return Storage::disk('r2')->download($filePath, basename($filePath));
                } else {
                    \Log::error('File not found on R2: ' . $filePath);
                    dd('File not found on R2:', $filePath);
                }
        } catch (\Throwable $e) {
            \Log::error('File download failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File download failed: ' . $e->getMessage()]);
        }
    }



    public function downloadHandoutVideo($id)
    {
        try {
                $vidHandout = VideoHandouts::findOrFail($id);
                $fileUrl = $vidHandout->handout_video;
                $filePath = parse_url($fileUrl, PHP_URL_PATH);
                $filePath = ltrim($filePath, '/');

                if (Storage::disk('r2')->exists($filePath)) {
                
                    return Storage::disk('r2')->download($filePath, basename($filePath));
                } else {
                
                    \Log::error('File not found on R2: ' . $filePath);
                    dd('File not found on R2:', $filePath);
                }
        } catch (\Throwable $e) {
            // Log any exceptions that occur and return an error message
            \Log::error('File download failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'File download failed: ' . $e->getMessage()]);
        }
    }



}

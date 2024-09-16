<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Activities;
use App\Models\User;
use App\Models\DocumentHandouts;
use App\Models\ImageHandouts;
use App\Models\VideoHandouts;
use App\Models\ActivityState;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class CoursesController extends Controller
{
    // Store a new course
public function StoreCourse(Request $request)
{
    $validatedData = $request->validate([
        'course_poster' => 'required|file|mimes:jpeg,png,jpg,gif|max:102400',
        'course_title' => 'required|string',
        'course_code' => 'required|string',
        'course_description' => 'required|string',
    ]);
    
    if ($request->hasFile('course_poster')) {
        $image = $request->file('course_poster');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    
        // Store the image in Cloudflare R2
        Storage::disk('r2')->put('courseposters/' . $filename, file_get_contents($image));
    
        // Get the URL to the stored image
        $url = Storage::disk('r2')->url('courseposters/' . $filename);
    
        // Create the course record in the database
        $course = Courses::create([
            'course_poster' => $url,
            'course_title' => $validatedData['course_title'],
            'course_code' => $validatedData['course_code'],
            'course_description' => $validatedData['course_description'],
            'progress_activity' => 0,
        ]);
        
        $totalActivities = Activities::where('course_id', $course->id)->count();

        $course->update(['progress_activity' => $totalActivities]);

        return redirect()->route('home')->with('success', 'Course created successfully.');
    }

    return redirect()->back()->withErrors(['error' => 'No course poster image found in the request.']);
}

    // Edit an existing course
    public function EditCourse($id)
    {
        $courses = Courses::findOrFail($id);
        $users = User::where('role', '!=', 'admin')->get();
        $students = $courses->users;
        $user = Auth::user();

        return view('pages.admin.editcourse', compact('courses', 'users', 'students', 'user'));
    }

    // Update an existing course
    public function UpdateCourse(Request $request, $id)
    {
        $courses = Courses::findOrFail($id);

        if ($request->hasFile('course_poster')) {
            // Store the new poster in R2 storage
            $image = $request->file('course_poster');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $posterPath = Storage::disk('r2')->put('courseposter/' . $filename, file_get_contents($image));
        
            // Delete the old poster from R2 storage, if it exists
            if ($courses->course_poster) {
                $oldPosterPath = str_replace(Storage::disk('r2')->url(''), '', $courses->course_poster);
                Storage::disk('r2')->delete($oldPosterPath);
            }
        
            // Update the course poster URL in the database
            $courses->course_poster = Storage::disk('r2')->url('courseposter/' . $filename);
            $courses->save();
        }
        
        // Update the course details
        if (!$request->hasFile('course_poster')) {
            $courses->update($request->all());
        } else {
            $courses->update($request->except('course_poster'));
        }
        
        $course_id = $courses->id;
        $activities = Activities::where('course_id', $id)->get();
        $activity = Activities::where('course_id', $id)->first();
        $handouts = DocumentHandouts::where('course_id', $id)->get();
        $imghandouts = ImageHandouts::where('course_id', $id)->get();
        $vidhandouts = VideoHandouts::where('course_id', $id)->get();
        $users = User::where('role', '!=', 'admin')->get();
        $students = $courses->users;

        $user = Auth::user();
        return view('pages.viewcourse', compact('courses', 'course_id', 'activities', 'activity', 'handouts', 'users', 'students', 'imghandouts', 'vidhandouts', 'user'));
    }

    // Delete a course

    public function DeleteCourse($id)
{
    $course = Courses::findOrFail($id);
    $course->Activities()->delete();

    // Delete associated document handouts
    $course->DocumentHandouts()->each(function ($document) {
        // Delete the document file from R2
        if ($document->handout_doc) {
            $documentPath = str_replace(Storage::disk('r2')->url(''), '', $document->handout_doc);
            Storage::disk('r2')->delete($documentPath);
        }
        $document->delete();
    });

    // Delete associated image handouts
    $course->ImageHandouts()->each(function ($imageHandout) {
        // Delete the image file from R2
        if ($imageHandout->handout_image) {
            $imagePath = str_replace(Storage::disk('r2')->url(''), '', $imageHandout->handout_image);
            Storage::disk('r2')->delete($imagePath);
        }
        $imageHandout->delete();
    });

    // Delete associated video handouts
    $course->VideoHandouts()->each(function ($videoHandout) {
        // Delete the video file from R2
        if ($videoHandout->handout_video) {
            $videoPath = str_replace(Storage::disk('r2')->url(''), '', $videoHandout->handout_video);
            Storage::disk('r2')->delete($videoPath);
        }
        $videoHandout->delete();
    });

    // Delete the course poster from R2, if it exists
    if ($course->course_poster) {
        $posterPath = str_replace(Storage::disk('r2')->url(''), '', $course->course_poster);
        Storage::disk('r2')->delete($posterPath);
    }
    $course->delete();

    return redirect()->route('home')->with('success', 'Course deleted successfully.');
}


    public function viewCourse(Request $request, $id)
{
    $courses = Courses::findOrFail($id);
    $course_id = $courses->id;

    // Define $totalActivities
    $totalActivities = Activities::where('course_id', $id)->count(); // Counts all activities for the course

    // Define $completedActivities
    $user = Auth::user();
    $completedActivities = ActivityState::where('user_id', $user->id)
        ->whereHas('activity', function ($query) use ($course_id) {
            $query->where('course_id', $course_id);
        })
        ->where('completed', true)
        ->count(); // Counts completed activities for the course by the user

    // Calculate $progress
    $progress = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0; // Percentage of progress

    // Determine if the user is enrolled and if progress is complete
    $isEnrolled = $user->courses->contains($courses);
    $isProgressComplete = $totalActivities > 0 && $completedActivities >= $totalActivities;

    // Fetch related data
    $activities = Activities::where('course_id', $id)->get();
    $activity = Activities::where('course_id', $id)->first();
    $handouts = DocumentHandouts::where('course_id', $id)->get();
    $imghandouts = ImageHandouts::where('course_id', $id)->get();
    $vidhandouts = VideoHandouts::where('course_id', $id)->get();
    $users = User::where('role', '!=', 'admin')->get();
    $students = $courses->users;

    // Return view with variables
    return view('pages.viewcourse', compact(
        'courses', 
        'activities', 
        'activity', 
        'course_id', 
        'totalActivities',  
        'completedActivities',  
        'progress',  // Pass $progress to the view
        'handouts', 
        'imghandouts', 
        'vidhandouts', 
        'users', 
        'students', 
        'user',
        'isEnrolled',  // Pass enrollment status to the view
        'isProgressComplete'  // Pass progress completion status to the view
    ));
}
public function showCertificate($id)
{
    $user = Auth::user(); // Get the authenticated user
    $course = Courses::findOrFail($id);

    // Get the completion date and other necessary information
    $completionDate = ActivityState::where('user_id', $user->id)
        ->whereHas('activity', function ($query) use ($id) {
            $query->where('course_id', $id);
        })
        ->where('completed', true)
        ->latest('updated_at') // Assuming the latest completion date
        ->pluck('updated_at')
        ->first();

    // If no completion date is found, redirect or handle accordingly
    if (!$completionDate) {
        return redirect()->route('home')->with('error', 'No completion record found.');
    }

    return view('pages.certificate', [
       'student' => $user,            // Correctly pass the authenticated user
        'courses' => $course,
        'completionDate' => $completionDate
    ]);
}




}

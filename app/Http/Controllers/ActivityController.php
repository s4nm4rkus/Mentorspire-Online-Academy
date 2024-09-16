<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activities;
use App\Models\Courses;
use App\Models\User;
use App\Models\ActivityFilesDoc;
use App\Models\ActivityFilesImages;
use App\Models\ActivityFilesVideos;
use App\Models\DocumentHandouts;
use App\Models\ImageHandouts;
use App\Models\VideoHandouts;


class ActivityController extends Controller
{

    // public function AddActivity() {
    //     $activities = Activities::all();
    //     return view ('pages.viewcourse', compact('activities'));
    // }

    public function StoreActivity(Request $request){
        Activities::create([
            'activity_number' => $request -> input('activity_number'),
            'activity_title' => $request -> input('activity_title'),
            'activity_description' => $request -> input ('activity_description'),
            'course_id' => $request->input('course_id'),
        ]);

        $courseId = $request->input('course_id');
        $totalActivities = Activities::where('course_id', $courseId)->count();

        // Update the course with the total number of activities
        Courses::where('id', $courseId)->update(['progress_activity' => $totalActivities]);
        return back();
        }

    public function getActivity(Request $request, $id)
    {
        $course = Courses::find($id);
        $activities = Activities::findOrFail($id);
        $activity_id = $activities->id;
        $activityfiles = ActivityFilesDoc::where('activity_id', $id)->get();
        $activityfilesimages = ActivityFilesImages::where('activity_id', $id)->get();
        $activityfilesvideos = ActivityFilesVideos::where('activity_id', $id)->get();
     return view('pages.viewactivity', compact('activities', 'course', 'activity_id', 'activityfiles', 'activityfilesimages',  'activityfilesvideos'));
    }

    public function EditActivity($id)
    {
        $activity = Activities::findOrFail($id);
        return view('pages.admin.editactivity', compact('activity'));
    } 

    public function UpdateActivity(Request $request, $id) {

        $activity = Activities::findOrFail($id);
        $activity->update($request->except('course_id'));
        return redirect()->route('home');
    }

    public function DeleteActivity($id)
    {
        $activity = Activities::findOrFail($id);
        $activity->ActivityFilesDoc()->delete();
        $activity->ActivityFilesImages()->delete();
        $activity->ActivityFilesVideos()->delete();
        $activity->delete();
        return redirect()->back();
    }

//     public function updateState(Request $request)
// {
//     try {
//         $activityState = ActivityState::updateOrCreate(
//             [
//                 'user_id' => $request->user_id,
//                 'activity_id' => $request->activity_id,
//             ],
//             [
//                 'completed' => $request->completed,
//             ]
//         );

//         // Calculate the progress
//         $user = User::find($request->user_id);
//         $totalActivities = $user->activities->count();
//         $completedActivities = $user->activityStates->where('completed', true)->count();
//         $percentage = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;

//         return response()->json([
//             'success' => true,
//             'percentage' => $percentage,
//             'completedActivities' => $completedActivities,
//             'totalActivities' => $totalActivities,
//         ]);
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
//     }
// }


// public function updateActivityState(Request $request)
// {
//     $userId = $request->input('user_id');
//     $activityId = $request->input('activity_id');
//     $completed = $request->input('completed');

//     // Find the user and activity
//     $user = User::findOrFail($userId);
//     $activity = Activities::findOrFail($activityId);

//     // Update or create the activity state
//     $user->activityStates()->updateOrCreate(
//         ['activity_id' => $activity->id],
//         ['completed' => $completed]
//     );

//     // Calculate the new progress values
//     $totalActivities = $activity->count();
//     $completedActivities = $user->activityStates()->where('completed', true)->count();
//     $percentage = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;

//     // Optionally, you could flash a message to the session for feedback
//     session()->flash('status', 'Activity status updated successfully.');

//     // Redirect back to the previous page
//     return redirect()->back();
// }

public function updateActivityState(Request $request)
{
    $userId = $request->input('user_id');
    $activityId = $request->input('activity_id');
    $courseId = $request->input('course_id'); // Add this line
    $completed = $request->input('completed');

    // Find the user, course, and activity
    $user = User::findOrFail($userId);
    $course = Courses::findOrFail($courseId); // Add this line
    $activity = Activities::where('id', $activityId)->where('course_id', $courseId)->firstOrFail(); // Modify this line

    // Update or create the activity state
    $user->activityStates()->updateOrCreate(
        ['activity_id' => $activity->id, 'course_id' => $course->id], // Modify this line
        ['completed' => $completed]
    );

    // Calculate the new progress values based on the specific course
    $totalActivities = $course->activities()->count(); // Modify this line
    $completedActivities = $user->activityStates()
        ->where('course_id', $course->id) // Modify this line
        ->where('completed', true)
        ->count();

    $percentage = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;

    // Optionally, flash a message to the session for feedback
    session()->flash('status', 'Activity status updated successfully.');

    // Redirect back to the previous page
    return redirect()->back();
}

    
    
}

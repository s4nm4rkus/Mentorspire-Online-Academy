<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityState;
use App\Models\User;
use App\Models\Activities;

class ActivityStateController extends Controller
{
    public function updateState(Request $request)
    {
        $userId = $request->input('user_id');
        $activityId = $request->input('activity_id');
        $completed = $request->input('completed');
    
        // Find or create the activity state record
        $activityState = ActivityState::updateOrCreate(
            ['user_id' => $userId, 'activity_id' => $activityId],
            ['completed' => $completed]
        );
    
        // Get the course ID from the activity
        $activity = Activities::find($activityId);
        if (!$activity) {
            return response()->json(['success' => false, 'message' => 'Activity not found.'], 404);
        }
        $courseId = $activity->course_id;
    
        // Calculate progress for the specific course
        $totalActivities = Activities::where('course_id', $courseId)->count();
        $completedActivities = ActivityState::where('user_id', $userId)
            ->whereHas('activity', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->where('completed', true)
            ->count();
    
        $percentage = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;
    
        return response()->json([
            'completed' => $completedActivities,
            'total' => $totalActivities,
            'percentage' => $percentage,
        ]);
    }
    
    
}

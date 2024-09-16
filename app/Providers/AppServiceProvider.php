<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; 
use App\Models\Activities; 
use App\Models\Courses; // Import your Course model
use App\Models\ActivityState; // Import your ActivityState model

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
    
     */
    public function boot()
    {
        // // Share user progress with all views
        // View::composer('*', function ($view) {
        //     // Get the authenticated user
        //     $student = Auth::user();

        //     // Default progress values
        //     $progress = 0;
        //     $totalActivities = 0;
        //     $completedActivities = 0;

        //     if ($student) {
        //         // Get the specific course ID dynamically or set it here
        //         $course_id = 1; // Replace with the actual course ID

        //         // Calculate total activities for the specific course
        //         $totalActivities = Activities::where('course_id', $course_id)->count();

        //         // Calculate completed activities for the specific course and user
        //         $completedActivities = $student->activityStates()
        //             ->where('course_id', $course_id)
        //             ->where('completed', true)
        //             ->count();

        //         // Calculate the percentage of completed activities
        //         $progress = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;
        //     }

        //     // Share data with all views
        //     $view->with([
        //         'progress' => $progress,
        //         'totalActivities' => $totalActivities,
        //         'completedActivities' => $completedActivities,
        //     ]);
        // });

       // Share user progress with all views
       View::composer('*', function ($view) {
        $student = Auth::user();

        // Initialize an array to hold course progress
        $courseProgress = [];

        if ($student) {
            // Get all courses for the authenticated user
            $courses = $student->courses;

            foreach ($courses as $course) {
                // Calculate total activities for the current course
                $totalActivities = $course->activities->count();

                // Calculate completed activities for the current course and user
                $completedActivities = $student->activityStates()
                    ->where('course_id', $course->id)
                    ->where('completed', true)
                    ->count();

                // Calculate the percentage of completed activities
                $progress = $totalActivities > 0 ? ($completedActivities / $totalActivities) * 100 : 0;

                // Store progress data in the array
                $courseProgress[] = [
                    'course' => $course,
                    'progress' => $progress,
                    'completedActivities' => $completedActivities,
                    'totalActivities' => $totalActivities,
                ];
            }
        }

        // Share data with all views
        $view->with('courseProgress', $courseProgress);
        $view->with('user', $student);
    });
}
}

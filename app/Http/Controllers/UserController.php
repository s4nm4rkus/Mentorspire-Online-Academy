<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Activities;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    // Fetch all users except those with the 'admin' role
    $users = User::where('role', '!=', 'admin')->get();

    dd($users); // Check if $users are retrieved correctly

    return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view to create a new user
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required', // Adjust validation rules as per your needs
        ]);

        // Create the user
        $user = User::create($validatedData);

        // Optionally, you might want to send a notification, etc.

        // Redirect to a route or return a response
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Show user details
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Show edit form
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required', // Adjust validation rules as per your needs
        ]);

        // Update the user
        $user->update($validatedData);

        // Redirect to a route or return a response
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect to a route or return a response
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    
//     public function enrollCourse(Request $request)
// {
//     $request->validate([
//         'course_code' => 'required|string',
//     ]);

//     $user = Auth::user();
//     $user->course_code = $request->course_code;
//     $user->save();

//     return redirect()->back()->with('success', 'Course code added successfully.');
// }
  // Method to save course codes for a user
  public function submitCourseCode(Request $request)
  {
      $request->validate([
          'course_code' => 'required|string|max:255',
      ]);

      $user = Auth::user(); // Retrieve the authenticated user
      $course = Courses::where('course_code', $request->course_code)->firstOrFail(); // Find the course by code

      // Attach the course to the user
      $user->courses()->attach($course->id);

      return redirect()->back()->with('success', 'Enrolled in course successfully.');
  }
  
  public function enrollUserInCourse(Request $request, $courseCode)
  {
      $user = Auth::user();
      $course = Course::where('course_code', $courseCode)->firstOrFail();

      // Attach the user to the course (enroll user)
      $user->courses()->attach($course->id);

      return redirect()->back()->with('success', 'Enrolled in course successfully.');
  }

  // Method to handle dropping a course
  public function dropCourse(Request $request)
  {
      $user = auth()->user();
      $courseId = $request->courseId;

      // Detach the course from the user
      $user->courses()->detach($courseId);

      // You can perform additional actions here, such as sending notifications, etc.

      return response()->json(['success' => true]);
  }

  public function updateProgress(Request $request)
{
    $userId = $request->input('userId');
    $progress = $request->input('progress');

    // Find the user and update their progress
    $user = User::find($userId);
    if ($user) {
        $user->progress = $progress;
        $user->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses; 
use App\Models\User;
use Intervention\Image\Facades\Image; // Import Intervention Image
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function downloadCertificate($id)
    {
        // Retrieve the user
        $user = User::find($id);
        if (!$user) {
            return abort(404, 'User not found');
        }

        // Retrieve the course
        $course = Courses::find($user->course_id);
        if (!$course) {
            return abort(404, 'Course not found');
        }

        // Get completion date
        $completionDate = $user->completion_date;
        if (!$completionDate) {
            return abort(404, 'Completion date not found');
        }

        // Create the certificate image
        $img = Image::make(public_path('images/certificate-bg.png')); // Background image

        // Add course title
        $img->text($course->course_title, 400, 250, function ($font) {
            $font->file(public_path('fonts/Inter-Bold.ttf'));
            $font->size(35);
            $font->color('#0C517B');
            $font->align('center');
            $font->valign('middle');
        });

        // Add student name
        $img->text("{$user->firstname} {$user->lastname}", 400, 300, function ($font) {
            $font->file(public_path('fonts/Inter-Bold.ttf'));
            $font->size(33);
            $font->color('#0C517B');
            $font->align('center');
            $font->valign('middle');
        });

        // Add completion date
        $img->text('Completed on ' . $completionDate->format('F j, Y'), 400, 350, function ($font) {
            $font->file(public_path('fonts/Inter-Regular.ttf'));
            $font->size(15);
            $font->color('#333');
            $font->align('center');
            $font->valign('middle');
        });

        // Save the image
        $fileName = "Certificate_{$user->firstname}_{$user->lastname}.png";
        $filePath = "public/certificate/{$fileName}";
        $img->save(storage_path("app/{$filePath}"));

        // Return the image file as download
        return response()->download(storage_path("app/{$filePath}"));
    }
}

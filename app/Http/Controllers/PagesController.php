<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SleepMonitoring;
use App\Models\BlogsAndNews;
use App\Models\Courses;

class PagesController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }
    public function testingpage()
    {
        return view('pages.admin.testingpage');
    }

    public function contactus()
    {
        return view('pages.contactus');
    }

    public function termsAndConditions()
    {
        return view('pages.terms_and_conditions');
    }

    public function privacyPolicy()
    {
        return view('pages.privacy_policy');
    }
    public function blogsAndNews()
    {
        $defaultBlogsAndNews = BlogsAndNews::where('is_default', 1)->first();

        return view('pages.blogs_and_news', compact('defaultBlogsAndNews'));
    }

    public function activityReports()
    {
        return view('pages.activity_reports');
    }

    public function home()
    {
        $courses = Courses::all();
        return view('pages.home', compact('courses'));
    }

    public function verifyemail() {
        return view ('auth.verify');
    }
    
}


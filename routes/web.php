<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SleepMonitoringController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\BlogsAndNewsController;
use App\Http\Controllers\ActivityReportController;
use App\Http\Controllers\IotDataController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HandoutsController;
use App\Http\Controllers\ActivityFilesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes((['verify' => true]));

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Email Verification Routes
Route::get('/verify', function () {
    return view('auth.verify');
})->name('verify');
Route::get('/home', 'HomeController@index')->middleware(['auth', 'verified']);

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification_resend');

// Routes accessible only for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/home', [PagesController::class, 'home'])->name('home');
    Route::get('/monthlysleepdata', [SleepMonitoringController::class, 'monthlySleepDataChart'])->name('sm_monthly');
    Route::get('/sleep-monitorings/start-monitor', [SleepMonitoringController::class, 'startMonitor'])->name('sleep_monitorings.start_monitor');
    Route::get('/sleep-monitorings/stop-monitor', [SleepMonitoringController::class, 'stopMonitor'])->name('sleep_monitorings.stop_monitor');
    Route::get('/sleep-monitorings/charts', [SleepMonitoringController::class, 'getChartsData'])->name('sleep_monitorings.charts');
    Route::get('/sleep-monitorings/user/latest', [SleepMonitoringController::class, 'getUserLatestSleepData'])->name('sleep_monitorings.user_latest');
    Route::get('/monthlysleepdata', [SleepMonitoringController::class, 'monthlySleepDataChart'])->name('sm_monthly');
    Route::post('/home', [SleepMonitoringController::class, 'store'])->name('store');
    Route::post('/update-serial-key/{id}', [SleepMonitoringController::class, 'updateSerialKey'])->name('sleep_monitorings.update_serial_key');
    Route::post('/read-notification', [SleepMonitoringController::class, 'readNotification'])->name('read_notification');


    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
        Route::get('/blogs-and-news', [BlogsAndNewsController::class, 'blogsAndNews'])->name('admin.blogs_and_news');
        Route::get('/get-blogs-and-news', [BlogsAndNewsController::class, 'getBlogsAndNews'])->name('admin.blogs_and_news.get');
        Route::post('/blogs-and-news', [BlogsAndNewsController::class, 'store'])->name('admin.blogs_and_news.store');
        Route::put('/blogs-and-news/{id}', [BlogsAndNewsController::class, 'update'])->name('admin.blogs_and_news.update');
        Route::get('/blogs-and-news/{id}/edit', [BlogsAndNewsController::class, 'edit'])->name('admin.blogs_and_news.edit');
        Route::delete('/blogs-and-news/{id}', [BlogsAndNewsController::class, 'destroy'])->name('admin.blogs_and_news.delete');

    });

    Route::get('/get-iot-data', [IotDataController::class, 'getIotData'])->name('iot_data.get');

    Route::get('/activity-reports', [ActivityReportController::class, 'activityReports'])->name('activity_reports')->middleware('isNotAdmin');
    Route::get('/get-activity-reports', [ActivityReportController::class, 'getActivityReports'])->name('activity_reports.get')->middleware('isNotAdmin');
    Route::get('/get-activity-reports-dates', [ActivityReportController::class, 'getActivityReportsDates'])->name('activity_reports_date.get')->middleware('isNotAdmin');
    Route::delete('/activity-reports/{date}', [ActivityReportController::class, 'destroy'])->name('activity_reports_date.delete')->middleware('isNotAdmin');

    Route::get('/contact-us', [ContactUsController::class, 'contactUs'])->name('contact_us');
    Route::get('/get-contact-us', [ContactUsController::class, 'getContactUs'])->name('contact_us.get');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact_us.delete');


    // Route::get('/test-email', function () {
    //     $user =  auth()->user();
    //     $user->sendAbnormalityDetectedNotification($user->unreadNotifications);
    //     Mail::to('bryanjc.bahala@gmail.com')->send(new EmailAbormalityDetected($notifications));
    //     // $email = $user->sendAbnormalityDetectedNotification([]);
    // })->name('test-email');
});

//


// Routes accessible to users -------------------------------------------------------------------------------------------------------------------------------
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contactus', [PagesController::class, 'contactus'])->name('contactus');
Route::get('/terms-and-conditions', [PagesController::class, 'termsAndConditions'])->name('terms_and_conditions');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy_policy');
Route::get('/blogs-and-news', [PagesController::class, 'blogsAndNews'])->name('blogs_and_news');
Route::get('/testingpage', [PagesController::class, 'testingpage'])->name('testingpage');
Route::get('/verify/email', [PagesController::class, 'verifyemail'])->name('verify-email');


Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact_us.store');
Route::get('/addcourse', [HomeController::class, 'createcourse'])->name('createcourse');

Route::post('/createcourse', [CoursesController::class, 'StoreCourse'])->name('course.store');
Route::get('/course/{id}', [CoursesController::class, 'ViewCourse'])->name('course.show');
Route::get('/course/{id}/edit', [CoursesController::class, 'EditCourse'])->name('edit.course');
Route::put('/course{id}', [CoursesController::class, 'UpdateCourse'])->name('update.course');
Route::delete('/course/{id}', [CoursesController::class, 'DeleteCourse'])->name('delete');



Route::post('/addActivity', [ActivityController::class, 'StoreActivity'])->name('activity.store');
Route::get('/course/activity/{id}/edit', [ActivityController::class, 'EditActivity'])->name('edit.course.activity');
Route::put('/course{id}/update-activity', [ActivityController::class, 'UpdateActivity'])->name('update.activity');
Route::get('/course/activity/{id}', [ActivityController::class, 'getActivity'])->name('view.activity');
Route::delete('/activity/{id}', [ActivityController::class, 'DeleteActivity'])->name('delete.activity');


Route::post('/upload/document',  [HandoutsController::class, 'storeHandout'])->name('handout.upload');
Route::post('/upload/image',  [HandoutsController::class, 'storeImage'])->name('handout.upload.image');
Route::post('/upload/video',  [HandoutsController::class, 'storeVideo'])->name('handout.upload.video');
Route::get('/file/documents/{id}',  [HandoutsController::class, 'displayHandouts'])->name('handout.display');
Route::get('/file/images/{id}',  [HandoutsController::class, 'displayHandoutsImage'])->name('handout.display.image');
Route::get('/file/videos/{id}',  [HandoutsController::class, 'displayHandoutsVideo'])->name('handout.display.video');
Route::delete('handouts/document/{id}', [HandoutsController::class, 'DeleteDocument'])->name('delete.handout.document');
Route::delete('handouts/image/{id}', [HandoutsController::class, 'DeleteImage'])->name('delete.handout.image');
Route::delete('handouts/video/{id}', [HandoutsController::class, 'DeleteVideo'])->name('delete.handout.video');
Route::get('/download/handout/document/{id}', [HandoutsController::class, 'downloadHandoutDoc'])->name('download.handout.document');
Route::get('/download/handout/image/{id}', [HandoutsController::class, 'downloadHandoutImage'])->name('download.handout.image');
Route::get('/download/handout/video/{id}', [HandoutsController::class, 'downloadHandoutVideo'])->name('download.handout.video');



Route::post('/upload/activity/file',  [ActivityFilesController::class, 'storeActivityFiles'])->name('activityfile.upload');
Route::delete('/activityfile/{id}', [ActivityFilesController::class, 'DeleteActivityFile'])->name('delete.activity.file');
Route::post('/upload/activity/file/image',  [ActivityFilesController::class, 'storeActivityFilesImages'])->name('activityfile.upload.image');
Route::delete('/activityfile/image/{id}', [ActivityFilesController::class, 'DeleteActivityFileImages'])->name('delete.activity.file_image');
Route::post('/upload/activity/file/video',  [ActivityFilesController::class, 'storeActivityFilesVideos'])->name('activityfile.upload.video');
Route::delete('/activityfile/video/{id}', [ActivityFilesController::class, 'DeleteActivityFileVideos'])->name('delete.activity.file_video');
Route::get('/download/activity/document/{id}', [ActivityFilesController::class, 'downloadActivityFileDoc'])->name('download.activity.file.doc');
Route::get('/download/activity/image/{id}', [ActivityFilesController::class, 'downloadActivityFileImage'])->name('download.activity.file.image');
Route::get('/download/activity/video/{id}', [ActivityFilesController::class, 'downloadActivityFileVideo'])->name('download.activity.file.video');


Route::get('/certificate/{id}', [CoursesController::class, 'showCertificate'])->name('certificate.show');

Route::get('/download-certificate/{id}', [CertificateController::class, 'downloadCertificate'])->name('certificate.download');





// Routes accessible to admin ----------------------------------------------------------------------------------------------------------------------------
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/home', [PagesController::class, 'home'])->name('home.admin');
Route::get('/admin/about', [PagesController::class, 'about'])->name('about.admin');
Route::get('/admin/contactus', [PagesController::class, 'contactus'])->name('contactus.admin');
Route::get('/admin/terms-and-conditions', [PagesController::class, 'termsAndConditions'])->name('terms_and_conditions.admin');
Route::get('/admin/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy_policy.admin');
Route::get('/admin/blogs-and-news', [PagesController::class, 'blogsAndNews'])->name('blogs_and_news.admin');
Route::get('/admin/testingpage', [PagesController::class, 'testingpage'])->name('testingpage.admin');

Route::post('/admin/contact-us', [ContactUsController::class, 'store'])->name('contact_us.store.admin');
Route::get('/admin/addcourse', [HomeController::class, 'createcourse'])->name('createcourse.admin');

Route::post('/admin/createcourse', [CoursesController::class, 'StoreCourse'])->name('course.store.admin');
Route::get('/admin/course/{id}', [CoursesController::class, 'ViewCourse'])->name('course.show.admin');
Route::get('/admin/course/{id}/edit', [CoursesController::class, 'EditCourse'])->name('edit.course.admin');
Route::put('/admin/course{id}', [CoursesController::class, 'UpdateCourse'])->name('update.course.admin');
Route::delete('/admin/course/{id}', [CoursesController::class, 'DeleteCourse'])->name('delete.admin');

Route::post('/admin/addActivity', [ActivityController::class, 'StoreActivity'])->name('activity.store.admin');
Route::get('/admin/course/activity/{id}/edit', [ActivityController::class, 'EditActivity'])->name('edit.course.activity.admin');
Route::put('/admin/course{id}/update-activity', [ActivityController::class, 'UpdateActivity'])->name('update.activity.admin');
Route::get('/admin/course/activity/{id}', [ActivityController::class, 'getActivity'])->name('view.activity.admin');
Route::delete('/admin/activity/{id}', [ActivityController::class, 'DeleteActivity'])->name('delete.activity.admin');


Route::post('/admin/upload/document',  [HandoutsController::class, 'storeHandout'])->name('handout.upload.admin');
Route::post('/admin/upload/image',  [HandoutsController::class, 'storeImage'])->name('handout.upload.image.admin');
Route::post('/admin/upload/video',  [HandoutsController::class, 'storeVideo'])->name('handout.upload.video.admin');
Route::get('/admin/file/documents/{id}',  [HandoutsController::class, 'displayHandouts'])->name('handout.display.admin');
Route::get('/admin/file/images/{id}',  [HandoutsController::class, 'displayHandoutsImage'])->name('handout.display.image.admin');
Route::get('/admin/file/videos/{id}',  [HandoutsController::class, 'displayHandoutsVideo'])->name('handout.display.video.admin');
Route::delete('/admin/handouts/document/{id}', [HandoutsController::class, 'DeleteDocument'])->name('delete.handout.document.admin');
Route::delete('/admin/handouts/image/{id}', [HandoutsController::class, 'DeleteImage'])->name('delete.handout.image.admin');
Route::delete('/admin/handouts/video/{id}', [HandoutsController::class, 'DeleteVideo'])->name('delete.handout.video.admin');


Route::post('/admin/upload/activity/file',  [ActivityFilesController::class, 'storeActivityFiles'])->name('activityfile.upload.admin');
Route::delete('/admin/activityfile/{id}', [ActivityFilesController::class, 'DeleteActivityFile'])->name('delete.activity.file.admin');
Route::post('/admin/upload/activity/file/image',  [ActivityFilesController::class, 'storeActivityFilesImages'])->name('activityfile.upload.image.admin');
Route::delete('/admin/activityfile/image/{id}', [ActivityFilesController::class, 'DeleteActivityFileImages'])->name('delete.activity.file_image.admin');
Route::post('/admin/upload/activity/file/video',  [ActivityFilesController::class, 'storeActivityFilesVideos'])->name('activityfile.upload.video.admin');
Route::delete('/admin/activityfile/video/{id}', [ActivityFilesController::class, 'DeleteActivityFileVideos'])->name('delete.activity.file_video.admin');
});

Route::post('/update-activity-state/{user_id}/{activity_id}', [ActivityController::class, 'updateActivityState'])->name('update.activity.status');


//  USERS
Route::get('/admin/users', [UserController::class, 'index']);

// ENROLL ROUTES

Route::post('/submit-course-code', [UserController::class, 'submitCourseCode'])->name('submit.course_code');
Route::post('/drop-course', [UserController::class, 'dropCourse'])->name('drop.course');

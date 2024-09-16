@extends('layouts.homelayout')
@section('content')
    <link href="{{ asset('css/createcourses.css') }}" rel="stylesheet">
    <div class="page_layout m-5">
        <div class="main">
            <form action="{{ route('update.course', $courses->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-between align-items-center editbackbtn pt-4">
                    <a href="{{ '/home' }}" class="backtocoursebtn">
                        <p style="text-decoration: none; color: #111; font-size: 1rem;">
                            <i class="fa-solid fa-arrow-left backicon "></i>
                            Back to Courses
                        </p>
                    </a>
                </div>

                <div class="coursedetails" id="viewcourse" style="height: auto;">

                    <div class="course_img_create" style="height: 15rem; width: 25rem;">
                        <label for="image">Change Course Poster</label>
                        <div class="previewimagecontainer d-flex justify-content-center">
                            <!-- Image preview container -->
                            <img id="img-preview" src="{{ $courses->course_poster ? $courses->course_poster : '#' }}"
                                alt="Preview"
                                style="max-width: 100%; {{ $courses->course_poster ? '' : 'display: none;' }}">
                        </div>
                        <div>
                            <!-- File input field for selecting an image -->
                            <input name="course_poster" type="file" id="image" class="form-control-file"
                                onchange="previewImage(event)">
                        </div>
                    </div>
                    <div class="course_details_create" style="width: 100%;">
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Title</label>
                            <input name="course_title" type="text" class="form-control ps-0" style="width: 100%;"
                                id="course_title" value="{{ $courses->course_title }}">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Code</label>
                            <input name="course_code" type="text" class="form-control coursecode ps-0" id="course_code"
                                value="{{ $courses->course_code }}">
                        </div>
                    </div>
                </div>
                <div class="mb-2 mt-4 coursedescdiv">
                    <label for="exampleFormControlTextarea1" class="form-label coursedescription">Course
                        Description</label>
                    <textarea name="course_description" class="form-control ps-1" id="course_description" rows="3"> {{ $courses->course_description }} </textarea>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary mb-4">
                            Save
                            Course</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    @include('partials.footer')
@endsection

@extends('layouts.homelayout')
@section('content')
    <link href="{{ asset('css/createcourses.css') }}" rel="stylesheet">
    <div class="page_layout m-5">
        <div class="main">
            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-between align-items-center pt-4">
                    <a href="{{ '/home' }}" class="backtocoursebtn">
                        <p style="text-decoration: none; color: #111; font-size: 1rem;">
                            <i class="fa-solid fa-arrow-left backicon "></i>
                            Back to Courses
                        </p>
                    </a>
                </div>


                <div class="coursedetails" id="viewcourse" style="height: auto;">

                    <div class="course_img_create" style="height: 15rem; width: 25rem;">
                        <label for="image">Upload Course Poster</label>
                        <div class="previewimagecontainer d-flex justify-content-center">
                            <img id="img-preview" src="#" alt="Preview" style="display: none; max-width: 100%;">
                        </div>
                        <input name="course_poster" type="file" id="image" class="form-control-file">
                    </div>
                    <div class="course_details_create" style="width: 100%;">
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Title</label>
                            <input name="course_title" type="text" class="form-control" id="course_title">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Code</label>
                            <input name="course_code" type="text" class="form-control coursecode" id="course_code">
                        </div>
                    </div>
                </div>


                {{-- <div class="row createcourserow">
                    <div class="col left-contents pb-0">
                        <div class="form-group">
                            <label for="image">Upload Course Poster</label>

                            <div class="previewimagecontainer d-flex justify-content-center">
                                <img id="img-preview" src="#" alt="Preview" style="display: none; max-width: 100%;">
                            </div>
                            <div>
                                <input name="course_poster" type="file" id="image" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="col right_contents pb-0">
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Title</label>
                            <input name="course_title" type="text" class="form-control" id="course_title">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Course Code</label>
                            <input name="course_code" type="text" class="form-control coursecode" id="course_code">
                        </div>
                    </div> --}}

                <div class="mb-2 coursedescdiv">
                    <label for="exampleFormControlTextarea1"
                        class="form-label coursedescription createcoursedescription mt-3">Course
                        Description</label>
                    <textarea name="course_description" class="form-control createcoursedescription" id="course_description" rows="3"></textarea>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary mb-5">
                            Save
                            Course</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @include('partials.footer')
@endsection

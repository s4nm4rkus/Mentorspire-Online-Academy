@extends('layouts.homelayout')
@section('content')
    <link href="{{ asset('css/createcourses.css') }}" rel="stylesheet">
    <div class="page_layout mt-3">
        <div class="main p-3 pt-5">
            <div class="activity d-flex justify-content-between">
                <div class="modal-dialog modal-dialog-centered mt-5"
                    style="width: 50%; background: white; padding:2rem;box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08); border-radius: 5px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit activity</h5>
                        </div>

                        <form action="{{ route('update.activity', $activity->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($activity)
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label-1">Activity
                                            Title</label>
                                        <input name="activity_title" type="text" class="form-control" id="course_title"
                                            maxlength="100"value="{{ $activity->activity_title }}">
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <label for="exampleFormControlInput1" class="form-label-1 mt-3">Activity
                                            No. : </label>
                                        <input required name="activity_number" type="text" class="form-control ms-2"
                                            style="width: 50px;" id="course_title" maxlength="100"
                                            value="{{ $activity->activity_number }}">
                                    </div>

                                    <div class="">
                                        <label for="exampleFormControlTextarea1" class="form-label">Add
                                            Description</label>
                                        <textarea name="activity_description" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            maxlength="500">{{ $activity->activity_description }}</textarea>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center mt-4">
                                    <button type="button" class="btn btn-primary conbtn me-5 pt-2 pb-2"
                                        onclick="window.location='{{ url()->previous() }}'"
                                        style="width: 170px; background-color: white; color: #111;box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.08);"
                                        onmouseover="this.style.backgroundColor='#e3e3e3'; this.style.cursor='pointer';"
                                        onmouseout="this.style.backgroundColor='white'; ;">Cancel</button>
                                    <button type="submit" class="btn btn-primary conbtn ms-5 pt-2 pb-2"
                                        style="width: 170px;box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.08);">Save
                                        changes</button>
                                </div>
                            @else
                                <p>No activity found.</p>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

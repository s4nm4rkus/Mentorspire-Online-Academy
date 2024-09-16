
<?php $__env->startSection('content'); ?>
    <link href="<?php echo e(asset('css/createcourses.css')); ?>" rel="stylesheet">
    <div class="page_layout m-0">
        <div class="main">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <div class="d-flex justify-content-between align-items-center pt-0">
                        <a href="<?php echo e('/home'); ?>" class="backtocoursebtn">
                            <p style="text-decoration: none; color: #111; font-size: 1rem;">
                                <i class="fa-solid fa-arrow-left backicon ms-3 mt-4"></i>
                                Back to Courses
                            </p>
                        </a>

                        <div class="d-flex justify-content-end align-items-center gap-2 me-3">
                            <a href="<?php echo e(route('edit.course', $courses->id)); ?>" class="btn btn-primary me-md-2"
                                style="font-size: .9rem;">
                                Edit</a>

                            <button class="btn btn btn-danger" type="button" data-bs-toggle="modal"
                                style="font-size: .9rem; font-family: 'Inter', sans-serif;"
                                data-bs-target="#kt_modal_del_course_confirm">Delete</button>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>



            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'user'): ?>
                    <div class="d-flex justify-content-between align-items-center pt-0">
                        <a href="<?php echo e('/home'); ?>" class="backtocoursebtn">
                            <p style="text-decoration: none; color: #111; font-size: 1rem;">
                                <i class="fa-solid fa-arrow-left backicon ms-3 mt-4"></i>
                                Back to Courses
                            </p>
                        </a>

                        <div class="d-flex justify-content-end align-items-center gap-2 me-3">
                            <button class="btn btn-primary" id="myBtn"
                                <?php if($user->courses->contains($courses->id)): ?> disabled <?php endif; ?>>Enroll</button>
                            <!-- Modal for course enroll -->
                            <div id="myModal-enroll" class="modal-enroll pt-0">
                                <!-- Modal content -->
                                <div class="modal-content-enroll d-flex justify-content-center p-0"
                                    style="width: 65%; height: 60%; margin-top: -1.9rem;">
                                    <span class="close" style="margin-top: -.6rem;"><i class="fa-solid fa-square-xmark"
                                            style="color: #ffffff; font-size: 1.5rem; margin-right: .1rem;"></i></span>
                                    <div class="shadow" style="padding:7% 11% 11% 11%; width: 100%; height:100%; z-index:1;">
                                        <img class="logo-enroll" src="<?php echo e($courses->course_poster); ?>" alt="logo"
                                            style="height: 100%;">
                                        <h4 class="enroll-course"
                                            style="text-align:center; margin-top: .8rem; font-weight: 400; font-size: 1rem; width:100%; z-index: 2; color:#18527b;">
                                            Course title: <strong><?php echo e($courses->course_title); ?> </strong>
                                        </h4>
                                        <h4 class="enroll-course"
                                            style="text-align:center; margin-top: -2.7rem; font-weight: 400; font-size: .8rem; width:100%; z-index: 2; color:#18527b;;">
                                            Course code: <strong style="color: grey"><?php echo e($courses->course_code); ?> </strong>
                                        </h4>
                                    </div>
                                    <div class="ps-3 pe-3 me-0 justify-content-center shadow"
                                        style="width: 80%; height:100%; margin-right:0;
                                            background: linear-gradient(45deg, rgb(26, 105, 158) 36%, rgba(44, 150, 225, 1) 100%); padding-top:10%; ">
                                        <h2 class="loginlbl p-3"
                                            style="text-align:center; font-size: 1.8rem; font-weight:bold; text-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);">
                                            Start Course</h2>

                                        <form action="<?php echo e(route('submit.course_code')); ?>" method="post" class="form-container">
                                            
                                            <?php echo csrf_field(); ?>
                                            <label for="course_code"></label>
                                            <input class="formcode mt-4" placeholder="Enter course code here"
                                                style="max-width: 20rem; text-align:center; border: none; box-shadow: 0 0 8px 1px rgba(0, 0, 0, 0.07);"
                                                type="text" id="course_code" name="course_code" required>
                                            <button class="enrollbtn"
                                                style="max-width: 20rem; box-shadow: 0 0 8px 1px rgba(0, 0, 0, 0.07); font-size: .9rem;"
                                                type="submit">Enroll</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Drop Course Button -->
                            <button class="btn btn-danger" id="dropBtn" <?php if(!$user->courses->contains($courses->id)): ?> disabled <?php endif; ?>
                                data-course-id="<?php echo e($courses->id); ?>">Drop Course</button>


                            <!-- Modal for dropping course -->
                            <div id="myModal-drop" class="modal-drop">
                                <!-- Modal content -->

                                <div class="modal-content-drop" style="width: 31%; height: 295px;">
                                    <i class="fa-solid fa-triangle-exclamation mt-3 mb-0"
                                        style="color:rgb(240, 71, 71); font-size: 3rem;"></i>
                                    <h5 class="label-drop mt-4" style="font-size: 1rem; font-weight:400;">Are you sure you want
                                        to drop <span class="label-course"><?php echo e($courses->course_title); ?></span>?</h5>

                                    <button id="cancelDrop" type="button" class="btn me-2 ms-2 delbutton cancel-drop"
                                        style="font-size: .9rem; border-radius: 3px; width: 140px; margin-top: .8rem; box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.07);"
                                        data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button id="confirmDrop" type="submit" class="btn me-2 ms-2 btn btn-danger"
                                        style="font-size: .9rem; width: 140px; margin-top: .8rem;">
                                        Drop
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($courses): ?>
                <div class="coursedetails" id="viewcourse" style="height: auto;">
                    <div class="course_img" style="height: 15rem; width: 25rem;">
                        <img class="course_poster" src="<?php echo e($courses->course_poster); ?>" alt="...">
                    </div>
                    <div class="course_details" style="width: 100%;">
                        <h5 class="card-title"><?php echo e($courses->course_title); ?></h5>
                        <p class="course_description me-3" style="color: rgb(20, 20, 20);  text-align: justify;">
                            <?php echo e($courses->course_description); ?>

                        </p>
                        <h5 class="card-title mt-3">Course Code</h5>
                        <p class="course_code" style="font-weight: 600"><?php echo e($courses->course_code); ?></p>

                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->role === 'user'): ?>
                                <label class="nav-link custom-progress-label mt-3"
                                    style="font-size: 14px; color:#000000; font-weight: 400; font-family: 'Inter', sans-serif;">
                                    Progress:</label>
                                <div class="scrollable-content p-0 mt-1"
                                    style="max-height: 220px; overflow: auto; color:#18527b;">
                                    <?php if($totalActivities > 0): ?>
                                        <div class="d-flex justify-space-between">
                                            <p class="ms-0 mt-0 mb-0 p-0"
                                                style="color: #18527b; font-size: 9px; text-align: right; font-weight: 600;">
                                                <?php echo e($completedActivities); ?> / <?php echo e($totalActivities); ?>

                                            </p>
                                        </div>
                                        <div class="progress p-0 m-0" role="progressbar" aria-label="Progress Bar"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="background-color: #F0F0F0; border-radius:50px; width:370px; height: 10px; margin-top: 2px;">
                                            <div class="progress-bar d-flex"
                                                style="width: <?php echo e($progress); ?>%; background-color: #FFBC36;">
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('certificate.show', ['id' => $course_id])); ?>">
                                            <button id="view-certificate-button"
                                                style="background-color:#32aaff; color: white; font-size: 14px; padding: 5px 10px; border: none; border-radius: 5px; font-family: 'Inter', sans-serif; margin-top: 10px;"
                                                data-enrolled="<?php echo e($isEnrolled ? 'true' : 'false'); ?>"
                                                data-complete="<?php echo e($isProgressComplete ? 'true' : 'false'); ?>">
                                                View Certificate
                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <p>There is no activity yet.</p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>No course found.</p>
            <?php endif; ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var button = document.getElementById('view-certificate-button');

                    if (button) {
                        var isEnrolled = button.getAttribute('data-enrolled') === 'true';
                        var isComplete = button.getAttribute('data-complete') === 'true';

                        console.log('Button Found:', button);
                        console.log('Is Enrolled:', isEnrolled);
                        console.log('Is Complete:', isComplete);

                        if (!isEnrolled || !isComplete) {
                            button.disabled = true;
                            button.style.backgroundColor =
                                '#ccc'; // Optional: Change button color to indicate it's disabled
                            console.log('Button Disabled');
                        }
                    } else {
                        console.log('Button Not Found');
                    }
                });
            </script>

            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Activity Title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modalBody">
                            <!-- Activity description will be displayed here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hrview ms-4 mb-4" style="border-color: black;">
            <div class="pc-tab  mt-3">
                <input checked="checked" id="tab1" type="radio" name="pct" />
                <input id="tab2" type="radio" name="pct" />
                <input id="tab3" type="radio" name="pct" />
                <nav>
                    <ul>
                        <li class="tab1">
                            <label for="tab1">Activities</label>
                        </li>
                        <li class="tab2">
                            <label for="tab2">Handouts</label>
                        </li>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->role === 'admin'): ?>
                                <li class="tab3">
                                    <label for="tab3">Student</label>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
                <section class="" style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08);">
                    <div class="tab1 myDiv mb-3 pb-3" style="min-height: 10rem;">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 activitylist">

                            <?php if($activities->isEmpty()): ?>
                                <p class="emptyactivity"> No activities
                                    found.
                                </p>
                            <?php else: ?>
                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card activitycards m-2 pt-0"
                                        style="margin-left: -30px; box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08);">
                                        <div class="d-flex mb-0 pb-0">
                                            <p class="activitytitle m-0 p-0"
                                                style="font-size: .8rem; font-weight: 600; color: rgb(1, 163, 69);">
                                                Activity <?php echo e($activity->activity_number); ?></p>

                                            <?php if(auth()->guard()->check()): ?>
                                                <?php if(auth()->user()->role === 'admin'): ?>
                                                    <div class="dropdown ps-0 pe-0"
                                                        style="margin-top: -1.7rem; background-color: transparent; padding-bottom: 0;">
                                                        <button class="btn btn-secondary dropdown-toggle p-1"
                                                            style="background-color: transparent; color: #c4c4c4; margin-left: 220px;  margin-right: -5px; font-size: 1rem;"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            style="border: none; background-color: transparent;">
                                                            <a class="dropdown-item"
                                                                href="<?php echo e(route('edit.course.activity', $activity->id)); ?>"
                                                                style="font-size: .8rem; border-radius: 3px; width: 100px;">Edit</a>
                                                            <?php if($activity): ?>
                                                                <form action="<?php echo e(route('delete.activity', $activity->id)); ?>"
                                                                    method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>

                                                                    <button type="submit"
                                                                        class="dropdown-item delbutton mt-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_del_confirm"
                                                                        style="font-size: .8rem; border-radius: 3px; background-color: rgb(240, 71, 71); width: 100px; color: white"
                                                                        onmouseover="this.style.backgroundColor='rgb(255, 52, 52)'; this.style.color='white'; this.style.cursor='pointer';"
                                                                        onmouseout="this.style.backgroundColor='rgb(240, 71, 71)'; this.style.color='white';">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>

                                        <div class="card-body p-0">
                                            <div class="activitycardcontent pt-0 pe-1">
                                                <p class="activitytitle"><?php echo e($activity->activity_title); ?></p>
                                                <p class="activitydescription"><?php echo e($activity->activity_description); ?>

                                                </p>
                                            </div>
                                        </div>
                                        
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <div class="viewactivity p-0 ms-2">
                                                    <?php if($user->courses->contains($courses->id)): ?>
                                                        <a class="" style="text-decoration: none;"
                                                            href="<?php echo e(route('view.activity', ['id' => $activity->id])); ?>">Proceed
                                                            <i class="fa-solid fa-arrow-right"></i></a>
                                                    <?php else: ?>
                                                        <button class="disabled" disabled>Proceed <i
                                                                class="fa-solid fa-arrow-right"></i></button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        

                                        
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->role === 'admin'): ?>
                                                <div class="viewactivity p-0 ms-2">
                                                    <a class="" style="text-decoration: none;"
                                                        href="<?php echo e(route('view.activity', ['id' => $activity->id])); ?>">Proceed
                                                        <i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->role === 'admin'): ?>
                                <div class="addactivity">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_1"
                                        style="font-family: 'Inter', sans-serif; margin-top: 3rem;">
                                        Add Activity
                                    </button>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>

                    <div class="tab2 myDiv">
                        
                        <div class="d-flex justify-content-center p-0">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active docunav" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true"> <i
                                            class="fa-solid fa-file-lines"></i> Documents</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link imgnav" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false"><i
                                            class="fa-solid fa-image "></i> Images</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  imgnav" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false"><i
                                            class="fa-solid fa-film"></i> Videos</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 pt-0 docuhandout">
                                    <?php if($handouts->isEmpty()): ?>
                                        <p class="emptyactivity">No
                                            handouts found.</p>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $handouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $handout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- Display documents -->
                                            <div class="card m-2"
                                                style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08); border-top-left-radius: 0; border-top-right-radius: 0;"
                                                id="course_card">
                                                <div class="course_img" style="height: 10rem;">

                                                    <?php if(auth()->guard()->check()): ?>
                                                        <?php if(auth()->user()->role === 'admin'): ?>
                                                            <form
                                                                action="<?php echo e(route('delete.handout.document', $handout->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button class="deldocu" type="submit" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_del_hdoc_confirm"
                                                                    style="z-index: 1; position: absolute; top: 11.2rem; right: .7rem; background: transparent; border:none;">
                                                                    <i style="font-size: 1rem;"
                                                                        class="fa-solid fa-trash "></i>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if(auth()->guard()->check()): ?>
                                                        <?php if(auth()->user()->role === 'user'): ?>
                                                            <form
                                                                action="<?php echo e(route('download.handout.document', $handout->id)); ?>"
                                                                method="GET">
                                                                <?php echo csrf_field(); ?>
                                                                <button class="dldocu" type="submit"
                                                                    style="z-index: 1; position: absolute; top: 11.2rem; right: .7rem; background: transparent; border:none;">
                                                                    <i style="font-size: 1.2rem; text-decoration: underline 2px;"
                                                                        class="fas fa-arrow-down"></i>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if($handout->handout_doc): ?>
                                                        <a style="text-decoration: none; background-color: white;"
                                                            href="<?php echo e($handout->handout_doc); ?>"
                                                            download="<?php echo e($handout->handout_doc); ?>" target="_blank">
                                                            <!-- Display a file icon instead of an image -->
                                                            <img src="<?php echo e(asset('/images/file.png')); ?>"
                                                                style="width: 7rem; height: 7rem;">
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="card-body" id="courseDescription">
                                                    <h5 class="card-title"
                                                        style="position: absolute; bottom: 1.5rem; font-size: .9rem; font-weight: 400;">
                                                        <?php echo e($handout->handout_file_title); ?>

                                                    </h5>
                                                    <h5 class="card-title"
                                                        style="position: absolute; bottom: .5rem; font-size: .7rem; font-weight: 400; width: 11.5rem; max-height: 1rem; overflow:hidden;">
                                                        File:
                                                        <?php echo e($handout->handout_file_name); ?>

                                                    </h5>
                                                    <a href="<?php echo e($handout->handout_doc); ?>"></a>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>

                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(auth()->user()->role === 'admin'): ?>
                                        <div class="addactivity">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_2"
                                                style="font-family: 'Inter', sans-serif; padding: 5px 10px 5px 10px;">Upload
                                                documents</button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>


                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 imghandout">
                                    <?php if($imghandouts->isEmpty()): ?>
                                        <p class="emptyactivity">No
                                            handouts found.</p>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $imghandouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $handout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <!-- Display images -->
                                            <div class="card mt-2 ms-2 me-2 p-0"
                                                style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08); margin-bottom: 2rem;"
                                                id="course_card">

                                                <?php if(auth()->guard()->check()): ?>
                                                    <?php if(auth()->user()->role === 'admin'): ?>
                                                        <form action="<?php echo e(route('delete.handout.image', $handout->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="delimg" type="submit" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_del_himg_confirm"
                                                                style="z-index: 1; background: transparent; border:none;">
                                                                <i style="font-size: 1rem;" class="fa-solid fa-trash "></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(auth()->guard()->check()): ?>
                                                    <?php if(auth()->user()->role === 'user'): ?>
                                                        <form action="<?php echo e(route('download.handout.image', $handout->id)); ?>"
                                                            method="GET">
                                                            <?php echo csrf_field(); ?>

                                                            <button class="dlimg delimg" type="submit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_del_himg_confirm"
                                                                style="z-index: 2; background: transparent; border:none;">
                                                                <i style="font-size: 1.2rem; text-decoration: underline 2px"
                                                                    class="fas fa-arrow-down"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <div class="course_img"
                                                    style = "height: 100%; max-height: 11rem; width: auto; margin-left: 0; margin-right: 0; margin-top: -2rem; padding:0;">
                                                    <img class="course_poster" src="<?php echo e($handout->handout_image); ?>"
                                                        alt="<?php echo e($handout->handout_image_name); ?>">
                                                </div>
                                                <div class="card-body" id="courseDescription">

                                                    <h5 class="card-title"
                                                        style="position: absolute; bottom: 2rem; font-size: .9rem; font-weight: 400;">
                                                        <?php echo e($handout->handout_image_title); ?></h5>
                                                    <h5 class="card-title"
                                                        style="position: absolute; bottom: 1rem; font-size: .7rem; font-weight: 400;">
                                                        File:
                                                        <?php echo e($handout->handout_image_name); ?></h5>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(auth()->user()->role === 'admin'): ?>
                                        <div class="addactivity">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_2_image"
                                                style="font-family: 'Inter', sans-serif;padding: 5px 10px 5px 10px;">Upload
                                                image</button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>



                            </div>

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 imghandout">
                                    <?php if($vidhandouts->isEmpty()): ?>
                                        <p class="emptyactivity">No handouts found.</p>
                                    <?php else: ?>
                                        <!-- Display videos -->
                                        <?php $__currentLoopData = $vidhandouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $handout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card m-2 p-0"
                                                style="box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08);" id="course_card">
                                                <div class="course_img"
                                                    style="height: 100%; margin-left: 0; margin-right: 0; margin-top: -1rem; padding:0; margin-top:-2rem;">
                                                        <video class="course_poster" controls>
                                                            <source
                                                                src="<?php echo e($handout->handout_video); ?>"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                </div>
                                                <?php if(auth()->guard()->check()): ?>
                                                    <?php if(auth()->user()->role === 'admin'): ?>
                                                        <form action="<?php echo e(route('delete.handout.video', $handout->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button class="delimg" type="submmit" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_del_hvid_confirm"
                                                                style="z-index: 1; background: transparent; border:none;">
                                                                <i style="font-size: 1rem; margin-top:7px;"
                                                                    class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if(auth()->guard()->check()): ?>
                                                    <?php if(auth()->user()->role === 'user'): ?>
                                                        <form action="<?php echo e(route('download.handout.video', $handout->id)); ?>"
                                                            method="GET">
                                                            <?php echo csrf_field(); ?>

                                                            <button class="dlimg delimg" type="submmit"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_del_hvid_confirm"
                                                                style="z-index: 1; background: transparent; border:none;">
                                                                <i style="font-size: 1.2rem; margin-top:7px; text-decoration: underline 2px"
                                                                    class="fas fa-arrow-down"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                
                                                <div class="card-body" id="courseDescription">
                                                    <h5 class="card-title"
                                                        style="position: absolute; bottom: 1rem; font-size: .9rem; font-weight: 400;">
                                                        <?php echo e($handout->handout_video_title); ?>

                                                    </h5>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>

                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(auth()->user()->role === 'admin'): ?>
                                        <div class="addactivity">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_2_video"
                                                style="font-family: 'Inter', sans-serif; padding: 5px 10px 5px 10px;">Upload
                                                video</button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>



                    <div class="tab3 pb-0 pt-3">
                        <div class="container-student">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="background-color:#f1f1f1;">Student name</th>
                                        <th scope="col" style="background-color:#f1f1f1;">Progress</th>
                                        <th style="text-align: center; background-color:#f1f1f1;" scope="col">Activity
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 m-0">
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="p-0 m-0">
                                            <td style="background-color: white; width:20rem;">
                                                <?php echo e(ucfirst($student->firstname)); ?> <?php echo e(ucfirst($student->lastname)); ?>

                                            </td>
                                            <td style="background-color: white; padding-top: .7rem;">
                                                <?php
                                                    $totalActivities = $activities->count();
                                                    $completedActivities = $student
                                                        ->activityStates()
                                                        ->where('course_id', $course_id)
                                                        ->where('completed', true)
                                                        ->count();
                                                    $percentage =
                                                        $totalActivities > 0
                                                            ? ($completedActivities / $totalActivities) * 100
                                                            : 0;
                                                ?>
                                                <div class="progress p-0 m-0" role="progressbar"
                                                    aria-label="Progress Bar" aria-valuemin="0" aria-valuemax="100"
                                                    style="background-color: #F0F0F0; border-radius:50px;">
                                                    <div id="progress-bar-<?php echo e($student->id); ?>"
                                                        class="progress-bar d-flex"
                                                        style="width: <?php echo e($percentage); ?>%; background-color: #FFBC36;">
                                                        <p id="progress-text-<?php echo e($student->id); ?>"
                                                            style="color: white; font-size: 10px;">
                                                            <?php echo e($completedActivities); ?> / <?php echo e($totalActivities); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="background-color: white;width:10rem;">
                                                <div class="dropdown dropdown-center p-0 justify-content-center"
                                                    style="background-color: transparent;">
                                                    <button class="m-0 p-0" type="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        style="border: none; background-color: inherit;">
                                                        <i class="fa-solid fa-caret-down" style="color:#2c96e1;"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" style="border: none;">
                                                        <div style="background-color: white; width:19rem; height: 14rem; overflow: scroll; box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.08); border-radius:10px;"
                                                            class="activitystat">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" style="font-size:12px;">
                                                                            Activity list</th>
                                                                        <th scope="col"
                                                                            style="font-size:12px; text-align:center;">
                                                                            Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $activityState = $student
                                                                            ->activityStates()
                                                                            ->where('activity_id', $activity->id)
                                                                            ->where('course_id', $course_id)
                                                                            ->first();
                                                                        $isCompleted = $activityState
                                                                            ? $activityState->completed
                                                                            : false;
                                                                    ?>
                                                                    <tr>
                                                                        <td class=""
                                                                            style="background-color: white; font-size:12px; font-weight: 600;color:green; width:70%; padding-top: .8rem;">
                                                                            <i class="fa-solid fa-caret-right"></i>
                                                                            Activity <?php echo e($activity->activity_number); ?>

                                                                        </td>
                                                                        <td class="d-flex justify-space-between"
                                                                            style="background-color: white; text-align:center;">
                                                                            <form id="ungraded-form-<?php echo e($activity->id); ?>"
                                                                                action="<?php echo e(route('update.activity.status', ['user_id' => $student->id, 'activity_id' => $activity->id, 'course_id' => $course_id])); ?>"
                                                                                method="POST"
                                                                                style="display: flex; justify-content: center;">
                                                                                <?php echo csrf_field(); ?>
                                                                                <input type="hidden" name="user_id"
                                                                                    value="<?php echo e($student->id); ?>">
                                                                                <input type="hidden" name="activity_id"
                                                                                    value="<?php echo e($activity->id); ?>">
                                                                                <input type="hidden" name="course_id"
                                                                                    value="<?php echo e($course_id); ?>">
                                                                                <input type="hidden" name="completed"
                                                                                    value="0">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary me-1 ms-2 pe-2 ps-2 pt-2 ungradedBtn"
                                                                                    style="font-size: 9px; border-radius: 50px; text-transform:uppercase;"
                                                                                    <?php echo e($isCompleted ? '' : 'disabled'); ?>>
                                                                                    Ungraded
                                                                                </button>
                                                                            </form>

                                                                            <form id="completed-form-<?php echo e($activity->id); ?>"
                                                                                action="<?php echo e(route('update.activity.status', ['user_id' => $student->id, 'activity_id' => $activity->id, 'course_id' => $course_id])); ?>"
                                                                                method="POST"
                                                                                style="display: flex; justify-content: center;">
                                                                                <?php echo csrf_field(); ?>
                                                                                <input type="hidden" name="user_id"
                                                                                    value="<?php echo e($student->id); ?>">
                                                                                <input type="hidden" name="activity_id"
                                                                                    value="<?php echo e($activity->id); ?>">
                                                                                <input type="hidden" name="course_id"
                                                                                    value="<?php echo e($course_id); ?>">
                                                                                <input type="hidden" name="completed"
                                                                                    value="1">
                                                                                <button type="submit"
                                                                                    class="btn btn-completed pe-2 ps-2 pt-2 completedBtn"
                                                                                    style="font-size: 9px; border-radius: 50px; text-transform:uppercase;"
                                                                                    <?php echo e($isCompleted ? 'disabled' : ''); ?>>
                                                                                    Completed
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </table>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </section>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('form').forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            const formId = form.getAttribute('id');
                            const activityId = formId.split('-')[2];

                            const completedButton = document.querySelector(
                                `#completed-form-${activityId} .completedBtn`);
                            const ungradedButton = document.querySelector(
                                `#ungraded-form-${activityId} .ungradedBtn`);

                            if (completedButton.disabled) {
                                completedButton.disabled = false;
                                ungradedButton.disabled = true;
                            } else {
                                completedButton.disabled = true;
                                ungradedButton.disabled = false;
                            }
                        });
                    });
                });
            </script>






            
            <div class="activity d-flex justify-content-between">
                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add course activity</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 activityxmark"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-square-xmark" style="color: #e74c3c; font-size: 1.5rem;"></i>
                                </div>
                                <!--end::Close-->
                            </div>

                            <form method="POST" action="<?php echo e(route('activity.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label-1">Activity
                                            Title</label>
                                        <input name="activity_title" type="text" class="form-control"
                                            id="course_title" maxlength="100">
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <label for="exampleFormControlInput1" class="form-label-1 mt-3">Activity
                                            No. : </label>
                                        <input required name="activity_number" type="text" class="form-control ms-2"
                                            style="width: 50px;" id="course_title" maxlength="100">
                                    </div>

                                    <div class="">
                                        <label for="exampleFormControlTextarea1" class="form-label">Add
                                            Description</label>
                                        <textarea name="activity_description" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            maxlength="500"></textarea>
                                    </div>
                                    <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="activity d-flex justify-content-between">
                <div class="modal fade" tabindex="-1" id="kt_modal_2">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Upload Handout</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-square-xmark" style="color: #e74c3c; font-size: 1.5rem;"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <form method="POST" action="<?php echo e(route('handout.upload.admin')); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="handout_file_title" class="form-label-1">Handout File
                                            Title</label>
                                        <input name="handout_file_title" type="text" class="form-control"
                                            id="handout_file_title">
                                        <div name="handout_doc" id="dropzone" class="dropzone">
                                            Drag and drop files here or click to upload
                                            <p><i class="fa-solid fa-file-circle-plus" style="font-size: 1.5rem;"></i>
                                            </p>
                                            <input name="handout_doc" type="file" id="fileInput">
                                            <div id="fileList" class="file-list"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            
            
            <div class="activity d-flex justify-content-between">
                <div class="modal fade" tabindex="-1" id="kt_modal_2_image">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Upload Handout</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-square-xmark" style="color: #e74c3c; font-size: 1.5rem;"></i>
                                </div>
                                <!--end::Close-->
                            </div>

                            <form method="POST" action="<?php echo e(route('handout.upload.image')); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="handout_image_title" class="form-label-1">Handout Image
                                            Title</label>
                                        <input name="handout_image_title" type="text" class="form-control"
                                            id="handout_image_title">
                                        <div name="handout_image" id="dropzone2" class="dropzone">
                                            Drag and drop files here or click to upload
                                            <p><i class="fa-solid fa-images" style="font-size: 1.5rem;"></i></p>
                                            <input name="handout_image" type="file" id="fileInput2" multiple>
                                            <div id="fileList2" class="file-list"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            
            
            <div class="activity d-flex justify-content-between">
                <div class="modal fade" tabindex="-1" id="kt_modal_2_video">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Upload Handout</h5>
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-square-xmark" style="color: #e74c3c; font-size: 1.5rem;"></i>
                                </div>
                                <!--end::Close-->
                            </div>


                            <form action="<?php echo e(route('handout.upload.video')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="handout_video_title" class="form-label-1">Handout Video
                                            Title</label>
                                        <input name="handout_video_title" type="text" class="form-control"
                                            id="handout_video_title">
                                        <div name="handout_video" id="dropzone3" class="dropzone">
                                            Drag and drop files here or click to upload
                                            <p><i class="fa-solid fa-file-video" style="font-size: 1.5rem;"></i></p>
                                            <input name="handout_video" type="file" id="fileInput3" multiple>
                                            <div id="fileList3" class="file-list"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="course_id" value="<?php echo e($course_id); ?>">
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            
            <div class="activity d-flex justify-content-between">
                <div class="modal fade" tabindex="-1" id="kt_modal_del_course_confirm">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content deletemodal">
                            <div class="modal-body">

                                <div class="confimdelnote">
                                    <i class="fa-solid fa-triangle-exclamation" style="color:rgb(240, 71, 71)"></i>
                                    <p>Are you sure you want to delete this Course?</p>

                                </div>
                                <div class="confirmdel d-flex justify-content-center">
                                    <button type="button" class="btn m-3 delbutton mt-1 shadow-sm"
                                        style="font-size: .9rem; border-radius: 3px;" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <?php if($courses): ?>
                                        <form action="<?php echo e(route('delete', $courses->id)); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class=" btn m-3 delbutton mt-1"
                                                style="font-size: .9rem; border-radius: 3px; background-color: #f04747; width: 160px; color: white"
                                                onmouseover="this.style.backgroundColor='rgb(255, 52, 52)'; this.style.color='white'; this.style.cursor='pointer';"
                                                onmouseout="this.style.backgroundColor='rgb(240, 71, 71)'; this.style.color='white'; ">
                                                Delete
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .deletemodal .modal-body {
            width: 150px;
            height: 250px;
        }

        .fa-square-xmark {
            margin-right: -35.7rem;
            margin-top: -1rem
        }

        .activityxmark .fa-square-xmark {
            margin-right: -32rem;
        }

        .dldocu {
            color: #ccc;
        }

        .dldocu:hover {
            color: #2c96e1;
            transition: background-color 0.5s ease;
        }

        .dlimg {
            color: #ccc;
            transition: background-color 0.5s ease;
        }

        .dlimg:hover {
            color: #2c96e1;
        }


       
        @media only screen and (max-width: 414px) {
            .deletemodal .modal-body {
                margin-left: -3.4rem;
            }

            .fa-square-xmark {
                margin-right: -23rem;
                margin-top: -1rem
            }

            .activityxmark .fa-square-xmark {
                margin-right: -19.5rem;
            }
        }

        @media (min-width: 360px) and (max-width: 390px) {
            .deletemodal .modal-body {
                margin-left: -4.5rem;
            }

            .fa-square-xmark {
                margin-right: -23rem;
                margin-top: -1rem
            }

            .activityxmark .fa-square-xmark {
                margin-right: -19.5rem;
            }
        }
    </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.homelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iot-app\resources\views/pages/viewcourse.blade.php ENDPATH**/ ?>